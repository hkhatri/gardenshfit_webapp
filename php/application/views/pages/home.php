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
    
    
   
<</head>

<script>
    
function check_username(){
 
	var username = $("#username").val();
	if(username.length > 2){
		$('#Loading').show();
		$.post("https://dev-gardenshift.rhcloud.com/Gardenshift/authenticate/", {
			username: $('#username').val(),
		}, function(response){
			
			alert(response);
		});
		return false;
	}
}
    




function showLogin() {
$( "#loginDialog" ).dialog('open');                  
}

function showAddUser() {
$( "#newUserDialog" ).dialog('open');                  
}

</script>

  <body onload="init()" >
      
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
	
	<form id="loginForm" action="https://dev-gardenshift.rhcloud.com/Gardenshift/authenticate/" method="POST">
 	
            <table>
                        <tr>
                            <td><label for="name" align="left">Username:</label> </td>                             
                            <td><input type="text" name="username" placeholder="Enter your username" /></td>
                        </tr> 
                        
                        <tr>
                            <td><label for="password" align="left">Password:</label></td>
                            <td><input type="password" name="password" placeholder="Enter your password" /></td>
                        </tr>
                        
            </table> 
		
	
	</form>
</div>


<div id="newUserDialog">
    
  <form id="addUserForm" action="https://dev-gardenshift.rhcloud.com/Gardenshift/adduser/" method="POST">
      <table>
                <tr>
                    <td><label for="name" align="left">Username:</label> </td>                             
                    <td><input type="text" name="username" placeholder="Enter your username" style="width: 160px" id="username" onblur="return check_username();" /></td>
                </tr> 

                <tr>
                    <td><label for="password" align="left">Password:</label></td>
                    <td><input type="password" name="password" placeholder="Enter your password" style="width: 160px" id="password"/></td>
                </tr>
                
                <tr>
                    <td><label for="name" align="left">Confirm Password:</label> </td>                             
                    <td><input type="password" name="confirmPassword" placeholder="Re-enter you password" style="width: 160px" id="confirmPassword"/></td>
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
