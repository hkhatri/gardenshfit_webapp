
 
$(document).ready(function() {
     
    //$("#selectElement").dropdownReplacement({optionsDisplayNum: 6});
    $( "#element_2_1" ).datepicker( {
        dateFormat: 'd MM, y'
    } );
        
     
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
        },
        {
            sWidth: '50px'
        },
           
        {
            sWidth: '50px'
        },
        {
            sWidth: '50px'
        }
        ]     
    });
    var nEditing = null;
    $('#table_id a.edit').live('click', function (e) {
        e.preventDefault();
       
       
        /* Get the row as a parent of the link that was clicked on */
        var nRow = $(this).parents('tr')[0];
         
        if ( nEditing !== null && nEditing != nRow ) {
            /* A different row is being edited - the edit should be cancelled and this row edited */
            restoreRow( oTable, nEditing );
            editRow( oTable, nRow );
            nEditing = nRow;
        }
        else if ( nEditing == nRow && this.innerHTML == "Save" ) {
            /* This row is being edited and should be saved */
            saveRow( oTable, nEditing );
            nEditing = null;
        }
        else {
            /* No row currently being edited */
            editRow( oTable, nRow );
            nEditing = nRow;
        }
    } );
    $('#table_id a.delete').live('click', function (e) {
        e.preventDefault();
        var nRow = $(this).parents('tr')[0];
        var aData = oTable.fnGetData(nRow);
   
        deleteRow(aData[0],oTable,nRow);
    
    
    } );
    $( "#AddCropDiv" ).dialog({
        autoOpen: false,
        height: 400,
        width: 520,
        modal: true,
                        
        buttons: {
            "I am growing it!": function() {
                var bValid = true;
                            
                var e = document.getElementById("element_3");
                var name = e.options[e.selectedIndex].text;
                var quantity = document.getElementById("element_1").value;
                var hdate = document.getElementById("element_2_1").value;
                           
                if(name=='' || quantity =='' || hdate ==''){
                    bValid=false;
                    validateMe();
                }
                                                    
                if ( bValid ) {
                    //  alert(1);
                                      
                    var url1="http://dev-gardenshift.rhcloud.com/Gardenshift/create_usercrop/"+usern+"/"+ name+"/"+quantity+"/"+hdate +"/na";
                    addRow(url1);
                    setTimeout(function(){
                        popup_window.close();
                        location.reload(true);
                    },3000);
                                        
                                        

                    $( this ).dialog( "close" );
                                         
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
    $( "#addCropButton" ).button().click(function() {
        $("#AddCropDiv").dialog('open'); 
              
    }
    );
         $( "#goBackButton" ).button().click(function() {
        window.location='http://localhost/gs/php/index.php/pages/mainPageLoader';
              
    });


});
 
 
        
            
jQuery(function(){
    jQuery("#element_1").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please enter a Quantity"
    });
    jQuery("#element_2_1").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please select a date"
    });
    jQuery("#element_3").validate({
        expression: "if (VAL) {return true; alert(1);} else return false;",
        message: "Please select a crop"
                              
    }); 
                
});
            
function restoreRow ( oTable, nRow )
{
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);
	
    for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
        oTable.fnUpdate( aData[i], nRow, i, false );
    }
	
    oTable.fnDraw();
}     
            
function editRow ( oTable, nRow )
{
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);
    jqTds[0].innerHTML = '<input value="'+aData[0]+'" type="text" readonly="readonly">';
    jqTds[1].innerHTML = '<input value="'+aData[1]+'" type="text">';
    jqTds[2].innerHTML = '<input id = "dateEdit" value="'+aData[2]+'" type="text" readonly="readonly"  size="10">';
    $(function() {
        $( "#dateEdit" ).datepicker( {
            dateFormat: 'd MM, y'
        } );
		
    });
    //  jqTds[3].innerHTML = '<input value="'+aData[3]+'" type="text">';
    jqTds[3].innerHTML = '<a class="edit" href="">Save</a>';
    
}


function saveRow ( oTable, nRow )
{
    var editValid=true;
    var jqInputs = $('input', nRow);
    var name=jqInputs[0].value;
    var quantity=jqInputs[1].value;
    
    var date=jqInputs[2].value;
    //  var date=date1.replace("/","-");
    //   date=date.replace("/","-");
    
    if(quantity==""){
        editValid=false;
        alert("Please enter a quantity");
        document.getElementById("jqInputs[1]").focus();
        
        
    }
    if(editValid){
        
        oTable.fnUpdate( jqInputs[0].value, nRow, 0, false );
        oTable.fnUpdate( jqInputs[1].value, nRow, 1, false );
        oTable.fnUpdate( jqInputs[2].value, nRow, 2, false );
        // oTable.fnUpdate( jqInputs[3].value, nRow, 3, false );
        oTable.fnUpdate( '<a class="edit" href="">Edit</a>', nRow, 3, false );
        oTable.fnDraw();
   
        var xmlHttp = null;
        var updateQuery = "https://dev-gardenshift.rhcloud.com/Gardenshift/update_usercrop/"+usern+"/"+name+"/"+quantity+"/"+date+"/na ";
        //alert(updateQuery);
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", updateQuery, false );
        xmlHttp.send( null );
        location.reload(true);
    }
    
    
 
       
}
function deleteRow (name,oTable,nRow )
{
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:200,
        modal: true,
        buttons: {
            "Delete": function() {
                oTable.fnDeleteRow( nRow );

                var updateQuery = "https://dev-gardenshift.rhcloud.com/Gardenshift/delete_usercrop/"+usern+"/"+name;

                $.get(updateQuery);
                $( this ).dialog( "close" );
        
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
    
    
   
    
}
function addRow(url1)
{
    popup_window = window.open(url1);
    
    
     
}


        