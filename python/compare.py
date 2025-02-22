import sys
import librosa
import torch
import json
import difflib
import time  
import os  
import warnings  
from transformers import Wav2Vec2Processor, Wav2Vec2ForCTC
from functools import lru_cache

warnings.simplefilter("ignore")  # ✅ Transformers ki warnings disable karein

# ✅ Collect Debug Logs in a List Instead of Printing Line-by-Line
debug_logs = []

def log_status(message):
    """ ✅ Logs ko collect karein instead of direct print """
    debug_logs.append({"status": message})

# ✅ Model Fast Loading with Cache
@lru_cache(maxsize=1)
def load_model():
    start_time = time.time()
    processor = Wav2Vec2Processor.from_pretrained("jonatasgrosman/wav2vec2-large-xlsr-53-arabic")
    model = Wav2Vec2ForCTC.from_pretrained("jonatasgrosman/wav2vec2-large-xlsr-53-arabic")
    end_time = time.time()
    log_status(f"Model Loaded in {end_time - start_time:.2f} seconds")
    return processor, model

processor, model = load_model()

# ✅ Makharij Groups for Tajweed Checking
MAKHARIJ_MAP = {
    "Halaqiyah (Throat Sounds)": ["أ", "هـ", "ع", "ح", "غ", "خ"],
    "Lahatiyah (Tongue Root)": ["ق", "ك"],
    "Shajariyah-Haafiyah (Middle Tongue)": ["ج", "ش", "ي"],
    "Tarafiyah (Tip of Tongue)": ["ر"],
    "Lisawiyah (Upper Tongue)": ["ت", "د", "ط", "ص", "ض", "س", "ز"],
    "Ghunna (Nasal Sounds)": ["م", "ن"]
}

def transcribe_audio(file_path):
    """ ✅ Audio ko fast text me convert karega """
    try:
        start_time = time.time()

        # ✅ Step 1: File existence & permission check
        if not os.path.exists(file_path):
            return f"Error: File not found: {file_path}"

        if not os.access(file_path, os.R_OK):
            return f"Error: Permission Denied: {file_path}"

        # ✅ Step 2: File size check
        file_size = os.path.getsize(file_path)
        if file_size == 0:
            return f"Error: Empty file detected: {file_path}"

        log_status(f"Processing File: {file_path}, Size: {file_size} bytes")

        # ✅ Step 3: Librosa se audio load karein
        try:
            speech_array, sampling_rate = librosa.load(file_path, sr=16000, res_type='kaiser_fast')
        except Exception as e:
            return f"Error: Librosa failed to load audio: {str(e)}"

        log_status("Audio Loaded Successfully!")

        # ✅ Step 4: Model se transcription karein
        input_values = processor(speech_array, return_tensors="pt", sampling_rate=16000).input_values
        with torch.no_grad():
            logits = model(input_values).logits
        predicted_ids = torch.argmax(logits, dim=-1)
        transcription = processor.batch_decode(predicted_ids)[0]

        end_time = time.time()
        log_status(f"Audio Transcribed in {end_time - start_time:.2f} seconds")

        if not transcription.strip():
            return "Error: Model did not return a transcription."

        return transcription

    except Exception as e:
        return f"Error: Unexpected error in transcription: {str(e)}"

def phoneme_similarity(qari_audio, user_audio):
    """ ✅ Compare phonemes & Tajweed accuracy """
    start_time = time.time()

    # ✅ Qari & User audio ka text convert karein
    qari_text = transcribe_audio(qari_audio)
    user_text = transcribe_audio(user_audio)

    if "Error" in qari_text or "Error" in user_text:
        return {"error": "Transcription failed for one or both audio files"}

    # ✅ Similarity Calculation
    similarity = difflib.SequenceMatcher(None, qari_text, user_text).ratio() * 100

    # ✅ Tajweed Mistakes Detection
    mistakes = []
    for letter in user_text:
        for group, letters in MAKHARIJ_MAP.items():
            if letter in letters and letter not in qari_text:
                mistakes.append(f"❌ {letter} mispronounced ({group})")

    end_time = time.time()
    log_status(f"Comparison Done in {end_time - start_time:.2f} seconds")

    return {
        "qari_text": qari_text,
        "user_text": user_text,
        "similarity_score": round(similarity, 2),
        "tajweed_mistakes": mistakes
    }

if __name__ == "__main__":
    try:
        qari_audio = sys.argv[1]
        user_audio = sys.argv[2]

        total_start_time = time.time()
        result = phoneme_similarity(qari_audio, user_audio)
        total_end_time = time.time()

        if "error" in result:
            print(json.dumps({"error": "Processing Failed", "details": result["error"], "logs": debug_logs}))
            sys.stdout.flush()
            sys.exit(1)

        final_output = {
            "total_time_taken": f"{total_end_time - total_start_time:.2f} seconds",
            # "logs": debug_logs,  # ✅ Debug logs ab Laravel ke JSON response me included hain
            "result": result
        }

        print(json.dumps(final_output))  # ✅ Laravel ab sirf ek valid JSON hi parse karega
        sys.stdout.flush()
        
    except Exception as e:
        print(json.dumps({"error": f"Unexpected error in main: {str(e)}"}))
        sys.stdout.flush()
        sys.exit(1)
