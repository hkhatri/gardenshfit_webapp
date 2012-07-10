function showAvailableCrops()
    {
        // Populate crops table for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' style='width: 100px;' cellspacing='0' border='0' id='userCropsTable' width='50%'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";
                            msg += "<th>Crop</th>";
                            msg += "<th>Quantity</th>";
                            msg += "<th>Harvestation Date</th>";
                            msg += "<th>Email</th>";
                            msg += "<th>Zipcode</th>";
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                    for(i=0; i< obj.length; i++)
                        {
                            
                            if(!isNaN(obj[i].user_crops.length))
                                {
                                    for(j=0; j< obj[i].user_crops.length; j++)
                                        {
                                            msg += "<tr>";
                                            msg += "<td>" + obj[i].name + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_name + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_expected_quantity + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].crop_harvest_date + "</td>";
                                            msg += "<td>" + obj[i].email + "</td>";
                                            msg += "<td>" + obj[i].zipcode + "</td>";
                                            msg += "<td>" + obj[i].user_crops[j].comments + "</td>";
                                            msg += "</tr>";                                          
                                        }
                                    
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('crops').innerHTML = msg;
                     
                     $("#userCropsTable").dataTable( {
                                    "sScrollY": "200px",
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
  
  
    
    }
    
    
    
   // Show past and Recent Crops
   
   function showAllCrops()
    {
        // Populate feedback table for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_recent_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' style='width: 100px;' cellspacing='0' border='0' id='userCropsTable' width='50%'>";
                            msg += "<thead><tr>";
                           
                            msg += "<th>Crop</th>";
                            msg += "<th>Quantity</th>";
                            msg += "<th>Harvestation Date</th>";
                            
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                     
                            if(!isNaN(obj.user_crops.length))
                                {
                                    for(j=0; j< obj.user_crops.length; j++)
                                        {
                                            msg += "<tr>";
                                          
                                            msg += "<td>" + obj.user_crops[j].crop_name + "</td>";
                                            msg += "<td>" + obj.user_crops[j].crop_expected_quantity + "</td>";
                                            msg += "<td>" + obj.user_crops[j].crop_harvest_date + "</td>";
                                           
                                            msg += "<td>" + obj.user_crops[j].comments + "</td>";
                                            msg += "</tr>";                                          
                                        }
                                    
                                }
                       
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('CropsDiv').innerHTML = msg;
                     
                     $("#userCropsTable").dataTable( {
                                    "sScrollY": "200px",
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
  
  
    
    }
    
    
    function showRecentCrops()
    {
        // Populate feedback div for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://localhost:8888/index.php/pages/get_recent_crops",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
 
                            
                    for(i= obj.user_crops.length - 1; i>=0 ; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.user_crops[i].crop_name + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.user_crops[i].crop_harvest_date + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.user_crops.length - i == 3 )
                                break;
                                    
                                
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('CropsDiv').innerHTML = msg;
                     
                    
                     
                     }
                
 
            });
  
  
    
    }