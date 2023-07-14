import "./HeroImage.css";
import React from 'react'
import IntroImg from "../images/intro-bg2.jpg"
import { Link } from "react-router-dom";
const HeroImage = () => {
  return (
    <div className="hero">
        <div className="mask">
            <img className="intro-img" src={IntroImg} alt="IntroImg"/>
        </div>
        <div className="content">
            <p   style={{color:"white"}}>Welcome to the</p>
            <h1  style={{color:"white"}}>SRI LANKA POLICE STATIONS MANAGEMENT SYSTEM</h1>
            
        </div>
        <div>
            <Link to="/register" className="btn">REGISTER</Link>
        </div>
    </div>
  )
}

export default HeroImage