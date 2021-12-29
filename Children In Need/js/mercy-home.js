//Current Weather Function
$(document).ready(function () {
	$.getJSON("https://api.openweathermap.org/data/2.5/weather?id=5128638&units=metric&appid=f930c97931bb04fca38dfec9bce3ae3d", function(data) {
			
	//pull out the values here
	cityName=data["name"];
	lon = data["coord"]["lon"];
	lat = data["coord"]["lat"];
	weatherDescription = data["weather"][0]["description"];
	getNearestAirport(lon, lat);
	temp = data["main"]["temp"];
			
	//output to browser here
	$("#weather").html(weatherDescription);
	$("#temperature").html("Current Temperature: "+temp+" °C");
	getAirQuality(lon, lat);
			
//Nearest Airport Function
	function getNearestAirport(lon, lat)
	{
		const settings = {
		"async": true,
		"crossDomain": true,
		"url": "https://aerodatabox.p.rapidapi.com/airports/search/location/"+lat+"/"+lon+"/km/100/1?withFlightInfoOnly=false",
		"method": "GET",
		"headers": {
			"x-rapidapi-key": "432fb48385mshf98ea65c204c04ap130effjsn02717285b27e",
			"x-rapidapi-host": "aerodatabox.p.rapidapi.com"
			}
		};

			$.ajax(settings).done(function (response) {
				console.log(response);
				iataCode = response.items[0].iata;
				//$("#airport").html(iataCode);
				getAirportDetails(iataCode);
				});
			}
			function getAirportDetails(iataCode)
			{
				const settings = {
				"async": true,
				"crossDomain": true,
				"url": "https://airport-info.p.rapidapi.com/airport?iata="+iataCode,
				"method": "GET",
				"headers": {
					"x-rapidapi-key": "432fb48385mshf98ea65c204c04ap130effjsn02717285b27e",
					"x-rapidapi-host": "airport-info.p.rapidapi.com"
				}
			};

			$.ajax(settings).done(function (response) {
				console.log(response);
				var airportText = "";
				airportText += "Airport Name: " +response.name+" <br /> <br />" ; 
				airportText += "Airport IATA Code: " +response.iata+" <br /> <br />";
				airportText += "Airport Location: " +response.location+" <br /> <br />";
				airportText += "Phone Number: " +response.phone+" <br /> <br />";
				airportText += "Website: <a href='"+response.website+"' target='_blank'>"+ response.website+" </a><br />";
				
				$("#airport").html(airportText);
			});
		};
		
//Current Time Function
	var settings = {
	"async": true,
	"crossDomain": true,
	"url": "https://world-time2.p.rapidapi.com/timezone/America/New_York",
	"method": "GET",
	"headers": {
		"x-rapidapi-host": "world-time2.p.rapidapi.com",
		"x-rapidapi-key": "432fb48385mshf98ea65c204c04ap130effjsn02717285b27e"
	}
}

$.ajax(settings).done(function (response) {
	console.log(response);


    var timeInfo = "";
    timeInfo += "Current Time: "+response.datetime+" <br/> <br/>";
    timeInfo += "Timezone: "+response.timezone+"<br/> <br/>";
    timeInfo += "UTC offset: "+response.utc_offset+"<br/> <br/>";

    $("#time").html(timeInfo);        
});

//Imgur Function to Get Images

var settings = {
    "url": "https://api.imgur.com/3/album/Vc7ppOp/images",
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Authorization": "Bearer 316f5533dd9ea9e53508e0e57749aed346fdc9f2",
    },
  };

  		//code for row fix on showing images
          $.ajax(settings).done(function (response) {
            var photoHTML = "";
            //Loop through JSON data
            var loopCount = 0;
            $.each(response.data, function(i, images) {
              photoHTML += '<div class="col-md-4"><img src="'+images.link+'"class="img-responsive" title="'+images.description+'" /><br /></div>';
                
                loopCount++;
                if(loopCount == 3)
				{
                    photoHTML += '<div style="clear:both"></div>';
                    loopCount = 0;
                }
            }); //end each
            
        $("#imgur-images").html(photoHTML);
        // To double check 
        console.log(response);
        });
		
//Air Quality Function
function getAirQuality(lon, lat)
	{
	const settings = {
	"async": true,
	"crossDomain": true,
	"url": "https://air-quality.p.rapidapi.com/current/airquality?lat="+lat+"&lon="+lon,
	"method": "GET",
	"headers": {
		"x-rapidapi-key": "432fb48385mshf98ea65c204c04ap130effjsn02717285b27e",
		"x-rapidapi-host": "air-quality.p.rapidapi.com"
		}
	};

	$.ajax(settings).done(function (response) {
		console.log(response.data);
		var AQI = ""
		AQI+= " Air Quality Index: "+response.data[0].aqi+" <br />";
				
		$("#aqi").html(AQI);
				
		});
	}	
});

		

	});