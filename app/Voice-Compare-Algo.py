# app.py

import librosa
import numpy as np
from flask import Flask, request, jsonify
from sklearn.preprocessing import StandardScaler
from flask_cors import CORS  # Import CORS from flask_cors
app = Flask(__name__)
CORS(app, origins='*', allow_headers=['Content-Type'])
@app.route('/api/upload', methods=['POST'])
def upload_files():

    file1 = request.files['file1']
    file2 = request.files['file2']

    result = compare_audio_files(file1, file2)

    return jsonify(f" The matching of sounds is: {result}%") 

def compare_audio_files(audio_file1, audio_file2):
    # Load the audio files
    audio1, sr1 = librosa.load(audio_file1)
    audio2, sr2 = librosa.load(audio_file2)

    # Preprocess the audio files
    # Pad the audio files to the same length
    if len(audio2) < len(audio1):
        audio2 = np.pad(audio2, (0, len(audio1) - len(audio2)), 'constant')
    elif len(audio2) > len(audio1):
        audio1 = np.pad(audio1, (0, len(audio2) - len(audio1)), 'constant')

    # Extract features from the audio files
    features1 = librosa.feature.mfcc(y=audio1, sr=sr1)
    features2 = librosa.feature.mfcc(y=audio2, sr=sr2)

    # Normalize the extracted features
    scaler = StandardScaler()
    features1n = scaler.fit_transform(features1.reshape(-1, 1))
    features2n = scaler.transform(features2.reshape(-1, 1))

    # Compare the features using a distance metric
   
    distance = np.mean((features1n - features2n)**2)

    distance = 1 - distance
    distance = distance * 100

    # Return the distance as a measure of similarity
    return distance

if __name__ == '__main__':
    app.run(debug=False)
