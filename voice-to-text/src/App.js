import React from "react";
// import SpeechRecognition, { useSpeechRecognition } from 'react-speech-recognition';
import AudioRecorder from "../src/AudioRecorder";

const Recorder = () => {
  return (
    <div>
      {<AudioRecorder/>}
    </div>
  );
}

// short function syntax
/*const Dictaphone = () => {
  const{
    transcript,
    listening,
    resetTranscript,
    browserSupportsSpeechRecognition
  } = useSpeechRecognition();

  // Overriding the defualt method
  const startListening = () => SpeechRecognition.startListening({continuous: true});

  if(!browserSupportsSpeechRecognition){
    return <span>Browser does not support speech recognition</span>
  }
  
  return(
    <div>
      <p>Microphone: {listening ? 'on' : 'off'}</p>
      <button onClick={startListening}>Start</button>
      <button onClick={SpeechRecognition.stopListening}>Stop</button>
      <button onClick={resetTranscript}>Reset</button>
      <p>{transcript}</p>
    </div>
  );
};*/

const UI = () =>{
  return(
    Recorder()
  );
}

export default UI;