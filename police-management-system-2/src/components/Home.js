import React from "react"
import Navbar from './Navbar'

import { Link } from "react-router-dom";
import HeroImage from "./HerImage";

const Home = () => {
    return (
        <div>
          <Navbar/> 
          <HeroImage/> 
        </div>
    );
};

export default Home;
