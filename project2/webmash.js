//Last Name: Karandikar
//First Name: Shradha
//Project No: 2
//Due Date : 10/26/2016

//Map API key: AIzaSyBTejBnYZxaAa8V4H1PUhceU7W7qnuBqd4
//Geonames Api key: shradha
// Put your zillow.com API key here

var username = "shradha";
var request = new XMLHttpRequest();
var markers=[];
var temperature;
var windspeed;
var clouds;
  

//initMap() which initiates map to a location
function initMap() {

  //initialize map
  
  //Initialize a mouse click event on map which then calls reversegeocode function
      var uluru = {lat:32.75, lng: -97.13};
      sendRequest(32.75,-97.13);
      //Map
      var map = new google.maps.Map(document.getElementById('map'), {

          zoom: 17,
          center: uluru
      });
      //marker
      var marker = new google.maps.Marker({
          position: uluru,
          map: map,
         
      });
      
      markers.push(marker);

      var geocoder = new google.maps.Geocoder;
      var infowindow = new google.maps.InfoWindow;
       
      
        
      google.maps.event.addListener(map, "click", function (event) {

         // markers[markers.length-1].setMap(null);
      var latitude =event.latLng.lat();
      var longitude =event.latLng.lng();
      sendRequest(latitude,longitude);
      
      uluru = {lat:latitude,lng:longitude};
      console.log(uluru);  
     
                    
            
      reversegeocode(geocoder,map,infowindow,latitude,longitude,marker);
      //console.log("hiii"+latitude +"  "+longitude);

     
      });

      document.getElementById("clear").addEventListener("click", function(){
          console.log("hello");
          var tbl1 = document.getElementById('table');
          tbl1.innerHTML = "";
          
      });




 
}


function clear(){
     for(var i=0;i<markers.length;i++){  
        
            if(markers[i]!=0){
            markers[i].setMap(null);
            markers[i]=0;
           }
    }
}


// Reserse Geocoding 
function reversegeocode(geocoder,map,infowindow,latitude,longitude,marker) {

  //get the latitude and longitude from the mouse click and get the address.
  //call geoname api asynchronously with latitude and longitude 
  
    var latlng = {lat: latitude, lng: longitude};
    geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      
      if (results[1]) {

        map.setZoom(17);
        marker.setPosition(latlng);
        
      
        var content=results[0].formatted_address +'<br>'+ "Temperature  :"+temperature+
        '<br>'+ "Windspeed  :"+windspeed+'<br>'+ "Clouds  :"+clouds;


       // var contentRow=results[0].formatted_address+"  "+"Temperature  :"+temperature+
        //"  "+ "Windspeed  :"+windspeed+"  "+ "Clouds  :"+clouds;
        var  cell1=results[0].formatted_address;
        var cell2="Temperature  :"+temperature+" , "+ "Windspeed  :"+windspeed+" , "+ "Clouds  :"+clouds;
        console.log(content);
        infowindow.setContent(content);

       //var res=results[1].address_components.toString;
        //infowindow.setContent(res);
        
        var table = document.getElementById("table");


        var newRow   = table.insertRow(table.rows.length);

          // Insert a cell in the row at index 0
        var newCell  = newRow.insertCell(0);
        var newCell1=newRow.insertCell(1);

          // Append a text node to the cell
        var newText  = document.createTextNode(cell1);
        newCell.appendChild(newText);
        var newText1  = document.createTextNode(cell2);
        newCell1.appendChild(newText1);


        infowindow.open(map, marker);
        
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
  
}// end of geocodeLatLng()



//Ajax Response weather details : temperature,windspeed and cloud
function displayResult () {
    if (request.readyState == 4 && request.status==200) {
        var xml = request.responseXML.documentElement;
       
        temperature=xml.getElementsByTagName("temperature")[0].childNodes[0].nodeValue;
        windspeed=xml.getElementsByTagName("windSpeed")[0].childNodes[0].nodeValue;
        clouds=xml.getElementsByTagName("clouds")[0].childNodes[0].nodeValue;
        //console.log(temperature +windspeed+clouds);
    
    }
}



//Ajax request
function sendRequest (latitude,longitude) {

    request.onreadystatechange = displayResult;
    var lat = latitude;
    var lng = longitude;
    var url="http://api.geonames.org/findNearByWeatherXML?&lat="+lat+"&lng="+lng+"&username="+username;
    request.open("GET",url,true);
    request.send();
}
