
           jQuery(function(){
               
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Should be a valid Email id"
                });
                
                jQuery("#password").validate({
                    expression: "if (VAL.length > 6 && VAL) return true; else return false;",
                    message: "Password is too short"
                
                });
                
                 jQuery("#confirmPassword").validate({
                    expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
                    message: "Confirm password field doesn't match the password field"
                 });
                 
                 jQuery("#username").validate({
                    expression: "if (VAL.length > 6 && VAL) return true; else return false;",
                    message: "Username too short"         
           
                });
            })
                 
          