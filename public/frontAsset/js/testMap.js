var map;
var marker;
var i=0;
function initMap() {
    var myLatLng = {lat: 23.818448, lng: 90.370739};
    var mapOptions = {
        zoom: 15,
        center: new google.maps.LatLng(23.818448, 90.370739)
    };
    map = new google.maps.Map(document.getElementById('google_map'), mapOptions);
}

function markerRefresh()
{
   getLocation();
//console.log(obj);
    //lat = obj[i].latitude;
    //lng = obj[i].longtitude;



    console.log(lat);
    console.log(lng);
    var myLatLng = {lat: lat, lng: lng};
    if(marker && marker.setMap) {
        marker.setMap(null);
    }
    marker = new google.maps.Marker({
        position: myLatLng,
        animation: google.maps.Animation.drop,
        map: map,
        title: 'Hello World!'
    });

}

$(document).ready(function() {
    initMap();

    markerRefresh();
    setInterval(markerRefresh, 15000);

});