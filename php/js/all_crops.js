/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function() {
    var oTable =  $('#table_id').dataTable({
         "bScrollCollapse": true,
        "bJQueryUI": true,
       
        
        "bInfo": false,
        "bAutoWidth": false,
        "aoColumns" : [
        {
            sWidth: '50px'
        },
{
            sWidth: '50px'
        }
            
        ]     
    });
    $( "#addnewcrop" ).button().click(function() {
        $("#AddCrop").dialog('open'); 
    });
         $( "#goBackButton" ).button().click(function() {
        window.location='http://test-gardenshift.rhcloud.com/index.php/pages/mainPageLoader';
              
    });
    $( "#AddCrop" ).dialog({
        autoOpen: false,
        height: 520,
        width: 520,
        modal: true,
                        
        buttons: {
            "Add this crop": function() {
                var bValid = true;
           
                                       
                var description = document.getElementById("element_1").value;
                var name = document.getElementById("element_3").value;
                                          
                if(name=="")
                {
                    bValid=false;
                //  $("#emptycrop").show("slow");
                }
                else{
                                                 
                    if(jQuery.inArray(name, array2) >-1)
                    {
                        // $("#existingcrop").show("slow");
                        bValid=false;
                    }
                }
                if(description==""){
                    bValid=false;
                // $("#emptydesc").show("slow");
                } 
                                         
                                                                                 
                if ( bValid ) {
                    //alert(1);
                    $.ajax({
                        type:"POST",
                        url:"addnewcrop",
                        data:{
                            "name":name,
                            "description":description
                        },
                        success: function(response){
                            //  alert(response);
                            location.reload(true);
                            $( this ).dialog( "close" );
                        }
                    });
                                             
                                         
                }
                                     
                                         
                                         
            },
            Cancel: function() {
                $( this ).dialog( "close" );
                                        
            }
        },
        close: function() {
            $( this ).dialog( "close" );
        }
    }); 
});
        
    
jQuery(function(){
    jQuery("#element_3").validate({
        expression: "if (VAL) {return true;} else {return false;}",
        message: "Please enter a Crop Name"
    });
    jQuery("#element_3").validate({
        expression: " if(jQuery.inArray(VAL, array2) >-1){return false;}else return true;",
        message: "The entered crop name already exists in the DB"
    });
    jQuery("#element_1").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please enter a description"
    });
                            
                
});
            
            