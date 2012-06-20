<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

    	<title> Welcome to Gardenshift</title>
	
	<link rel="stylesheet" href="../../themes/base/jquery.ui.all.css">
	<script src="../../js/jquery-1.7.2.js"></script>
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
	<link rel="stylesheet" href="../../ui/demos.css">
	

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
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#dialog" ).dialog({
			autoOpen: true,
			show: "blind",
			hide: "explode"
		});

		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
		});
	});
	</script>

<body>
<button id="opener" value="open"> 
    <div style="margin-left:40%;">
        <ul id="menu">
            <li class="logo">
                <img style="float:left;" alt="" src="../../images/menu_left.png"/>
               
                
            </li>
            <li><a href="#" onclick=alert("Hello") >Login</a>
            </li>
            <li><a href="#">New User</a>
                <ul id="help">
                    <li>
                        <img class="corner_inset_left" alt="" src="../../images/corner_inset_left.png"/>
                        <a href="#">SignUp</a>
                        <img class="corner_inset_right" alt="" src="../../images/corner_inset_right.png"/>
                    </li>
                    <li><a href="#">About Us</a>                 
                   
                        <img class="corner_left" alt="" src="../../images/corner_left.png"/>
                        <img class="corner_right" alt="" src="../../images/corner_right.png"/>			
                    </li>
                </ul>
            </li>
        </ul>
        <img style="float:left;" alt="" src="../../images/menu_right.png"/>
  <img class="logo1" src="../../images/logo.png" />

<div id="dialog">
    <h1>This IS A Cool PopUp</h1>

</div>


</body>
</html>
