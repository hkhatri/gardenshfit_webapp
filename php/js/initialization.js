function init()
{
    
    
$.ajaxSetup ({  
    cache : false,
    async:false
});
    

$( "#loginDialog" ).dialog('close'); 
$( "#newUserDialog" ).dialog('close'); 


$( "#loginDialog" ).dialog({               
         
            modal: true,
            resizable: true,         
            autoOpen: false,
            title: "Let's Trade",          
            overlay: { backgroundColor: "black", opacity: 1 },
            autoOpen: true,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Cancel': function() {
                    $(this).dialog('close');
                  },
                                  
                    'Login': function() {                                      
                    
                    $("#loginForm").submit()
                    
                  }
            }

            });

$( "#newUserDialog" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
            autoOpen: false, 
            title: "Create a new Account",
            overlay: { backgroundColor: "#0FF", opacity: 0.5 },
            autoOpen: true,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Cancel': function() {
                    $(this).dialog('close');
                  },
                                  
                    'Create Account': function() {
                   if($("#errormsg").html() == "Username available" )
                    $("#addUserForm").submit();
                  }
       }});
       


$( "#loginDialog" ).dialog('close'); 
$( "#newUserDialog" ).dialog('close'); 

var login = document.getElementById('login');
login.onclick = showLogin;

var newUser = document.getElementById('newUser');
newUser.onclick = showAddUser;



}
