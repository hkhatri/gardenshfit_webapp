function main_init()
{
    
    
    $.ajaxSetup ({  
        cache : false,
        async:false
    });
    

    var logout = document.getElementById('logout');
    logout.onclick = logout_f;

    var settings = document.getElementById('settings');
    settings.onclick = settings_f;
    
    var nearCrops = document.getElementById('nearByCrops');
    nearCrops.onclick = nearByCrops_f;
    
    var mycrops = document.getElementById('mycrops');
    mycrops.onclick = myCrops_f;
    
    var allCropsShow = document.getElementById('allUserCropsShow');
    allCropsShow.onclick = showAvailableCrops;
    
    var cropsFromDatabase = document.getElementById('allcrops');
    cropsFromDatabase.onclick = allcrops_f;
    
    

    function logout_f()
    {
        window.location = "http://test-gardenshift.rhcloud.com/index.php/pages/logout";
    }
    
      function allcrops_f()
    {
        window.location = "http://test-gardenshift.rhcloud.com/index.php/crop/allcrops";
    }
    


   $( "#userSettingsDialog" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
            autoOpen: false, 
            title: "Settings",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Cancel': function() {
                        $(this).dialog('close');
                    },
               
                    'Update': function() {                  
                   $("#userSettingsForm").submit();
                  }
            }}
);
    
    
    $( "#mapData" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
            autoOpen: false, 
            title: "Search",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Cancel': function() {
                        $(this).dialog('close');
                    },
               
                    'Update': function() {                  
                   $(this).dialog('close');
                   update_maps();
                  }
            }}
);
    
    
    $( "#feedbackPopUp" ).dialog({               
         
         
            resizable: true,
            autoResize: true,
            
            title: "Feedbacks",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Ok': function() {
                        $(this).dialog('close');
                    }
               
                
                  }
            }
);
    
    $( "#friendsPopUp" ).dialog({               
         
         
            resizable: true,
            autoResize: true,
            
            title: "Friends",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Ok': function() {
                        $(this).dialog('close');
                    }
               
                
                  }
            }
);
    
    $( "#pictureURL" ).dialog({               
         
         
            resizable: true,
            autoResize: true,       
            title: "Change Profile Picture",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Close': function() {
                        $(this).dialog('close');
                    },
                    'Update': function() {
                        changePicture();
                        $(this).dialog('close');
                    }
               
                
                  }
            }
);
    
    $( "#addFeedbackPopUp" ).dialog({               
         
         
            resizable: true,
            autoResize: true,       
            title: "Add Feedback",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Close': function() {
                        $(this).dialog('close');
                    },
                    'Add': function() {
                        addFeedback();
                        $(this).dialog('close');
                    }
               
                
                  }
            }
);
    
    $( "#map_canvas" ).dialog({               
         
         
            resizable: false,
            autoResize: true,       
            title: "Available Crops",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: false,
            height: '600',
            width: '600',
            buttons: {
                    'Close': function() {
                        $(this).dialog('close');
                       
                    }
                               
                  }
            }
);
  
$( "#showCropsAll" ).dialog({               
         
         
           
            resizable: false,
            autoResize: false,
            autoOpen: false, 
            title: "All Crops",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            height: 'auto',
            width: '1000px',
            buttons: {
                    'Close': function() {
                        $(this).dialog('close');
                        document.getElementById('showCropsAll').innerHTML = "";
                       
                    }
                               
                  }
            }
);  
    
$( "#errorUsername" ).dialog({               
         
         
           
            resizable: false,
            autoResize: true,
            autoOpen: false, 
            title: "Message",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            height: 'auto',
            width: 'auto',
            buttons: {
                    'Close': function() {
                        $(this).dialog('close');   
                    }
                               
                  }
            }
);  
    
    
    $( "#userSettingsDialog" ).dialog('close');
    $( "#mapData" ).dialog('close');
    $( "#feedbackPopUp" ).dialog('close');
      
}