function showProfilePicture()
{
    $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var urladdress = obj.picture;
                                    
                    var msg = "<image src=" + urladdress + " style='width: 100%' />";
                    msg+= "<button id='changePicture_btn' style='position:absolute; left:1%; top: 5%' onclick='showChangeProfileDialog()'> Change Picture </button>";
                    
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
            url:"http://localhost:8888/index.php/pages/change_picture",
            data:{ "key" : key},
            success: function(response)
            {        
               showProfilePicture();
            }
        });
}