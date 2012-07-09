<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title> Welcome to Gardenshift</title>
	
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<link href="../../css/style.css" rel="stylesheet" type="text/css"/>
<link href="../../css/jquery-ui.css" rel="stylesheet" type="text/css"/>  
<link rel="stylesheet" type="text/css" href="../../css/jquery.validate.css" />
<link rel="stylesheet" type="text/css" href="../../css/style1.css" />
<link rel="stylesheet" type="text/css" href="../../css/userpage.css" />
<link href="https://code.google.com/apis/maps/documentation/javascript/examples/standard.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>

<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/formValidation.js" type="text/javascript"></script>
<script src="../../js/main_init.js" type="text/javascript"></script>

<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0; background-image: url("../../images/plain.png"); background-size: 100% 100%; background-repeat: repeat; }
      #map_canvas { height: 100% }
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA8k4FFdveeM0HszPabxQCNOfGmZGTUqDQ&sensor=false"></script>

    
<style type="text/css" title="currentStyle">
        @import "../../css/demo_page.css";
        @import "../../css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>



 
</head>

<script>  
    
    
    
    function showAvailableCrops()
    {
        // Populate crops table for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' style='width: 100px;' cellspacing='0' border='0' id='userCropsTable' width='50%'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";
                            msg += "<th>Crop</th>";
                            msg += "<th>Quantity</th>";
                            msg += "<th>Harvestation Date</th>";
                            msg += "<th>Email</th>";
                            msg += "<th>Zipcode</th>";
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                    for(i=0; i< obj.length; i++)
                        {
                            
                            if(!isNaN(obj[i].user_crops.length))
                                {
                                    for(j=0; j< obj[i].user_crops.length; j++)
                                        {
                                            msg += "<tr>";
                                            msg += "<td>" + obj[i].name + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_name + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_expected_quantity + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_harvest_date + "</td>";
                                            msg += "<td>" + obj[i].email + "</td>";
                                            msg += "<td>" + obj[i].zipcode + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].comments + "</td>";
                                            msg += "</tr>";                                          
                                        }
                                    
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('crops').innerHTML = msg;
                     
                     $("#userCropsTable").dataTable( {
                                    "sScrollY": "200px",
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
  
  
    
    }
    
    
    function showAllFeedbacks_f()
    {
               
        showAllFeedback();
    }
     
    
    function showAllfGuestFeedback_f()
    {
        
        $("#feedbackPopUp").dialog('open');
    }
    
    
    function showAllFeedback()
    {
        // Populate feedback table for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' cellspacing='0' border='0' id='feedbackTable'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";                    
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                    for(i=0; i< obj.feedback.length; i++)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<tr>";
                                            msg += "<td>" + obj.feedback[i].from + "</td>";
                                            msg += "<td>" + obj.feedback[i].text + "</td>";
                                            msg += "</tr>";                                          
                                     
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('feedbackPopUp').innerHTML = msg;
                     
                     $("#feedbackTable").dataTable( {
                                  
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
            
               $( "#feedbackPopUp" ).dialog('open');
             
               
    
    }
    
    
    function showRecentFeedback()
    {
        // Populate feedback div for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
 
                            
                    for(i=obj.feedback.length -1; i>=0; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.feedback[i].from + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.feedback[i].text + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.feedback.length - i == 3 )
                                break;
                                    
                                
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('feedbackDiv').innerHTML = msg;
                     
                     document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn'>(" + obj.feedback.length +")</a>";
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
   
   // Show past and Recent Crops
   
   function showAllCrops()
    {
        // Populate feedback table for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_recent_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' style='width: 100px;' cellspacing='0' border='0' id='userCropsTable' width='50%'>";
                            msg += "<thead><tr>";
                           
                            msg += "<th>Crop</th>";
                            msg += "<th>Quantity</th>";
                            msg += "<th>Harvestation Date</th>";
                            
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                     
                            if(!isNaN(obj.user_crops.length))
                                {
                                    for(j=0; j< obj.user_crops.length; j++)
                                        {
                                            msg += "<tr>";
                                          
                                            msg += "<td>" + obj.user_crops[j].crop_name + "</td>";
                                            msg += "<td>" + obj.user_crops[j].crop_expected_quantity + "</td>";
                                            msg += "<td>" + obj.user_crops[j].crop_harvest_date + "</td>";
                                           
                                            msg += "<td>" + obj.user_crops[j].comments + "</td>";
                                            msg += "</tr>";                                          
                                        }
                                    
                                }
                       
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('CropsDiv').innerHTML = msg;
                     
                     $("#userCropsTable").dataTable( {
                                    "sScrollY": "200px",
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
  
  
    
    }
    
    
    function showRecentCrops()
    {
        // Populate feedback div for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_recent_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
 
                            
                    for(i= obj.user_crops.length - 1; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.user_crops[i].crop_name + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.user_crops[i].crop_harvest_date + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.user_crops.length - i == 3 )
                                break;
                                    
                                
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('CropsDiv').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    
    function showRecentStatus()
    {
        // Populate stauts div for all the available status
           
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                    
                   
 
                            
                    for(i= obj.status.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.status.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.status[i].text + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.status[i].date + "</a>";
                                            msg += "<img src='../../images/delete.png' width= 15px height=15px align='right' onclick='deleteStatus(this.id)' id='" + obj.status[i].date + "' /> </p>";
                                            msg += "</li>";                                          
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('statusDiv').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    function showRecentFriends()
    {
        // Populate stauts div for all the available status
        
        var total_friends = 0;
        document.getElementById('friendsText').innerHTML = "Friends (0)";
               
           
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                   
                    
                   
 
                            
                    for(i= obj.friends.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            if(obj.friends[i].status == "accepted")
                                                {
                                                        msg += "<li>";
                                                        msg += "<h3>" + obj.friends[i].friends_username + "</h3>";
                                                        msg += "</li>";
                                                        total_friends++;
                                                }
                                            
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                    
                   
                     document.getElementById('friendsDiv').innerHTML = msg;
                     
                     document.getElementById('friendsText').innerHTML = "Friends (" + total_friends + ")";
                   
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    function deleteStatus(statusDate)
    {
          
            
        var key = statusDate;
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/delete_status",
            data:{ "key" : key},
            success: function(response)
            {    
                 showRecentStatus();
                 $('#status_txtbox').val("");
            }
        });
    }
    
    function updateStatus()
    {
        update = $('#status_txtbox').val();
        
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/post_status",
            data:{ "status" : update},
            success: function(response)
            {
                 showRecentStatus();
                 $('#status_txtbox').val("");
            }
        });
    }
    
    
    function addFriends(name)
    {
          
            
        var key = name;
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/add_friends",
            data:{ "key" : key},
            success: function(response)
            {    
               
                 $('#status_txtbox').val("");
                 $('#' + name).hide();
            }
        });
    }
    
    function acceptFriends(name)
    {
          
       
        var key = name;
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/accept_friends",
            data:{ "key" : key},
            success: function(response)
            {    
                $('#status_txtbox').val("");
                 $('#' + name).hide();
                showRecentFriends();
                showPendingFriends();
                
            }
        });
    }
    
    
    function showPendingFriends()
    {
        // Populate pending frieds div for all the available friend request
           
           $("#pendingReq").hide();
            
            
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                   
                    
                   
 
                            
                    for(i= obj.friends.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            if(obj.friends[i].status == "pending")
                                                {
                                                        msg += "<li>";
                                                        msg += "<h3>" + obj.friends[i].friends_username;
                                                        msg += "<button name='addfriends_bt' id='" + obj.friends[i].friends_username +"' style= 'height: 40px;' onclick=acceptFriends(this.id) > Add </button></h3>"; 
                                                        msg += "</li>";    
                                                        
                                                         $("#pendingReq").show();
                                                }
                                            
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                    
                   
                     document.getElementById('pendingFriends').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    
    
    
    function viewProfile()
    {
        
      var total_friends = 0;  
    
      var name = $("#searchField").val();
      
      var addfrndbutton = true; // Stores boolean value to determine if the friend is already in the list or not
    
                     
                    
    
     if(name != "<?php echo $this->session->userdata('username'); ?>")
    
            {
                $("#status_txtbox").hide();
                $("#status_bt").hide();   
                
            }
     else
            {
                $("#status_txtbox").show();
                $("#status_bt").show();  
                $("#pendingReq").show();
            }


    $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/visit_user",
            data: { "name" : name},
            success: function(response)        
            {
                document.getElementById('statusDiv').innerHTML = "No Updates";
                document.getElementById('CropsDiv').innerHTML = "No Recent Crops";
                document.getElementById('feedbackDiv').innerHTML = "No Feedback Received";
                document.getElementById('friendsDiv').innerHTML = "No friends yet";
                document.getElementById('friendsText').innerHTML = "Friends (0)";
                document.getElementById('feedbackText').innerHTML = "Feedbacks (0)";
                  
                   
                
                     
                 var obj = jQuery.parseJSON(response);
                 
              
                    // Update Recent Crops
                    
                    var msg = "<ul>";
 
                            
                    for(i= obj.user_crops.length - 1; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.user_crops[i].crop_name + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.user_crops[i].crop_harvest_date + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.user_crops.length - i == 3 )
                                break;
                                    
                                
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('CropsDiv').innerHTML = msg;
                     
                     
                     // Update Recent Status
                     
                     var msg = "<ul>";
                    
                   
 
                            
                    for(i= obj.status.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.status.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.status[i].text + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.status[i].date + "</a>";
                                            
                                    if(name == "<?php echo $this->session->userdata('username'); ?>")    
                                            msg += "<img src='../../images/delete.png' width= 15px height=15px align='right' onclick='deleteStatus(this.id)' id='" + obj.status[i].date + "' />";
                                            msg += "</p></li>";                                          
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('statusDiv').innerHTML = msg;
                     
                     
                     // Update Recent feedback
                     
                     var msg = "<ul>";
 
                            
                    for(i=obj.feedback.length -1; i>=0; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.feedback[i].from + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.feedback[i].text + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.feedback.length - i == 3 )
                                break;
                                    
                                
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('feedbackDiv').innerHTML = msg;
                     
                     document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn_guest'>(" + obj.feedback.length +")</a>";
                 
             
                      var feedbackGst = document.getElementById('feedbackTxtBtn_guest');
                      feedbackGst.onclick = showAllfGuestFeedback_f;
                      
                      var msg = "<table cellpadding='0' cellspacing='0' border='0' id='feedbackTable_Guest'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";                    
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                    for(i=0; i< obj.feedback.length; i++)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<tr>";
                                            msg += "<td>" + obj.feedback[i].from + "</td>";
                                            msg += "<td>" + obj.feedback[i].text + "</td>";
                                            msg += "</tr>";                                          
                                     
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('feedbackPopUp').innerHTML = msg;
                     
                     $("#feedbackTable_Guest").dataTable( {
                                  
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
            
            
         
      
                   
                   // Update friend list
                   
                    var msg = "<ul>";
                  
                   
 
                            
                    for(i= obj.friends.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            if(obj.friends[i].status == "accepted")
                                                {
                                                        msg += "<li>";
                                                        msg += "<h3>" + obj.friends[i].friends_username + "</h3>";
                                                        msg += "</li>"; 
                                                        
                                                        total_friends++;
                                                        
                                                        if(obj.friends[i].friends_username == "<?php echo $this->session->userdata('username'); ?>")
                                                            addfrndbutton = false;
                                                }
                                            
                                                
                                }
                          
                        }
                        
                    
                     msg += "</ul>";
                     
                   
                     if(addfrndbutton)
                     document.getElementById('userGreetings').innerHTML = name + "'s Profile" + "<button name='addfriends_bt' id='" + name +"' style= 'height: 40px;' onclick=addFriends(this.id); > Add </button>";
                     else
                     document.getElementById('userGreetings').innerHTML = name + "'s Profile (friends)";
     
     
                     if("<?php echo $this->session->userdata('username'); ?>" == name)
                     document.getElementById('userGreetings').innerHTML = "Welcome, " + name;
                          
                   
                     document.getElementById('friendsDiv').innerHTML = msg;
                     
                     document.getElementById('friendsText').innerHTML = "Friends (" + total_friends + ")";
                   
                     $("#pendingReq").hide();
                     
                    
                     
                     
                    
                     
                     
 
            }
        });
    }
    
    
    	
        
        
        
        function setTags()
    {
        
        var availableTags = [];
        
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/get_all_username",
            success: function(response)
            {
                     
                 var obj = jQuery.parseJSON(response);
                
                 for( i = 0; i< obj.length; i++)
                     {
                        
                         availableTags.push(obj[i].username);

                     }
                     
                       $( "#searchField" ).autocomplete({
			source: availableTags
		});
              

            }
        });
        
         
       
        
        
    }
    
    
    
    
   
   
     $(document).ready( function() {
         
         
        //   showAvailableCrops();
      //  showFeedback();
      showRecentFeedback();
     // showAllCrops();
     showRecentCrops();
     showRecentStatus();
     setTags();
     showRecentFriends();
     showPendingFriends();
    
     });
                     
    
    // Populate the setings dialog with user data from the database
    function settings_f()
    {
        
        
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/get_userdata",
            success: function(response)
            {
                     
                 var obj = jQuery.parseJSON(response);
                 
                 $("#user_name").val(obj.name);
                 $("#user_email").val(obj.email);
                 $("#user_password").val(obj.password);
                 $("#user_zipcode").val(obj.zipcode);
    
            }
        });
        
         
        $( "#userSettingsDialog" ).dialog('open');
        
        
    }
    
    
    function nearByCrops_f()
    {
        $( "#mapData" ).dialog('open');
    }
    
    function myCrops_f()
    {
        window.location = "http://localhost:8888/index.php/crop/mycrops/"+'<?php echo $this->session->userdata('username'); ?>';
    }
    
   
    function update_maps()
    {
        
            
        var data = $("#mapdataForm").serialize();
            

        var map;
        var geocoder = new google.maps.Geocoder();

        var markersArray = [];

        var haightAshbury = new google.maps.LatLng(35.7699298, -78.4469157);

        var mapOptions = {
            zoom: 8,
            center: haightAshbury,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

        google.maps.event.addListener(map, 'click', function(event) {

        });
            
            
            
        var markersArray = [];

        $.ajax({
        type:"POST",
        url:"http://localhost:8888/index.php/pages/get_mapdata",
        data: data,
        success: function(response)
            {
                         
                 var obj = jQuery.parseJSON(response);
                 
                  
                for(i=0; i< obj.length; i++)
                                        {

                                            if(!isNaN(obj[i].zipcode))
                                                {
                                                  
                                                  codeAddress(obj[i]);  

                                                }


                                        }                
                 
                 showOverlays();
                 

            }
        });
        
    
        function addMarker(lat, log) {
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, log),
                map: map
                });
                markersArray.push(marker);
        }


        function showOverlays() {
        if (markersArray) {
            for (i in markersArray) {
            markersArray[i].setMap(map);
            }
        }
        }
        
        
        function codeAddress(obj) {
            
            var address = obj.zipcode;
            
            geocoder.geocode( { 'address': address}, function(results, status) {
                
            
            if (status == google.maps.GeocoderStatus.OK) {
                
               
                var marker = new google.maps.Marker({
                    map: map, 
                    position: results[0].geometry.location,
                    title: obj.name

                    
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
            });
        }
           
            
            
    }
    
    

    
    
    
    
    
    
    
    
    
  

</script>

<body onload="main_init()">
    
    
    
    
    <div id="map_canvas" style="position: absolute; top: 45%; left: 35%; width:30%; height:30%; z-index:3"></div>
     

    <div id="crops" style="position: absolute; top: 15%; left: 15%; width: 70%; height: 500px"></div>
    
    <div id="feedbackPopUp"></div>

    
<!--    Menu-->
    <div style="margin-left:35%; position: absolute; top: 0; z-index:1">
    
    <ul id="menu">
        <li class="logo"><img style="float:left;"  src="../../images/menu_left.png" onclick= main_init() /> </li>
        
        <li><a href='#' id="messages" style="width: 160px">Messages</a></li>
        
        <li><a href='#' id="username" style="width: 160px">Options</a>
           
             <ul id="username">
                    <li>
                        <img class="corner_inset_left" alt="" src="../../images/corner_inset_left.png"/>
                        <a href="#">General help</a>
                        <img class="corner_inset_right" alt="" src="../../images/corner_inset_right.png"/>
                        
                    </li>
                    
                    
                    <li><a href="#" id="mycrops">My Crops</a></li>
                    <li><a href="#" id="nearByCrops">Crops Around Me</a></li>
                    <li><a href="#" id="settings">Settings</a></li>
                    <li><a href="#" id="logout">Logout</a></li>
                    
                    <li class="last">
                        <img class="corner_left" alt="" src="../../images/corner_left.png"/>
                        <img class="middle" alt="" src="../../images/dot.gif"/>
                        <img class="corner_right" alt="" src="../../images/corner_right.png"/>
                    </li>
            </ul>
        </li>
       
        <li><a href='#' id="notifications" style="width: 160px">Notifications</a></li>
        
        <li>  <div>
                <input type="text" id="searchField" />
                <img src="../../images/magnifier.png" alt="Search" onclick="viewProfile()" /></div>
</li> 
        
    </ul>
    
<img style="float:left;" alt="" src="../../images/menu_right.png"/>

</div>  
    
<div id="userSettingsDialog">
    
  <form id="userSettingsForm" action="http://localhost:8888/index.php/pages/post_userdata" method="POST">
      <table>
                <tr>
                    <td><label for="name" align="left">Name</label> </td>                             
                    <td><input type="text" name="name" style="width: 160px" id="user_name" /></td>
                </tr>

                <tr>
                    <td><label for="password" align="left">Password</label></td>
                    <td><input type="password" name="password" style="width: 160px" id="user_password"/></td>
                </tr>
                
                <tr>
                    <td><label for="zipcode" align="left">Zipcode</label> </td>                             
                    <td><input type="text" name="zipcode" style="width: 160px" id="user_zipcode"/></td>
                </tr> 

                <tr>
                    <td><label for="email" align="left">Email</label></td>
                    <td><input type="text" name="email" style="width: 160px" id="user_email"/></td>
                </tr>
    </table>
  </form>
</div>
    
    
<div id="mapData">
    
  <form id="mapdataForm" action="http://localhost:8888/index.php/pages/get_mapdata" method="POST">
      <table>
                <tr>
                    <td><label for="name" align="left">Crop Name</label> </td>                             
                    <td><input type="text" name="crop_name" style="width: 160px" id="crop_name" /></td>
                </tr>

                <tr>
                    <td><label for="password" align="left">Distance</label></td>
                    <td><input type="text" name="crop_distance" style="width: 160px" id="crop_distance"/></td>
                </tr>
                
                <tr>
                    <td><label for="zipcode" align="left">Zipcode</label> </td>                             
                    <td><input type="text" name="crop_zipcode" style="width: 160px" id="crop_zipcode"/></td>
                </tr> 
    
    </table>
  </form>
</div>




<!--Start of user multi column home page-->


<div id="page" >
	<div id="content" style=" position: absolute; top: 10%; left: 40%; width: 40%; z-index:0; background-image: url('../../images/content_bg.jpg'); background-size: 100%; background-repeat: repeat">
		
                <div id="status_bts">
		
                       <input type="text" name="status" id="status_txtbox" style= "width: 550px; height: 40px;" placeholder="What's in your farm?"/> 
                       <button name="status_bt" id="status_bt" value="POST" style= "height: 40px;" onclick=updateStatus();> Share </button> 
		</div>
            
                <div id="statusDiv">
		
                      
		</div>
		
	</div>
    
	<div id="sidebar" style="position: absolute; top: 9%; left: 25%; width: 100; height: 500px;">
            
		<div id="profilePicture" class="boxed">
			<h2 class="title" id="userGreetings">Welcome, <?php echo $this->session->userdata('username'); ?> </h2>
                        <image src="../../css/images/img04.jpg" width= 220px height=125px >
			
		</div>
            
		<div class="boxed">
			<h2 id="myCrops" class="title">Past Crops</h2>
			<div class="content" id="CropsDiv">
				
			</div>
		</div>
            
		<div class="boxed">
			<h2 class="title" id="friendsText"></h2>
			<div  class="content" id="friendsDiv">
				
			</div>
		</div>
            
            
                <div class="boxed">
			<h2 class="title" id="feedbackText"></h2>
			<div class="content" id="feedbackDiv">
                                                
                        </div>
                       
		</div>
            
                <div class="boxed" id ="pendingReq">
			<h2 class="title" >Pending Request</h2>
			<div class="content" id="pendingFriends">
                                                
                        </div>
                       
		</div>
            
		<div id="footer">
			<p id="legal">&copy;2007 Landscape. All Rights Reserved<br />
				Designed by <a href="http://www.freecsstemplates.org">FCT</a></p>
			<p id="links"><a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> | <a href="http://jigsaw.w3.org/css-validator/check/referer" title="This page validates as CSS"><abbr title="Cascading Style Sheets">CSS</abbr></a></p>
		</div>
	</div>
</div>



</body>
</html>
