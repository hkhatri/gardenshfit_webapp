function deleteStatus(statusDate)
    {
          
            
        var key = statusDate;
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/delete_status",
            data:{ "key" : key},
            success: function(response)
            {    
                 showRecentStatus();
                 $('#status_txtbox').val("");
            }
        });
    }
    
    function updateStatus()
    {
        update = $('#status_txtbox').val();
        
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/post_status",
            data:{ "status" : update},
            success: function(response)
            {
                 showRecentStatus();
                 $('#status_txtbox').val("");
            }
        });
    }
    
    function showRecentStatus()
    {
        // Populate stauts div for all the available status
           
           $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
                    
                   
 
                            
                    for(i= obj.status.length -1 ; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.status.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.status[i].text + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.status[i].date + "</a>";
                                            msg += "<img src='../../images/delete.png' width= 15px height=15px align='right' onclick='deleteStatus(this.id)' id='" + obj.status[i].date + "' /> </p>";
                                            msg += "</li>";                                          
                                                
                                }
                          
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('statusDiv').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }