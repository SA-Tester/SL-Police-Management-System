// Reference 1: https://blog.logrocket.com/how-to-create-video-audio-recorder-react/
// Reference 2: React Speech Recognition Library

import React from "react";
import { useState, useRef } from "react";
import SpeechRecognition, { useSpeechRecognition } from "react-speech-recognition";

const mimeType = "audio/webm";

// short function syntax
export const AudioRecorder = () =>{
    const [permission, setPermission] = useState(false);
    const mediaRecorder = useRef(null);
    const [recordingStatus, setRecordingStatus] = useState("inactive"); //recording status: recording, inactive, paused
    const [stream, setStream] = useState(null);
    const [audioChunks, setAudioChunks] = useState([]); // audio chunks = encoded pieces of audio recording
    const [audio, setAudio] = useState(null); // audio: blob URL to finished audio recording
    let msg = useState(null);

    const{
        transcript,
        browserSupportsSpeechRecognition
    } = useSpeechRecognition();

    // Overriding the defualt method
    const startListening = () => SpeechRecognition.startListening({continuous: true});
    const stopListening = () => SpeechRecognition.startListening();

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
        startListening();
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

        stopListening();
        msg = transcript; // CAN't DISPLAY ON THE OTHER SIDE: FIX IT
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

    return{
        permission,
        recordingStatus,
        getMicrophonePermission,
        startRecording,
        stopRecording,
        msg,
        audio
    };
}