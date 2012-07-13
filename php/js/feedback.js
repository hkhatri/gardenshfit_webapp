function showAllFeedbacks_f()
    {
               
        showAllFeedback();
    }
     
    
    function showAllfGuestFeedback_f()
    {
        
        $("#feedbackPopUp").dialog('open');
    }
    
    
    function showAllFeedback()
    {
        // Populate feedback table for all the available feedbacks that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
                    
                   
                    var msg = "<table cellpadding='0' cellspacing='0' border='0' id='feedbackTable'>";
                            msg += "<thead><tr>";
                            msg += "<th>User</th>";                    
                            msg += "<th>Comments</th></thead><tbody>";
                            
                            
                    for(i=0; i< obj.feedback.length; i++)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<tr>";
                                            msg += "<td>" + obj.feedback[i].from + "</td>";
                                            msg += "<td>" + obj.feedback[i].text + "</td>";
                                            msg += "</tr>";                                          
                                     
                                }
                                
                                
                        }
                        
                        
                     msg += "</tbody></table>";
                   
                     document.getElementById('feedbackPopUp').innerHTML = msg;
                     
                     $("#feedbackTable").dataTable( {
                                  
                                    "bPaginate": false,
                                    "bScrollCollapse": true,
                                    "bJQueryUI": true,
                                    "sPaginationType": "full_numbers",
                                    "bAutoWidth" : true
                            });
                     
                     }
                
 
            });
            
               $( "#feedbackPopUp" ).dialog('open');
             
               
    
    }
    
    
    function showRecentFeedback()
    {
        // Populate feedback div for all the available crops that a user can trade with
           $.ajax({
                type:"POST",
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/get_feedback",
                success: function(response)
                {
                     

                    var obj = jQuery.parseJSON(response);
  
                    var msg = "<ul>";
 
                            
                    for(i=obj.feedback.length -1; i>=0; i--)
                        {
                            
                            if(!isNaN(obj.feedback.length))
                                {
                                            msg += "<li>";
                                            msg += "<h3>" + obj.feedback[i].from + "</h3>";
                                            msg += "<p><a href='#' id='logout'>" + obj.feedback[i].text + "</a></p>";
                                            msg += "</li>";                                          
                                                
                                }
                                
                            if(obj.feedback.length - i == 3 )
                                break;
                                    
                           
                                
                        }
                        
                        
                     msg += "</ul>";
                   
                     document.getElementById('feedbackDiv').innerHTML = msg;
                     
                     document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn'>(" + obj.feedback.length +")</a> " ;
                     
                      if(isNaN(obj.feedback.length) )
                                {
                                    document.getElementById('feedbackText').innerHTML = "Feedbacks <a href='#' id='feedbackTxtBtn'>(0)</a> " ;
  
                                }
                     
                    
                     var fdbackbtn = document.getElementById('feedbackTxtBtn');
                     fdbackbtn.onclick = showAllFeedbacks_f;
                     }
                
 
            });
  
  
    
    }
    
    
    function showFeedbackDialog()
    {     
        $( "#addFeedbackPopUp" ).dialog('open');
    }
    
    
    
    
    function getGuestString(name)
    {
        var key = name;
        $.ajax({
                type:"POST",
                async: false,
                url:"http://test-gardenshift.rhcloud.com/index.php/pages/visit_user",
                data: {"name" : key},
                success: function(response)        
                {
                    
                }
        });



    }
    
    function addFeedback()
    {
        var msg = $("#addFeedbacktxt").val();
        var to = $("#addFeedback_btn").val();
        
  
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/pages/add_feedback",
            data:{"to" : to, "msg" : msg},
            success: function(response)
            {
                 $("#addFeedbacktxt").val("");
                 viewProfile();
                 
            }
       });
    
  

    }

   