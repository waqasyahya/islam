<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Recorder</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        .container {
            max-width: 500px;
            margin: auto;
        }

        #status {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            max-height: 100px;
            overflow-y: auto;
        }

        .progress-container {
            width: 100%;
            background: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-bar {
            height: 20px;
            width: 0%;
            background: green;
            color: white;
            text-align: center;
            line-height: 20px;
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Audio Recorder</h2>
        <button id="startRecording" onclick="startRecording()">🎤 Start Recording</button>
        <button id="stopRecording" onclick="stopRecording()" disabled>⏹ Stop Recording</button>
        <div id="status">Click to start recording</div>
        <div class="progress-container">
            <div id="progressBar" class="progress-bar">0%</div>
        </div>
        <div id="result"></div>
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
                updateUI(response.data.output);
            } catch (error) {
                document.getElementById("status").innerText = "Error: " + error.message;
            }
        }









        function updateUI(data) {
            document.getElementById("status").innerText = "Comparison Completed!";

            // Ensure similarity is properly calculated
            let similarity = Math.min(Math.max(Math.round(data.result.similarity_score), 0), 100);
            console.log("Similarity Score from API:", data.result.similarity_score);
            console.log("Final Similarity %:", similarity);

            let progressBar = document.getElementById("progressBar");

            // Update progress bar width and text
            progressBar.style.width = similarity + "%";
            progressBar.innerText = similarity + "%";

            // Reset existing color
            progressBar.style.background = "";

            // Set color based on similarity score
            if (similarity < 50) {
                progressBar.style.background = "red"; // Keep red from 0 to 50
            } else if (similarity >= 50 && similarity <= 75) {
                progressBar.style.background = "orange"; // Orange from 51 to 75
            } else {
                progressBar.style.background = "green"; // Green for 76 to 100
            }

            // Force UI refresh
            progressBar.style.display = "none";
            setTimeout(() => progressBar.style.display = "block", 10);

            // Update the result details
            let resultDiv = document.getElementById("result");
            resultDiv.innerHTML = `
    <p><strong>Qari Text:</strong> ${data.result.qari_text}</p>
    <p><strong>Your Text:</strong> ${data.result.user_text}</p>
    <p><strong>Tajweed Mistakes:</strong> ${data.result.tajweed_mistakes.join("<br>")}</p>
`;
        }
    </script>
</body>

</html>
