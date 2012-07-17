function showRecentFriends()
    {
        // Populate friends div for all accepted friends
        
        var total_friends = 0;
           
           $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
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
                                                    total_friends++;
                                                        
                                                        if(total_friends < 4)
                                                            {
                                                                msg += "<li>";
                                                                msg += "<h3>" + obj.friends[i].friends_username + "</h3>";
                                                                msg += "</li>";
                                                            }
                                                }
                                            
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                    
                   
                     if(total_friends > 0)
                        document.getElementById('friendsDiv').innerHTML = msg;
                    else
                        document.getElementById('friendsDiv').innerHTML = "No friends yet";
                     
                     document.getElementById('friendsText').innerHTML = "Friends <a href='#' id='friendsTxtBtn'>(" + total_friends + ")</a> ";
                     
                     var friendbtn = document.getElementById('friendsTxtBtn');
                     
                     friendbtn.onclick = showAllfriends_f;
                    
                     
                     }
                
 
            });
    
    }
    
    
    
    function addFriends(name)
    {
          
            
        var key = name;
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/add_friends",
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
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/accept_friends",
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
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
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
    
    
    function showAllfriends_f()
    {
        // Populate friends table 
        $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' cellspacing='0' border='0' id='friendsTable'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>"; 
                            msg += "<th>Status</th>"; 
                            msg += "</thead><tbody>";
                            
                            
                    for(i=0; i< obj.friends.length; i++)
                        {
                            
                            if(!isNaN(obj.friends.length))
                                {
                                            msg += "<tr>";
                                            msg += "<td>" + obj.friends[i].friends_username + "</td>";
                                            msg += "<td>" + obj.friends[i].status + "</td>";
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
                     
                     }
                
 
            });
            
               $( "#friendsPopUp" ).dialog('open');
             
               
                
  }
  
  
   function showAllfGuestfriends_f()
    {
        
        $("#friendsPopUp").dialog('open');
    }
    
    
    
    
    
    