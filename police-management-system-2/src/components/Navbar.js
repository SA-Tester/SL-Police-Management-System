import { Link } from "react-router-dom";
import "./Navbar.css";
import {FaBars, FaTimes} from "react-icons/fa";

import React, { useState } from 'react'

const Navbar = () => {
    const [click, setClick] = useState(false);
    const handleClick = () => setClick(!click);
  return (
    <div className="header">
        <Link to="/">
            <h1>Sri Lanka Police</h1>
        </Link>
        <ul className={click ? "nav-menu active" : "nav-menu"} type="none">
            <li>
                <Link to="/">Home</Link>
            </li>
            <li>
                <Link to="/contact">Contact</Link>
            </li>
            <li>
                <Link to="/setting">Settings</Link>
            </li>
        </ul>
        <div className="hamburger" onClick={handleClick}>
            {click ? (<FaTimes  size={20} style={{color:"white"}}/>) : (<FaBars  size={20} style={{color:"white"}}/>)}
          
        </div>
    </div>
  )
}

export default Navbar