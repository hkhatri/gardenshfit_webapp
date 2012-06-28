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
   
<script src="../../external/jquery.bgiframe-2.1.2.js"></script>
<script src="../../ui/jquery.ui.core.js"></script>
<script src="../../ui/jquery.ui.widget.js"></script>
<script src="../../ui/jquery.ui.mouse.js"></script>
<script src="../../ui/jquery.ui.draggable.js"></script>
<script src="../../ui/jquery.ui.position.js"></script>
<script src="../../ui/jquery.ui.resizable.js"></script>
<script src="../../ui/jquery.ui.dialog.js"></script>
<script src="../../ui/jquery.effects.core.js"></script>
<script src="../../ui/jquery.effects.blind.js"></script>
<script src="../../ui/jquery.effects.explode.js"></script>

<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>

<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/formValidation.js" type="text/javascript"></script>
<script src="../../js/main_init.js" type="text/javascript"></script>


		
		
		<style type="text/css" title="currentStyle">
			@import "../../css/demo_page.css";
			@import "../../css/jquery.dataTables.css";
		</style>
		<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
		
	</head>

 
</head>

<script>   
   
     $(document).ready( function() {
         
          
         
           $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_crops",
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
  
    });
                     

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
    
     
          
 

</script>

<body onload="main_init()">
     

    <div id="crops" style="position: absolute; top: 35%; left: 25%; width: 900px; height: 500px">
   </div>

  
   
    
    
    
    
    
    
    
    <div style="margin-left:40%; position: absolute; top: 0">
    
    <ul id="menu">
        
        <li class="logo"><img style="float:left;" alt="" src="../../images/menu_left.png"/> </li>

        <li><a href='#' id="username" style="width: 160px"><?php echo $this->session->userdata('username'); ?></a>
           
             <ul id="username">
                    <li>
                        <img class="corner_inset_left" alt="" src="../../images/corner_inset_left.png"/>
                        <a href="#">General help</a>
                        
                    </li>
                    <li><a href="#" id="mycrops">My Crops</a></li>
                    <li><a href="#" id="settings">Settings</a></li>
                    <li><a href="#" id="logout">Logout</a></li>
                    <li class="last">
                        <img class="corner_left" alt="" src="../../images/corner_left.png"/>
                        <img class="middle" alt="" src="../../images/dot.gif"/>
                        <img class="corner_right" alt="" src="../../images/corner_right.png"/>
                    </li>
                </ul>
        </li>
                    
    </ul>
    <img style="float:left;" alt="" src="../../images/menu_right.png"/>

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
      

</body>
</html>
