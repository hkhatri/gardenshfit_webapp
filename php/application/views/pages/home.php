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
<script src="../../js/initialization.js" type="text/javascript"></script>
    
    
   
</head>

<script> 
    
$(document).ready( function() {

         
    init();
    
});
 
function showLogin() {
$( "#loginDialog" ).dialog('open');                  
}

function showAddUser() {
$( "#newUserDialog" ).dialog('open');                  
}




function checkUsername(name)
{
   
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/adduser",
            data:{ "username" : name},
            success: function(response)
            {
                if(name.length > 5)
                  {
                        if(response == 0)
                            {                              
                            $("#errormsg").css("color","red");
                            $("#errormsg").html("Username already taken");                                                    
                            }
                        else
                            {
                            $("#errormsg").html("Username available");
                            $("#errormsg").css("color","green");
                            }
                  
                  }
                  else $("#errormsg").html("");
            }
        });
    
  
}


          


</script>

<body>
      
     
      
<div style="margin-left:40%; position: absolute; top: 0">
    <ul id="menu">
        <li class="logo">
            <img style="float:left;" alt="" src="../../images/menu_left.png"/> 
        </li>

        <li><a href='#' id="login">Login</a>
        </li>
        <li><a href="#" id="newUser" >Sign Up</a>

        </li>
    </ul>
    <img style="float:left;" alt="" src="../../images/menu_right.png"/>

</div>  
      
<img class="logo1" src="../../images/logo.png" />

<div id="loginDialog">
	
	<form id="loginForm" action="http://localhost:8888/index.php/pages/authenticate" method="POST">
 	
            <table>
                        <tr>
                            <td><label for="name" align="left">Username:</label> </td>                             
                            <td><input type="text" name="username" id="username" placeholder="Enter your username" /></td>
                        </tr> 
                        
                        <tr>
                            <td><label for="password" align="left">Password:</label></td>
                            <td><input type="password" name="password" id ="password" placeholder="Enter your password" onKeyPress="return submitenter(this,event)"/></td>
                        </tr>
                        
            </table> 
		
	
	</form>
</div>


<div id="newUserDialog">
    
  <form id="addUserForm" action="https://dev-gardenshift.rhcloud.com/Gardenshift/adduser/" method="POST">
      <table>
                <tr>
                    <td><label for="name" align="left">Username:</label> </td>                             
                    <td><input type="text" name="username" placeholder="Enter your username" style="width: 160px" id="username_add" onblur="checkUsername(this.value)" /></td>
                    <td id="errormsg" style=" display: inline-block;font-size: 12px;color: #D00; padding-left: 10px; font-style: italic; align: left" ></td>
                </tr>

                <tr>
                    <td><label for="password" align="left">Password:</label></td>
                    <td><input type="password" name="password" placeholder="Enter your password" style="width: 160px" id="password_add"/></td>
                </tr>
                
                <tr>
                    <td><label for="name" align="left">Confirm Password:</label> </td>                             
                    <td><input type="password" name="confirmPassword" placeholder="Re-enter you password" style="width: 160px" id="confirmPassword_add"/></td>
                </tr> 

                <tr>
                    <td><label for="password" align="left">Email</label></td>
                    <td><input type="text" name="email" placeholder="Enter your email" style="width: 160px" id="email"/></td>
                </tr>
    </table>
  </form>
</div>
  
  
</body>
</html>
