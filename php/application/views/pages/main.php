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
<link rel="stylesheet" type="text/css" href="../../css/jquery.noty.css" />
<link rel="stylesheet" type="text/css" href="../../css/noty_theme_default.css" />
<link href="https://code.google.com/apis/maps/documentation/javascript/examples/standard.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>

<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/formValidation.js" type="text/javascript"></script>
<script src="../../js/main_init.js" type="text/javascript"></script>
<script src="../../js/feedback.js" type="text/javascript"></script>
<script src="../../js/cropsProfilePage.js" type="text/javascript"></script>
<script src="../../js/status.js" type="text/javascript"></script>
<script src="../../js/friends.js" type="text/javascript"></script>
<script src="../../js/googleMaps.js" type="text/javascript"></script>
<script src="../../js/changePicture.js" type="text/javascript"></script>
<script src="../../js/jquery.noty.js" type="text/javascript"></script>
<script src="../../js/promise.js" type="text/javascript"></script>

<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0; background-image: url("../../images/plain.png"); background-size: 100% 100%; background-repeat: repeat; }
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA8k4FFdveeM0HszPabxQCNOfGmZGTUqDQ&sensor=false"></script>

<link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.css" />   
</style>
<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>





 
</head>

<script>  
    
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
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/visit_user",
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
                     
                     if("<?php echo $this->session->userdata('username'); ?>" != name)
                     document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn_guest'>(" + obj.feedback.length +")</a> <button id='addFeedback_btn' value='" + obj.username + "' onclick='showFeedbackDialog()' > Add </button> ";
                     else
                     document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn_guest'>(" + obj.feedback.length +")</a>";
                         
               if(isNaN(obj.feedback.length) )
                                {
                                   document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn_guest'>(0)</a>";
                                }
                      
                      // Create a dataTable of all the feedbacks
                      
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
                                                        total_friends++;
                                                        
                                                        if(total_friends < 4)
                                                                {                                                      
                                                                    msg += "<li>";
                                                                    msg += "<h3>" + obj.friends[i].friends_username + "</h3>";
                                                                    msg += "</li>"; 
                                                                }
                                                                                                                                                               
                                                         if(obj.friends[i].friends_username == "<?php echo $this->session->userdata('username'); ?>" || obj.friends[i].friends_username == name)
                                                            {
                                                                addfrndbutton = false;   
                                                                document.getElementById('userGreetings').innerHTML = name + "'s Profile (friends)";
                                                            }                                                       
                                                }
                                            
                                            
                                           if(obj.friends[i].status == "pending")
                                               {
                                                    if(obj.friends[i].friends_username == "<?php echo $this->session->userdata('username'); ?>")
                                                            {
                                                                addfrndbutton = false; 
                                                                document.getElementById('userGreetings').innerHTML = name + "'s Profile (Pending)";
                                                            }
                                               }
                                }
                          
                        }
                        
                    
                     msg += "</ul>";
                     
                     document.getElementById('friendsText').innerHTML = "Friends <a href='#' id='friendsTxtBtn_guest'>(" + total_friends + ")</a> ";
                 
                    
                     if(addfrndbutton)
                     document.getElementById('userGreetings').innerHTML = name + "'s Profile" + "<button name='addfriends_bt' id='" + name +"' onclick=addFriends(this.id); > Add </button>";
                    
                     
     
     
                     if("<?php echo $this->session->userdata('username'); ?>" == name)
                     document.getElementById('userGreetings').innerHTML = "Welcome, " + name;
                          
                   
                     document.getElementById('friendsDiv').innerHTML = msg;
                     
                   
                     $("#pendingReq").hide();
                     
                    
                     alert("asfasfa");
                     // Update profile picture to reflect that of user
                     
                    var urladdress = obj.picture;
                                    
                    var msg = "<image src='" + urladdress + "' style='width: 100%'  />";
                    
                    if("<?php echo $this->session->userdata('username'); ?>" == name)
                    msg+= "<button id='changePicture_btn'  style='position:absolute; left:1%; top: 5%' onclick='showChangeProfileDialog()'> Change Picture </button>";
                    
                    $("#changePicture_btn").hide();
                  
                   
                    document.getElementById('profilePictureDiv').innerHTML = msg;
                    
                    
                    
                       
                   // Create a dataTable of all the friends
                      
                      var frdGst = document.getElementById('friendsTxtBtn_guest');
                      frdGst.onclick = showAllfGuestfriends_f;
                      
                     var msg = "<table cellpadding='0' cellspacing='0' border='0' id='friendsTable'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";                    
                            msg += "</thead><tbody>";
                            
                            
                    for(i=0; i< obj.friends.length; i++)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            msg += "<tr>";
                                            msg += "<td>" + obj.friends[i].friends_username + "</td>";
                                            msg += "</tr>";                                                                         
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('friendsPopUp').innerHTML = msg;
                     
                     $("#friendsTable").dataTable( {
                                  
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     
 
                    
                 // Send a new message dynamic button
                 
                 var urladdress = obj.picture;
                                    
                 var msg = "<image src=" + urladdress + " style='width: 100%'  />";
                 
                 if("<?php echo $this->session->userdata('username'); ?>" != name)
                 {
                    msg+= "<button id='sendMessage_btn'  value = '"+ name + "'style='position:absolute; left:1%; top: 5%' onclick='alert(this.value)'> Send Message </button>";
                    $("#sendMessage_btn").show();
                 }
                 else
                     $("#sendMessage_btn").hide();
                  
                   
                    document.getElementById('profilePictureDiv').innerHTML = msg;
 
            }
        });
    }
    
       
    
    
    
    
    
    
    
    	
        
        
        
        function setTags()
    {
        
        var availableTags = [];
        
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_all_username",
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
    
    
    
    
   function reloadHomePage()
   {
         
    //   showAvailableCrops();
    //  showFeedback();
    showRecentFeedback();
    // showAllCrops();
    showRecentCrops();
    showRecentStatus();
    setTags();
    showRecentFriends();
    showPendingFriends();
    showProfilePicture();
     
    $("#pictureURL").hide();
     
    document.getElementById('userGreetings').innerHTML = "Welcome, " + "<?php echo $this->session->userdata('username'); ?>" ;
    $("#status_txtbox").show();
    $("#status_bt").show();  
    $("#changePicture_btn").hide();
        
   }
   
     $(document).ready( function() {
         
         main_init();
         
         $('#searchField').keypress(function(e)
                {
                        if (e.keyCode == 13)
                        {
                                viewProfile();
                        }
                });
                
                
    //     showAvailableCrops();
    //  showFeedback();
    showRecentFeedback();
    // showAllCrops();
    showRecentCrops();
    showRecentStatus();
    setTags();
    showRecentFriends();
    showPendingFriends();
    showProfilePicture();

    $("#pictureURL").hide();
    
    
    var msgcount=<?php echo($msgcount) ?>;
  


    //alert(msgcount);
    $.noty({
  layout : 'topRight', // (top, topLeft, topCenter, topRight, bottom, center, bottomLeft, bottomRight)
    // theme name (accessable with CSS)
  animateOpen : {height: 'toggle'}, // opening animation
  animateClose : {height: 'toggle'}, // closing animation
   // easing
  text : 'You have '+msgcount + ' unread messages', // notification text
  type : 'notification', // noty type (alert, success, error)
  speed : 500, // opening & closing animation speed
  timeout : 5000, // delay for closing event. Set false for sticky notifications
  closeButton : true, // enables the close button when set to true
  closeOnSelfClick : true, // close the noty on self click when set to true
  closeOnSelfHover : false, // close the noty on self mouseover when set to true
  force : false, // adds notification to the beginning of queue when set to true
  onShow : false, // callback for on show
  onClose : false, // callback for on close
  buttons : false, // an array of buttons
  modal : false// adds modal layer when set to true

  
    
     });
     
     $("#notifications").click(function(e) {
      e.preventDefault(); // if desired...
      // other methods to call...
      flag=1;
      if(flag=1){
     $("#notifications1").show();
     $("#subid").hide( 'slow', function() {});
     $.ajax({
         url: 'http://test-gardenshift.rhcloud.com/index.php/pages/flush_bulletin',
        dataType: 'text',
        success: function(data) {}
     });
      }
    });
         $("#messages_link").click(function(e) {
      // if desired...
      // other methods to call...

    
     $("#messages_subid").hide( 'slow', function() {});
   
      
    });

   $("#morenotifs").click(function(e){ 
   
   $("#morenotifsdiv").dialog( {height: 620,
        width: 420});
    }); 
    

   
    });
    
    
   var statusIntervalId = window.setInterval(update, 30000);

function update() {
    $.ajax({
        url: 'http://test-gardenshift.rhcloud.com/index.php/pages/get_bulletin_count',
        dataType: 'text',
        success: function(data) {
           if(data!=0){
           document.getElementById("subid").innerHTML="&nbsp;"+ data +"&nbsp;";
           $("#subid").show( 'slow', function() { });
           document.getElementById("notifications1").style.display="none";
           }
        }
    });
}
                     
    
    // Populate the setings dialog with user data from the database
    function settings_f()
    {
        
        
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_userdata",
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
        window.location = "http://test-gardenshift.rhcloud.com/index.php/crop/mycrops/"+'<?php echo $this->session->userdata('username'); ?>';
    }
    
   
    function showChangeButton()
    {
    $("#changePicture_btn").show();
    }
    
    
    function showChangeProfileDialog()
    {
        $("#pictureURL").dialog('open');
    }

    
    
    
    
    
    
    
    
    
  

</script>

<body>
    
    
    
    
    <div id="map_canvas" width="100%"></div>
     

    <div id="showCropsAll"></div>
    
    <div id="feedbackPopUp"></div>
    
    <div id="friendsPopUp"></div>
    
    <div id="pictureURL">
            <table>
                        <tr>
                            <td><label for="URL" align="left">URL:</label> </td>                             
                            <td><input type="text" name="username" id="pictureURLtxt" placeholder="Enter URL" /></td>
                        </tr> 
    
            </table> 
    </div>
    
    <div id="addFeedbackPopUp">
        Please enter your feedback carefully. Once it's added it cannot be deleted. <br>
        <input type="text" name="username" id="addFeedbacktxt" placeholder="Enter your Feedback" />
            
    </div>

    
<!--    Menu-->
    <div style="left:30%; position: absolute; top: 0; z-index:9999">
    
    <ul id="menu">
        <li class="logo"><img style="float:left;"  src="../../images/menu_left.png" onclick="reloadHomePage()" /> </li>
        
        <li><a href="http://test-gardenshift.rhcloud.com/index.php/message/mymessages/<?php echo $this->session->userdata('username'); ?>" id="messages_link" style="width: 160px">Messages <b id ="message_subid" style="background:red; text:black; " ><?php if($msgcount!=0){ echo '&nbsp;'; echo($msgcount);  echo '&nbsp;';}?>  </b></a>
         <ul id="newmsg">
                    <li>
                        <img class="corner_inset_left" alt="" src="../../images/corner_inset_left.png"/>
                        <a href="#">Create Message</a>
                        <img class="corner_inset_right" alt="" src="../../images/corner_inset_right.png"/>
                        
                    </li>
                    <li class="last">
                        <img class="corner_left" alt="" src="../../images/corner_left.png"/>
                        <img class="middle" alt="" src="../../images/dot.gif"/>
                        <img class="corner_right" alt="" src="../../images/corner_right.png"/>
                    </li>
                  
            </ul>
        </li>
        
        <li><a href='#' id="" style="width: 160px">Options</a>
           
             <ul id="username">
                    <li>
                        <img class="corner_inset_left" alt="" src="../../images/corner_inset_left.png"/>
                        <a href="#">General help</a>
                        <img class="corner_inset_right" alt="" src="../../images/corner_inset_right.png"/>
                        
                    </li>
                    
                    
                    <li><a href="#" id="mycrops">My Crops</a></li>
                    <li><a href="#" id="allUserCropsShow">Available Crops</a></li>
                    <li><a href="#" id="allcrops">All crops</a></li>
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
       
       <li><a href='javascript: ' id="notifications" style="width: 160px">Notifications <strong><b id ="subid" style="background:red; text:black; " ><?php if($bulletincount!=0){ echo '&nbsp;'; echo($bulletincount); echo '&nbsp;';}?>  </b></strong></a>
        <ul id="notifications1" style ="display:none; width: 400px">
                   
                       
                        <?php 
                        $i=0;
                            for($i;$i<$bulletincount&&$i<=10;$i++)
                            {
                            echo '<li><strong>';
                       echo '<a href="'; 
                        if (strpos($notarray[$bulletincount-$i-1],'message') == TRUE) {
                           
                         echo 'http://test-gardenshift.rhcloud.com/index.php/message/mymessages/'.$this->session->userdata('username').'">';
                         }
                         else if(strpos($notarray[$bulletincount-$i-1],'Feedback') == TRUE){
                             echo '<script type="text/javascript"> showAllFeedback(); <script>'; 
                         }
                         
                         else echo '#">';
                       
                       echo $notarray[$bulletincount-$i-1]; 
                       echo'</a>';
                        echo ' </strong></li>';
                            }
                            
                            for($i;$i<count($notarray_read) && $i<=10;$i++)
                            {
                            echo '<li>';
                       echo '<a href="'; 
                        if (strpos($notarray_read[count($notarray_read)-$i-1],'message') == TRUE) {
                           
                         echo 'http://test-gardenshift.rhcloud.com/index.php/message/mymessages/'.$this->session->userdata('username').'">';
                         }
                         
                          else if(strpos($notarray[$bulletincount-$i-1],'Feedback') == TRUE){
                             echo '<script type="text/javascript"> showAllFeedback(); <script>'; 
                         }
                         
                         else echo '#">';
                       
                       
                       echo $notarray_read[count($notarray_read)-$i-1]; 
                       echo'</a>';
                        echo ' </li>';
                            }
                            
                        
                        ?>
                         <li style="background:#0395CC; padding-left:0px; margin:0px 0px; padding: 5px 0px; "><center><strong><a id="morenotifs" style="color:#172322;">View more notifications...</a></strong></center></li>
                        
                       
            </ul>
        </li> 
     
        
        <li>  <div>
                <input type="text" id="searchField" />
                <img src="../../images/magnifier.png" alt="Search" onclick="viewProfile()" /></div>
</li> 
        
    </ul>
    
<img style="float:left;" alt="" src="../../images/menu_right.png"/>

</div> 

<div id="morenotifsdiv" style="display:none;">
        <?php 
                        $i=0;
                            for($i;$i<$bulletincount&&$i<=50;$i++)
                            {
                            echo '<li><strong>';
                       echo '<a style="text-decoration:none; a:hover {text-decoration:underline;}" href="'; 
                        if (strpos($notarray[$bulletincount-$i-1],'message') == TRUE) {
                           
                         echo 'http://test-gardenshift.rhcloud.com/index.php/message/mymessages/'.$this->session->userdata('username').'">';
                         }
                         
                          else if(strpos($notarray[$bulletincount-$i-1],'Feedback') == TRUE){
                             echo '<script type="text/javascript"> showAllFeedback(); <script>'; 
                         }
                         
                         else echo '#">';
                       
                       
                       echo $notarray[$bulletincount-$i-1]; 
                       echo'</a>';
                        echo ' </strong></li>';
                            }
                            
                            for($i;$i<count($notarray_read) && $i<=50;$i++)
                            {
                            echo '<li>';
                       echo '<a style="text-decoration:none; a:hover {text-decoration:underline;}" href="'; 
                        if (strpos($notarray_read[count($notarray_read)-$i-1],'message') == TRUE) {
                           
                         echo 'http://test-gardenshift.rhcloud.com/index.php/message/mymessages/'.$this->session->userdata('username').'">';
                         }
                         
                          else if(strpos($notarray[$bulletincount-$i-1],'Feedback') == TRUE){
                             echo '<script type="text/javascript"> showAllFeedback(); <script>'; 
                         }
                         
                         else echo '#">';
                       
                       
                       echo $notarray_read[count($notarray_read)-$i-1]; 
                       echo'</a>';
                        echo ' </li>';
                            }
                            
                        
                        ?>
 
</div>
    
<div id="userSettingsDialog">
    
  <form id="userSettingsForm" action="http://test-gardenshift.rhcloud.com/index.php/pages/post_userdata" method="POST">
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
    
  <form id="mapdataForm" action="http://test-gardenshift.rhcloud.com/index.php/pages/get_mapdata" method="POST">
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
		
                       <input type="text" name="status" id="status_txtbox" style= "width: 85%; height: 40px;" placeholder="What's in your farm?"/> 
                       <button name="status_bt" id="status_bt" value="POST" style= "height: 40px;" onclick=updateStatus();> Share </button> 
		</div>
            
                <div id="statusDiv">
		
                      
		</div>
		
	</div>
    
	<div id="sidebar" style="position: absolute; top: 9%; left: 25%; width: 11.9%; height: 100%;">
            
		<div id="profilePicture" class="boxed" onmouseover="showChangeButton()" onmouseout=" $('#changePicture_btn').hide();"  >
                    
			<h2 class="title" id="userGreetings">Welcome, <?php echo $this->session->userdata('username'); ?> </h2>
                        
                        <div id="profilePictureDiv">
                            
                          
                            
                        </div>
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
