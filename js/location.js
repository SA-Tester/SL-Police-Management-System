var wwd = new WorldWind.WorldWindow("worldwindCanvas");
wwd.addLayer(new WorldWind.BMNGOneImageLayer()); // NASA's Blue Marble
wwd.addLayer(new WorldWind.BMNGLandsatLayer()); // LAN Sat Imagery
wwd.addLayer(new WorldWind.CompassLayer()); // Compass
wwd.addLayer(new WorldWind.CoordinatesDisplayLayer(wwd)); //Coordinates
wwd.addLayer(new WorldWind.ViewControlsLayer(wwd)); // View Controls

//var position = new WorldWind.Position(7.8731, 80.7718,550000); // Sri Lanka from 550 km altitude
//wwd.goTo(new WorldWind.Location(position));

wwd.navigator.lookAtLocation.latitude = 7.8731;
wwd.navigator.lookAtLocation.longitude = 80.7718;
wwd.navigator.range = 550000;
wwd.redraw();