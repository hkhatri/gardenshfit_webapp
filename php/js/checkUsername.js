function checkUsername(name)
{
   
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/adduser",
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


function userExists(name)
{
        $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/adduser",
                data:{ "username" : name},
                success: function(response)
                {
                            if(response == 0)
                                {     
                                        viewProfile();
                                }
                                else $("#errorUsername").dialog('open');
                    
                }
            });
    
                                
}
