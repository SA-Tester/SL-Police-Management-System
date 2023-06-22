// Reference 1: https://blog.logrocket.com/how-to-create-video-audio-recorder-react/
// Reference 2: React Speech Recognition Library

import React from "react";
import { useState, useRef } from "react";
import SpeechRecognition, { useSpeechRecognition } from "react-speech-recognition";

const mimeType = "audio/webm";

// short function syntax
const AudioRecorder = () => {
    const{
        transcript,
        browserSupportsSpeechRecognition
    } = useSpeechRecognition();

    // Overriding the defualt method
    const startListening = () => SpeechRecognition.startListening({continuous: true});

    const [permission, setPermission] = useState(false);
    const mediaRecorder = useRef(null);
    const [recordingStatus, setRecordingStatus] = useState("inactive"); //recording status: recording, inactive, paused
    const [stream, setStream] = useState(null);
    const [audioChunks, setAudioChunks] = useState([]); // audio chunks = encoded pieces of audio recording
    const [audio, setAudio] = useState(null); // audio: blob URL to finished audio recording

    // async - a library to handle asynchronous UI states
    const startRecording = async () => {
        setRecordingStatus("recording");
        const media = new MediaRecorder(stream, {type: mimeType});
        mediaRecorder.current = media;
        mediaRecorder.current.start();
        let localAudiochunks = [];
        mediaRecorder.current.ondataavailable = (event) => {
            if(typeof event.data === "undefined") return;
            if(event.data.size === 0) return;
            localAudiochunks.push(event.data);
        };
        setAudioChunks(localAudiochunks);

        if(!browserSupportsSpeechRecognition){
            return <span>Browser does not support speech recognition</span>
        }
        else{
            startListening();
        }
    }

    const stopRecording = async () => {
        setRecordingStatus("inactive");
        mediaRecorder.current.stop();
        mediaRecorder.current.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: mimeType});
            const audioURL = URL.createObjectURL(audioBlob);
            setAudio(audioURL);
            setAudioChunks();
        }
        SpeechRecognition.stopListening();
    }

    const getMicrophonePermission = async () => {
      if("MediaRecorder" in window){
        try{
          const streamData = await navigator.mediaDevices.getUserMedia({
            audio: true,
            video: false,
          });
          setPermission(true);
          setStream(streamData);
        }
        catch(err){
          alert(err.message);
        }
      }
      else{
        alert("The MediaRecorder API is not supported in your browser.");
      }
    };

    return(
        <div>
            <h1>Record Audio</h1>
            <main>
                <div>
                    {!permission ? (
                        <button onClick={getMicrophonePermission} type="button">
                            Get Microphone
                        </button> 
                    ): null}

                    {permission && recordingStatus === "inactive" ? (
                        <div>
                            <button onClick={startRecording} type="button">
                                Start Recording
                            </button>
                        </div>
                    ) : null}

                    {recordingStatus === "recording" ? (
                        <button onClick={stopRecording} type="button">
                            Stop Recording
                        </button>
                    ) : null}

                    {audio ? (
                        <div>
                            <audio src={audio} controls></audio>
                            <br></br>
                            <a download href={audio}>
                                Download Recording
                            </a>
                        </div>
                    ) : null}
                </div>
                <p>{transcript}</p>
            </main>
        </div>
    )
}
  
export default AudioRecorder;