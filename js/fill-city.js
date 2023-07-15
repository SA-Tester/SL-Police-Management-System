import { Ampara } from "../assets/sl-cities/ampara.js";
import { Anuradhapura } from "../assets/sl-cities/anuradhapura.js";
import { Badulla } from "../assets/sl-cities/badulla.js"
import { Batticaloa } from "../assets/sl-cities/batticaloa.js"
import { Colombo } from "../assets/sl-cities/colombo.js";
import { Galle } from "../assets/sl-cities/galle.js"
import { Gampaha } from "../assets/sl-cities/gampaha.js";

let district = document.getElementById("district");
let city = document.getElementById("city");

district.addEventListener("click", function(event){
    switch (district.value){
        case "ampara":
            for(let i=0; i<Ampara.length; i++){
                city.options[i] = new Option(Ampara[i]["city"], Ampara[i]["city"]);
            }
            break;

        case "aunuradhapura":
            for(let i=0; i<Anuradhapura.length; i++){
                city.options[i] = new Option(Anuradhapura[i]["city"], Anuradhapura[i]["city"]);
            }
            break;

        case "badulla":
            for(let i=0; i<Badulla.length; i++){
                city.options[i] = new Option(Badulla[i]["city"], Badulla[i]["city"]);
            }
            break;

        case "batticaloa":
            for(let i=0; i<Batticaloa.length; i++){
                city.options[i] = new Option(Batticaloa[i]["city"], Batticaloa[i]["city"]);
            }
            break;

        case "colombo":
            for(let i=0; i<Colombo.length; i++){
                city.options[i] = new Option(Colombo[i]["city"], Colombo[i]["city"]);
            }
            break;

        case "gampaha":
            for(let i=0; i<Gampaha.length; i++){
                city.options[i] = new Option(Gampaha[i]["city"], Gampaha[i]["city"]);
            }
            break;

        case "galle":
            for(let i=0; i<Galle.length; i++){
                city.options[i] = new Option(Galle[i]["city"], Galle[i]["city"]);
            }
            break;
    }
});