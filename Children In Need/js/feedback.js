$(document).ready(function () {
// Get Images from Imgur
   var settings = {
  "url": "https://api.imgur.com/3/album/WOPN9yV/images",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer 316f5533dd9ea9e53508e0e57749aed346fdc9f2"
  },
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

  		//code for row fix on showing images
          $.ajax(settings).done(function (response) {
            var photoHTML = "";
            //Loop through JSON data
            var loopCount = 0;
            $.each(response.data, function(i, images) {
              photoHTML += '<div class="col-md-4"><img src="'+images.link+'"class="img-responsive" title="'+images.description+'" /><br /><p>'+images.description+'</p></div>';
                
                loopCount++;
                if(loopCount == 3)
				{
                    photoHTML += '<div style="clear:both"></div>';
                    loopCount = 0;
                }
            }); //end each

            
        $('#imgur-images').html(photoHTML);

        console.log(response);
        });
    });