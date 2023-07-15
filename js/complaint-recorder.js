const record = document.getElementById("start-recording");
const stop = document.getElementById("stop-recording");
const audio = document.getElementById("audioElement")
const isRecording = document.getElementById("isRecording")

stop.disabled = true;

if(navigator.mediaDevices.getUserMedia){
    console.log("getUserMedia API is supported.");

    const constraints = {audio: true};
    let chunks = [];

    let onSuccess = function(stream){
        const mediaRecorder = new MediaRecorder(stream);

        record.onclick = function(){
            mediaRecorder.start();
            console.log(mediaRecorder.state);
            console.log("Recorder Started");
            isRecording.textContent = "Recorder Started";
            stop.disabled = false;
            record.disabled = true;
        }

        stop.onclick = function(){
            mediaRecorder.stop();
            console.log(mediaRecorder.state);
            console.log("Recorder Stopped");
            isRecording.textContent = "Recorder Stopped"
            stop.disabled = true;
            record.disabled = false;
        }

        mediaRecorder.onstop = function(e){
            console.log("Data available after MediaRecorder.stop() called");
            const blob = new Blob(chunks, {type: "audio/ogg; codecs=opus"});
            chunks= [];
            const audioURL = window.URL.createObjectURL(blob);
            //audio.src = audioURL;
            audio.src = URL.createObjectURL(blob);
            console.log("Recorder Stopped");
        }

        mediaRecorder.ondataavailable = function(e){
            chunks.push(e.data);
        }
    }

    let onError = function(err){
        console.log(err + " has occured");
    }

    navigator.mediaDevices.getUserMedia(constraints).then(onSuccess, onError);
}