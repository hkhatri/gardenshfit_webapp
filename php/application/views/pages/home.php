<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

    	<title> Welcome to Gardenshift</title>
	
	
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <style type="text/css">
        body {  font-family:Arial, Helvetica, Sans-Serif; font-size:12px; margin:0px 20px;
		background-image: url("../../images/simple.jpg");	  	
	 	background-repeat: no-repeat;		
		background-size: 100% 110%;
            	min-height: 700px;
	}

	img.logo1 { position:absolute; left:25%; top:33%; width: 50%; height:25%;}
	
        /* menu */
        #menu{ margin:0px; padding:0px; list-style:none; color:#fff; line-height:45px; display:inline-block; float:left; z-index:1000; }
        #menu a { color:#fff; text-decoration:none; }
        #menu > li {background:#172322 none repeat scroll 0 0; cursor:pointer; float:left; position:relative;padding:0px 10px;}
        #menu > li a:hover {color:#B0D730;}
        #menu .logo {background:transparent none repeat scroll 0% 0%; padding:0px; background-color:Transparent;}
        /* sub-menus*/
        #menu ul { padding:0px; margin:0px; display:block; display:inline;}
        #menu li ul { position:absolute; left:-10px; top:0px; margin-top:45px; width:150px; line-height:16px; background-color:#172322; color:#0395CC; /* for IE */ display:none; }
        #menu li:hover ul { display:block;}
        #menu li ul li{ display:block; margin:5px 20px; padding: 5px 0px;  border-top: dotted 1px #606060; list-style-type:none; }
        #menu li ul li:first-child { border-top: none; }
        #menu li ul li a { display:block; color:#0395CC; }
        #menu li ul li a:hover { color:#7FCDFE; }
        /* main submenu */
        #menu #main { left:0px; top:-20px; padding-top:20px; background-color:#7cb7e3; color:#fff; z-index:999;}
        /* search */
        .searchContainer div { background-color:#fff; display:inline; padding:5px;}
        .searchContainer input[type="text"] {border:none;}
        .searchContainer img { vertical-align:middle;}
        /* corners*/
        #menu .corner_inset_left { position:absolute; top:0px; left:-12px;}
        #menu .corner_inset_right { position:absolute; top:0px; left:150px;}
        #menu .last { background:transparent none repeat scroll 0% 0%; margin:0px; padding:0px; border:none; position:relative; border:none; height:0px;}
        #menu .corner_left { position:absolute; left:0px; top:0px;}
        #menu .corner_right { position:absolute; left:132px; top:0px;}
        #menu .middle { position:absolute; left:18px; height: 20px; width: 115px; top:0px;}
    </style>
</head>

<script>
  
		 function init()
{
$( "#loginDialog" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
	    autoOpen: false,          
            overlay: { backgroundColor: "#0FF", opacity: 0.8 },
            autoOpen: true,
            buttons: {
                    'Close': function() {
                    $(this).dialog('close');
                  }}

                });

$( "#newUserDialog" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
	    autoOpen: false, 
	    title: "New User",         
            overlay: { backgroundColor: "#0FF", opacity: 0.5 },
            autoOpen: true,
            buttons: {
                    'Close': function() {
                    $(this).dialog('close');
                  }}

                });

var login = document.getElementById('login');
login.onclick = showLogin;

var newUser = document.getElementById('newUser');
newUser.onclick = showAddUser;

$( "#loginDialog" ).dialog('close'); 
$( "#newUserDialog" ).dialog('close'); 

}
		


function showLogin() {
$( "#loginDialog" ).dialog('open');                  
}

function showAddUser() {
$( "#newUserDialog" ).dialog('open');                  
}

  </script>

<body onload="init()">
    <div style="margin-left:40%;">
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
  <img class="logo1" src="../../images/logo.png" />

<div id="loginDialog">
  <form action="https://dev-gardenshift.rhcloud.com/Gardenshift/authenticate/" method="POST">
  Username: <input type="text" name="username" /><br />
  Password: <input type="password" name="password" /><br />
  <input type="submit" value="login" />
  </form>
</div>

<div id="newUserDialog">
  <form action="https://dev-gardenshift.rhcloud.com/Gardenshift/adduser/" method="POST">
  Username: <input type="text" name="username" /><br />
  Password: <input type="password" name="password" /><br />
  Confirm Password: <input type="password" name="password" /><br />
  Email: <input type="text" name="email" /><br />
  <input type="submit" value="login" />
  </form>
</div>

</body>
</html>
