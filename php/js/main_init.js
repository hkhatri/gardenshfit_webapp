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

    function logout_f()
    {
        window.location = "http://localhost:8888/index.php/pages/logout";
    }


   $( "#userSettingsDialog" ).dialog({               
         
            modal: true,
            resizable: true,
            autoResize: true,
            autoOpen: false, 
            title: "Settings",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: true,
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
            title: "Settings",
            overlay: {backgroundColor: "#0FF", opacity: 0.5},
            autoOpen: true,
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
    
    $( "#userSettingsDialog" ).dialog('close');
    $( "#mapData" ).dialog('close');
      
}