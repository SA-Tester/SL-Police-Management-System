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

let district = document.getElementById("district");
let city = document.getElementById("city");
let lat = document.getElementById("lat");
let lon = document.getElementById("lon");

// Add the first optiona as null and --None-- to avoid user misguidance casued on event listener "change"
city.options[0] = new Option("--None--","");
let City;

district.addEventListener("change", function(){   
    switch (district.value){
        case "ampara":
            City = Ampara;
            break;

        case "aunuradhapura":
            City = Anuradhapura;
            break;

        case "badulla":
            City = Badulla;
            break;

        case "batticaloa":
            City = Batticaloa;
            break;

        case "colombo":
            City = Colombo;
            break;

        case "galle":
            City = Galle;
            break;

        case "gampaha":
            City = Gampaha;
            break;

        case "hambantota":
            City = Hambantota;
            break;

        case "jaffna":
            City = Jaffna;
            break;

        case "kalutara":
            City = Kalutara;
            break;

        case "kandy":
            City = Kandy;
            break;
        
        case "kegalle":
            City = Kegalle;
            break;

        case "killinochchi":
            City = Killinochchi;
            break;

        case "kurunegala":
            City = Kurunegala;
            break;


        case "mannar":
            City = Mannar;
            break;

        case "matale":
            City = Matale;
            break;

        case "matara":
            City = Matara;
            break;

        case "monaragala":
            City = Monaragala;
            break;

        case "mullaitivu":
            City = Mullaitivu;
            break;

        case "nuwara-eliya":
            City = Nuwara_Eliya;
            break;

        case "polonnaruwa":
            City = Polonnaruwa;
            break;

        case "puttalam":
            City = Puttalam;
            break;

        case "ratnapura":
            City = Ratnapura;
            break;

        case "trincomalee":
            City = Trincomalee;
            break;

        case "vavuniya":
            City = Vavuniya;
            break;

        default:
            district = document.getElementById("district");
            break;
    }

    lat.value = "";
    lon.value = "";
    addCitites();
    addCoordinates();
});

function addCitites(){
    for(let i=0; i<City.length; i++){
        city.options[i+1] = new Option(City[i]["city"], City[i]["city"]);
    }
}

function addCoordinates(){
    city.addEventListener("change", function(){
        for(let i=0; i<City.length; i++){
            if(city.value == City[i]["city"]){
                lat.value = City[i]["latitude"];
                lon.value = City[i]["longitude"];
            }
        }
    });
}