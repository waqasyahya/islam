//webkitURL is deprecated but nevertheless











URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

async function startRecording() {
    console.log("recordButton clicked");

    var constraints = { audio: true, video: false };

    recordButton.disabled = true;
    stopButton.disabled = false;
    pauseButton.disabled = false;

    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

        audioContext = new (window.AudioContext || window.webkitAudioContext)();

        // Log the sample rate information
        console.log("Sample Rate: " + audioContext.sampleRate);

        document.getElementById("formats").innerHTML = "Format: 1 channel pcm @ " + audioContext.sampleRate / 1000 + "kHz";

        gumStream = stream;
        input = audioContext.createMediaStreamSource(stream);

        rec = new Recorder(input, { numChannels: 1 });

        rec.record();

        console.log("Recording started");
    } catch (err) {
        recordButton.disabled = false;
        stopButton.disabled = true;
        pauseButton.disabled = true;
        console.error("Error starting recording:", err);
    }
}
function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
    var url = URL.createObjectURL(blob);
    var au = document.createElement('audio');
    var li = document.createElement('li');
    var link = document.createElement('a');

    // Dynamically generate the filename
    var filename = "recorded_audio_" + new Date().toISOString() + ".wav";

    // Add controls to the <audio> element
    au.controls = true;
    au.src = url;

    // Save to disk link
    link.href = url;
    link.download = filename; // Set the filename directly
    link.innerHTML = "Save to disk";

    // Add the new audio element to li
    li.appendChild(au);

    // Add the filename to the li
    li.appendChild(document.createTextNode(filename));

    // Add the save to disk link to li
    li.appendChild(link);

    // Upload link
    var upload = document.createElement('a');
    upload.href = "#";
    upload.innerHTML = "Upload";
    upload.addEventListener("click", function (event) {
        var xhr = new XMLHttpRequest();
        xhr.onload = function (e) {
            if (this.readyState === 4) {
                console.log("Server returned: ", e.target.responseText);
            }
        };
        var fd = new FormData();
        fd.append("audio_data", blob, filename);
        xhr.open("POST", "/store-recorded-audio", true); // Updated endpoint
        xhr.send(fd);
    });
    li.appendChild(document.createTextNode(" ")); // Add a space in between
    li.appendChild(upload); // Add the upload link to li

    // Add the li element to the ol
    recordingsList.appendChild(li);
}
