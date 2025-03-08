<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Recorder</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>

    <div style="text-align: center; margin-top: 50px;">
        <h2>Audio Recorder</h2>
        <button id="startRecording" onclick="startRecording()">🎤 Start Recording</button>
        <button id="stopRecording" onclick="stopRecording()" disabled>⏹ Stop Recording</button>
        <p id="status">Click to start recording</p>
    </div>

    <script>
        let mediaRecorder;
        let audioChunks = [];
        let apiUrl = "{{ route('compare-audio', ['Quaida_id' => $Quaida_id, 'words_id' => $words_id]) }}";


        async function startRecording() {
            let stream = await navigator.mediaDevices.getUserMedia({
                audio: true
            });
            mediaRecorder = new MediaRecorder(stream);
            audioChunks = [];

            mediaRecorder.ondataavailable = event => {
                if (event.data.size > 0) {
                    audioChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                let audioBlob = new Blob(audioChunks, {
                    type: "audio/wav"
                });
                sendAudioToAPI(audioBlob);
            };

            mediaRecorder.start();
            document.getElementById("startRecording").disabled = true;
            document.getElementById("stopRecording").disabled = false;
            document.getElementById("status").innerText = "Recording...";
        }

        function stopRecording() {
            mediaRecorder.stop();
            document.getElementById("startRecording").disabled = false;
            document.getElementById("stopRecording").disabled = true;
            document.getElementById("status").innerText = "Processing...";
        }

        async function sendAudioToAPI(audioBlob) {
            let formData = new FormData();
            formData.append("user_audio", audioBlob, "recorded_audio.wav");

            try {
                let response = await axios.post(apiUrl, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                });

                document.getElementById("status").innerText = "Response: " + JSON.stringify(response.data);
            } catch (error) {
                document.getElementById("status").innerText = "Error: " + error.message;
            }
        }
    </script>

</body>

</html>
