/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function() {
    var oTable =  $('#table_id').dataTable({
         "sScrollY": "200px",
        "bPaginate": false,
        "bScrollCollapse": true,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bAutoWidth" : true,
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
    $( "#AddCrop" ).dialog({
        autoOpen: false,
        height: 520,
        width: 520,
        modal: true,
                        
        buttons: {
            "I am growing it!": function() {
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
                        url:"https://gs-vmalladi.rhcloud.com/index.php/crop/addnewcrop",
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
            
            