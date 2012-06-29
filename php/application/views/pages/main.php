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
                    
                   
                    var msg = "<table cellpadding='0' style='width: 100px;' cellspacing='0' border='0' id='example' width='50%'>";
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
                     
                     $("#example").dataTable( {
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
   
     $(document).ready( function() {
         
         
        //   showAvailableCrops();
           
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
    
    
   
    function update_maps()
    {
        
            
        var data = $("#mapdataForm").serialize();
       
            
        var l1 = 37.7699298;
        var l2 = -122.4469157;

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
    
    
    
    
    <div id="map_canvas" style="position: absolute; top: 45%; left: 35%; width:30%; height:30%"></div>
     

    <div id="crops" style="position: absolute; top: 15%; left: 15%; width: 70%; height: 500px"></div>

    
<!--    Menu-->
    <div style="margin-left:35%; position: absolute; top: 0; z-index:1">
    
    <ul id="menu">
        <li class="logo"><img style="float:left;" alt="" src="../../images/menu_left.png"/> </li>
        
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
	<div id="content" style=" position: absolute; top: 10%; left: 40%; width: 40%; height: 800px; z-index:0; background-image: url('../../images/content_bg.jpg'); background-size: 100%; background-repeat: repeat">
		
                <div>
		
                       <input type="text" name="status" id="status" style= "width: 550px; height: 40px;" placeholder="What's in your farm?"/> 
                       <button name="status_bt" id="status_bt" value="POST" style= "height: 40px;" > Share </button> 
		</div>
		
	</div>
    
	<div id="sidebar" style="position: absolute; top: 9%; left: 25%; width: 100; height: 500px;">
		<div id="profilePicture" class="boxed">
			<h2 class="title">Welcome, <?php echo $this->session->userdata('username'); ?></h2>
                        <image src="../../css/images/img04.jpg" style="widht: 300px; height:100px" >
			
		</div>
		<div id="news" class="boxed">
			<h2 id="myCrops" class="title">Past Crops</h2>
			<div class="content">
				<ul>
					<li class="first">
						<h3>04 July 2007</h3>
						<p><a href="#">Corn</a></p>
					</li>
					<li>
						<h3>29 June 2007</h3>
						<p><a href="#">Tomatoes</a></p>
					</li>
					
				</ul>
			</div>
		</div>
            
		<div id="extra" class="boxed">
			<h2 class="title">Looking for</h2>
			<div class="content">
				<ul class="list">
					<li class="first"><a href="#">Potatoes</a></li>
					<li><a href="#">Onions</a></li>
					<li><a href="#">Garlic</a></li>
				</ul>
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
