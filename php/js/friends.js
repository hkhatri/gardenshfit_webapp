function showRecentFriends()
    {
        // Populate stauts div for all the available status
        
        var total_friends = 0;
        document.getElementById('friendsText').innerHTML = "Friends (0)";
               
           
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                   
                    
                   
 
                            
                    for(i= obj.friends.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            if(obj.friends[i].status == "accepted")
                                                {
                                                        msg += "<li>";
                                                        msg += "<h3>" + obj.friends[i].friends_username + "</h3>";
                                                        msg += "</li>";
                                                        total_friends++;
                                                }
                                            
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                    
                   
                     document.getElementById('friendsDiv').innerHTML = msg;
                     
                     document.getElementById('friendsText').innerHTML = "Friends (" + total_friends + ")";
                   
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    
    
    function addFriends(name)
    {
          
            
        var key = name;
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/add_friends",
            data:{ "key" : key},
            success: function(response)
            {    
               
                 $('#status_txtbox').val("");
                 $('#' + name).hide();
            }
        });
    }
    
    function acceptFriends(name)
    {
          
       
        var key = name;
        $.ajax({
            type:"POST",
            url:"http://localhost:8888/index.php/pages/accept_friends",
            data:{ "key" : key},
            success: function(response)
            {    
                $('#status_txtbox').val("");
                 $('#' + name).hide();
                showRecentFriends();
                showPendingFriends();
                
            }
        });
    }
    
    
    function showPendingFriends()
    {
        // Populate pending frieds div for all the available friend request
           
           $("#pendingReq").hide();
            
            
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                   
                    
                   
 
                            
                    for(i= obj.friends.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            if(obj.friends[i].status == "pending")
                                                {
                                                        msg += "<li>";
                                                        msg += "<h3>" + obj.friends[i].friends_username;
                                                        msg += "<button name='addfriends_bt' id='" + obj.friends[i].friends_username +"' style= 'height: 40px;' onclick=acceptFriends(this.id) > Add </button></h3>"; 
                                                        msg += "</li>";    
                                                        
                                                         $("#pendingReq").show();
                                                }
                                            
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                    
                   
                     document.getElementById('pendingFriends').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }
    
    
    
    
    