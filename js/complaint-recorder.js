// ========================================================= STRAT OF AUDIO RECORDER =============================================================================== //
const record = document.getElementById("start-recording");
const stop = document.getElementById("stop-recording");
const audio = document.getElementById("audioElement");
const isRecording = document.getElementById("isRecording");

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
            isRecording.style.color = "red";
            isRecording.textContent = "Recorder Started";
            stop.disabled = false;
            record.disabled = true;
        }

        stop.onclick = function(){
            mediaRecorder.stop();
            console.log(mediaRecorder.state);
            console.log("Recorder Stopped");
            isRecording.style.color = "red";
            isRecording.textContent = "Recorder Stopped"
            stop.disabled = true;
            record.disabled = false;
        }

        mediaRecorder.onstop = function(){
            console.log("Data available after MediaRecorder.stop() called");
            const blob = new Blob(chunks, {type: "audio/mp3; codecs=opus"});
            chunks= [];
            audio.src = URL.createObjectURL(blob);
            console.log("Recorder Stopped");

            var xhr = new XMLHttpRequest();
            xhr.onload = function(e) {
                if(this.readyState === 4) {
                    console.log("Server returned: ",e.target.responseText);
                }
            };
            var fd = new FormData();
            fd.append("audio_data", blob, "filename");
            xhr.open("POST", ".././src/scripts/save-audio.php", true);
            xhr.send(fd);
        }

        mediaRecorder.ondataavailable = function(e){
            chunks.push(e.data);
        }
    }

    let onError = function(err){
        record.disabled = true;
        stop.disabled = true;
        console.log(err + " has occured");
    }

    navigator.mediaDevices.getUserMedia(constraints).then(onSuccess, onError);
}
// ========================================================= END OF AUDIO RECORDER =============================================================================== //

// ========================================================= START OF SPEECH RECOGNITON ========================================================================== //
/*
let startSpeech = document.getElementById("start-speech"); 
let stopSpeech = document.getElementById("stop-speech");

if("webkitSpeechRecognition" in window){
    let speechRecognition = new webkitSpeechRecognition();
    let final_transcript = "";

    speechRecognition.continuous = true;
    speechRecognition.interimResults = true; // Interim results = Results that are not yet final

    speechRecognition.onresult = (event) => {
        let interim_transcript = "";

        for(let i = event.resultIndex; i < event.results.length; ++i){
            if(event.results[i].isFinal){
                final_transcript += event.results[i][0].transcript;
            }
            else{
                interim_transcript += event.results[i][0].transcript;
            }
        }

        document.querySelector("#comp_desc").value = final_transcript;
        document.querySelector("#final").innerHTML = final_transcript;
        document.querySelector("#interim").innerHTML = interim_transcript;
    };

    startSpeech.onclick = () => {
        speechRecognition.start();
    }

    stopSpeech.onclick = () => {
        speechRecognition.stop();
    }

}
else{
    console.log("Speech Recognition Not Available");
}
*/
// ========================================================= END OF SPEECH RECOGNITON ============================================================================ //