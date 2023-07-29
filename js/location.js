// Resource Attributes
// Location Pin: <a href="https://www.flaticon.com/free-icons/pin" title="pin icons">Pin icons created by Freepik - Flaticon</a>
// API: https://worldwind.arc.nasa.gov/web/
// References: https://github.com/NASAWorldWind/WebWorldWind/blob/develop/examples/PlacemarksAndPicking.js


// INITIATING THE WORLDWIND GLOBE -----------------------------------------------------------------------------------------------
var wwd = new WorldWind.WorldWindow("worldwindCanvas");
wwd.addLayer(new WorldWind.BMNGOneImageLayer()); // NASA's Blue Marble
wwd.addLayer(new WorldWind.BMNGLandsatLayer()); // LAN Sat Imagery
wwd.addLayer(new WorldWind.CompassLayer()); // Compass
wwd.addLayer(new WorldWind.CoordinatesDisplayLayer(wwd)); //Coordinates
wwd.addLayer(new WorldWind.ViewControlsLayer(wwd)); // View Controls
placemarkLayer = new WorldWind.RenderableLayer("Placemarks");
wwd.addLayer(placemarkLayer);

wwd.navigator.lookAtLocation.latitude = 7.8731;
wwd.navigator.lookAtLocation.longitude = 80.7718;
wwd.navigator.range = 550000;

placemarkAttributes = new WorldWind.PlacemarkAttributes();
placemarkAttributes.imageSource = "../assets/pin.png";
placemarkAttributes.imageOffset = new WorldWind.Offset(
    WorldWind.OFFSET_FRACTION, 0.3,
    WorldWind.OFFSET_FRACTION, 1);

highlightAttributes = new WorldWind.PlacemarkAttributes(placemarkAttributes);
highlightAttributes.imageScale = 1.5;
// ----------------------------------------------------------------------------------------------------------------------------

// GET ALREADY AVAILABLE DATA FROM PHP ----------------------------------------------------------------------------------------
let xhr = new XMLHttpRequest();
xhr.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        var obj = JSON.parse(this.responseText);

        for(let i=0; i<obj.length; i++){
            var empID = obj[i][0];
            var duty = obj[i][1];
            var city = obj[i][2];
            var lat = obj[i][3];
            var lon = obj[i][4];

            addPlacemark(duty, city, empID, parseFloat(lat), parseFloat(lon));

            console.log(obj[i][0] + " " + obj[i][1] + " " + obj[i][2] + " " + obj[i][3] + " ");
        }
    }
    else{
        console.log(this.status);
    }
}
xhr.open("GET", "../src/scripts/location-data.php", true);
xhr.send();
// ----------------------------------------------------------------------------------------------------------------------------

function addPlacemark(duty, city, empID, latitude, longitude){
    placemark = new WorldWind.Placemark(new WorldWind.Position(latitude, longitude, 1e2), true, null);
    placemark.label = duty + ": " + city + "\n" + empID;
    placemark.altitudeMode = WorldWind.RELATIVE_TO_GROUND;
    placemark.attributes = placemarkAttributes;
    placemark.highlightAttributes = highlightAttributes;
    
    placemarkLayer.addRenderable(placemark);
    wwd.redraw();
}

// PICKING FUNCTION -------------------------------------------------------------------------------------------------------
var highlightedItems = [];
var handlePick = function (o) {
    var x = o.clientX,
        y = o.clientY;

    var redrawRequired = highlightedItems.length > 0; // must redraw if we de-highlight previously picked items

    // De-highlight any previously highlighted placemarks.
    for (var h = 0; h < highlightedItems.length; h++) {
        highlightedItems[h].highlighted = false;
    }
    highlightedItems = [];

    // Perform the pick. Must first convert from window coordinates to canvas coordinates, which are
    // relative to the upper left corner of the canvas rather than the upper left corner of the page.
    var pickList = wwd.pick(wwd.canvasCoordinates(x, y));
    if (pickList.objects.length > 0) {
        redrawRequired = true;
    }

    // Highlight the items picked by simply setting their highlight flag to true.
    if (pickList.objects.length > 0) {
        for (var p = 0; p < pickList.objects.length; p++) {
            pickList.objects[p].userObject.highlighted = true;

            // Keep track of highlighted items in order to de-highlight them later.
            highlightedItems.push(pickList.objects[p].userObject);
        }
    }

    // Update the window if we changed anything.
    if (redrawRequired) {
        wwd.redraw(); // redraw to make the highlighting changes take effect on the screen
    }
};

wwd.addEventListener("mousemove", handlePick);
// ----------------------------------------------------------------------------------------------------------------------------