import { Ampara } from "../assets/sl-cities/ampara.js";
import { Anuradhapura } from "../assets/sl-cities/anuradhapura.js";
import { Badulla } from "../assets/sl-cities/badulla.js"
import { Batticaloa } from "../assets/sl-cities/batticaloa.js"
import { Colombo } from "../assets/sl-cities/colombo.js";
import { Galle } from "../assets/sl-cities/galle.js"
import { Gampaha } from "../assets/sl-cities/gampaha.js";
import { Hambantota } from "../assets/sl-cities/hambantota.js";
import { Jaffna } from "../assets/sl-cities/jaffna.js";
import { Kalutara } from "../assets/sl-cities/kalutara.js";
import { Kandy } from "../assets/sl-cities/kandy.js";
import { Kegalle } from "../assets/sl-cities/kegalle.js";
import { Killinochchi } from "../assets/sl-cities/killinochchi.js";
import { Kurunegala } from "../assets/sl-cities/kurunegala.js";
import { Mannar } from "../assets/sl-cities/mannar.js";
import { Matale } from "../assets/sl-cities/matale.js";
import { Matara } from "../assets/sl-cities/matara.js";
import { Monaragala } from "../assets/sl-cities/monaragala.js";
import { Mullaitivu } from "../assets/sl-cities/mullaitivu.js";
import { Nuwara_Eliya } from "../assets/sl-cities/nuwara-eliya.js";
import { Polonnaruwa } from "../assets/sl-cities/polonnaruwa.js";
import { Puttalam } from "../assets/sl-cities/puttalam.js";
import { Ratnapura } from "../assets/sl-cities/ratnapura.js";
import { Trincomalee } from "../assets/sl-cities/trincomalee.js";
import { Vavuniya } from "../assets/sl-cities/vavuniya.js";

district.addEventListener("change", function(event){
    let district = document.getElementById("district");
    let city = document.getElementById("city");

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

        case "galle":
            for(let i=0; i<Galle.length; i++){
                city.options[i] = new Option(Galle[i]["city"], Galle[i]["city"]);
            }
            break;

        case "gampaha":
            for(let i=0; i<Gampaha.length; i++){
                city.options[i] = new Option(Gampaha[i]["city"], Gampaha[i]["city"]);
            }
            break;

        case "hambantota":
            for(let i=0; i<Hambantota.length; i++){
                city.options[i] = new Option(Hambantota[i]["city"], Hambantota[i]["city"]);
            }
            break;

        case "jaffna":
            for(let i=0; i<Jaffna.length; i++){
                city.options[i] = new Option(Jaffna[i]["city"], Jaffna[i]["city"]);
            }
            break;

        case "kalutara":
            for(let i=0; i<Kalutara.length; i++){
                city.options[i] = new Option(Kalutara[i]["city"], Kalutara[i]["city"]);
            }
            break;

        case "kandy":
            for(let i=0; i<Kandy.length; i++){
                city.options[i] = new Option(Kandy[i]["city"], Kandy[i]["city"]);
            }
            break;
        
        case "kegalle":
            for(let i=0; i<Kegalle.length; i++){
                city.options[i] = new Option(Kegalle[i]["city"], Kegalle[i]["city"]);
            }
            break;

        case "killinochchi":
            for(let i=0; i<Killinochchi.length; i++){
                city.options[i] = new Option(Killinochchi[i]["city"], Killinochchi[i]["city"]);
            }
            break;

        case "kurunegala":
            for(let i=0; i<Kurunegala.length; i++){
                city.options[i] = new Option(Kurunegala[i]["city"], Kurunegala[i]["city"]);
            }
            break;


        case "mannar":
            for(let i=0; i<Mannar.length; i++){
                city.options[i] = new Option(Mannar[i]["city"], Mannar[i]["city"]);
            }
            break;

        case "matale":
            for(let i=0; i<Matale.length; i++){
                city.options[i] = new Option(Matale[i]["city"], Matale[i]["city"]);
            }
            break;

        case "matara":
            for(let i=0; i<Matara.length; i++){
                city.options[i] = new Option(Matara[i]["city"], Matara[i]["city"]);
            }
            break;

        case "monaragala":
            for(let i=0; i<Monaragala.length; i++){
                city.options[i] = new Option(Monaragala[i]["city"], Monaragala[i]["city"]);
            }
            break;

        case "mullaitivu":
            for(let i=0; i<Mullaitivu.length; i++){
                city.options[i] = new Option(Mullaitivu[i]["city"], Mullaitivu[i]["city"]);
            }
            break;

        case "nuwara-eliya":
            for(let i=0; i<Nuwara_Eliya.length; i++){
                city.options[i] = new Option(Nuwara_Eliya[i]["city"], Nuwara_Eliya[i]["city"]);
            }
            break;

        case "polonnaruwa":
            for(let i=0; i<Polonnaruwa.length; i++){
                city.options[i] = new Option(Polonnaruwa[i]["city"], Polonnaruwa[i]["city"]);
            }
            break;

        case "puttalam":
            for(let i=0; i<Puttalam.length; i++){
                city.options[i] = new Option(Puttalam[i]["city"], Puttalam[i]["city"]);
            }
            break;

        case "ratnapura":
            for(let i=0; i<Ratnapura.length; i++){
                city.options[i] = new Option(Ratnapura[i]["city"], Ratnapura[i]["city"]);
            }
            break;

        case "trincomalee":
            for(let i=0; i<Trincomalee.length; i++){
                city.options[i] = new Option(Trincomalee[i]["city"], Trincomalee[i]["city"]);
            }
            break;

        case "vavuniya":
            for(let i=0; i<Vavuniya.length; i++){
                city.options[i] = new Option(Vavuniya[i]["city"], Vavuniya[i]["city"]);
            }
            break;

        default:
            district = document.getElementById("district");
            break;
    }
});