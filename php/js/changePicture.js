function showProfilePicture()
{
    $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var urladdress = obj.picture;
                                    
                    var msg = "<image src=" + urladdress + " width= 220px; height=150px />";
                    msg+= "<button id='changePicture_btn' style='position:absolute; left:160px; top:50px' onclick='showChangeProfileDialog()'> Change </button>";
                    
                    document.getElementById('profilePictureDiv').innerHTML = msg;
                    
                    $("#changePicture_btn").hide();
                    
                }
    
    });
    
}


function changePicture()
{
   
      var key = $("#pictureURLtxt").val();
     
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/change_picture",
            data:{ "key" : key},
            success: function(response)
            {        
               showProfilePicture();
            }
        });
}