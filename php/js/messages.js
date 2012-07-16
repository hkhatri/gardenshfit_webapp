function fnFormatDetails ( oTable, nTr )

{ 
   
   //alert(array2);
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellspacing="0" border="0" style="padding-left:50px; background: #BCEE68; width:100%;">';
    sOut += '<tr><td>From:</td><td>'+aData[1]+'</td></tr>';
    sOut += '<tr><td style= "border-top: 1px solid black; ">Message:</td><td style= "border-top: 1px solid black; "><pre><strong>'+aData[5]+'<strong></pre></td></tr>';
    
    sOut += '</table>';
   
    return sOut;
}
 
$(document).ready(function() {
    /*
     * Insert a 'details' column to the table
     */
    $('#urm').show();
    $('#rm').show();
    
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<a style="cursor:pointer;" class="view"><u>View</u></a>';
    nCloneTd.className = "center";
     
//    $('#unreadmsgs_table thead tr').each( function () {
//        this.insertBefore( nCloneTh, this.childNodes[0] );
//    } );
     
    $('#unreadmsgs_table tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );
    $('#readmsgs_table tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );
     
    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var view_unread_row = null;
    var view_read_row = null;
    var oTable = $('#unreadmsgs_table').dataTable( {
       
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] },{ "bSortable": false, "aTargets": [ 4 ] },{ "bSortable": false, "aTargets": [ 7 ] }
        ],
        "aaSorting": [[6, 'desc']],
          
        "bPaginate": true,
          "bScrollCollapse": true,
         "bJQueryUI": true,
         "sPaginationType": "full_numbers",
           "bAutoWidth" : true
    });
  
    var oTable1 = $('#readmsgs_table').dataTable( {
        "aoColumnDefs": [
             { "bSortable": false, "aTargets": [ 0 ] },{ "bSortable": false, "aTargets": [ 4 ] },{ "bSortable": false, "aTargets": [ 7 ] }
        ],
        "aaSorting": [[6, 'desc']],
              "bPaginate": true,
            "bScrollCollapse": true,
              "bJQueryUI": true,
             "sPaginationType": "full_numbers",
             "bAutoWidth" : true 
    });
     
    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $('#unreadmsgs_table tbody td a.view').live('click', function () {
        var nTr = $(this).parents('tr')[0];
        if ( view_unread_row !== null && view_unread_row != nTr ) {
            var aData = oTable.fnGetData( nTr );
            /* A different row is being edited - the edit should be cancelled and this row edited */
            restoreRow( oTable, view_unread_row );
             this.innerHTML= '<a style="cursor:pointer;"><u>Close</u></a>';
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            oTable.fnClose( view_unread_row );
            view_unread_row = nTr;
            $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/message/updatenotif",
            data:{name:usern, timestamp:aData[6]},
            success: function(response)
            {
                location.reload(true);
            }
        });
            
            
        }
        else if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            view_unread_row=null;
            this.innerHTML= '<a style="cursor:pointer;"><u>View</u></a>';
            var aData = oTable.fnGetData( nTr );
            
        
      
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/message/updatenotif",
            data:{name:usern, timestamp:aData[6]},
            success: function(response)
            {
                     
            
            location.reload(true);
    
            }
        });
            
            
        }
        else
        {
          view_unread_row=nTr;
            /* Open this row */
           this.innerHTML= '<a style="cursor:pointer;"><u>Close</u></a>';
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
    $('#unreadmsgs_table tbody td a.delete').live('click', function () {
    var nTr = $(this).parents('tr')[0];
   // alert(nTr);
      
      var aData = oTable.fnGetData( nTr );
      //alert(aData[6]);
      
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/message/deletenotif",
            data:{name:usern, timestamp:aData[6]},
            success: function(response)
            {
                     
            
    
            }
         
        });

         oTable.fnDeleteRow( nTr );
         location.reload(true); 
    });
        $('#unreadmsgs_table a.reply').live('click', function (e) {
        e.preventDefault();
     
          var nTr = $(this).parents('tr')[0];
   // alert(nTr);
      
      var aData = oTable.fnGetData( nTr );
      
        $('#element_1').val(aData[1]);
        
        var x = aData[5];
        var when = aData[3];
        var who = aData[1];
       x="\n\n---------------------------------------------------------"+"\n On "+when+", " + who + " wrote: "+ "\n\n"  +x;
      
        $('#element_3').val(x);
        $("#reply").dialog('open');
        

    });
            $('#readmsgs_table a.reply').live('click', function (e) {
        e.preventDefault();
     
          var nTr = $(this).parents('tr')[0];
   // alert(nTr);
      
      var aData = oTable1.fnGetData( nTr );
      
        $('#element_1').val(aData[1]);
        
        var x = aData[5];
        var when = aData[3];
        var who = aData[1];
       x="\n\n---------------------------------------------------------"+"\n On "+when+", " + who + " wrote: "+ "\n\n"  +x;
      
        $('#element_3').val(x);
        $("#reply").dialog('open');
        

    });
        $( "#reply" ).dialog({
        
        open: function(event, ui) { $('#element_3').focus();},

        autoOpen: false,
        height: 620,
        width: 620,
        modal: true,
                        
        buttons: {
            "Send": function() {
                var bValid = true;
                 var from = document.getElementById("element_1").value;
                 var text = document.getElementById("element_3").value;
                //write validations
                                         
                                                                                 
                if ( bValid ) {
                    //code to send a reply
                        $.ajax({
                          type:"POST",
                          url:"http://test-gardenshift.rhcloud.com/index.php/message/sendreply",
                           data:{username:from, type:"reply" , from:usern ,text:text},
                           success: function(response)
                           {
                            location.reload(true);
    
                             }
                        });
                                             
                                         
                }
                                     
                                         
                                         
            },
            Cancel: function() {
                
                 $('#element_3').val("");
                  $('#element_1').val("");
                $( this ).dialog( "close" );
                                        
            }
        },
        close: function() {
            $('#element_3').val("");
                  $('#element_1').val("");
            $( this ).dialog( "close" );
        }
    }); 
    
    $('#readmsgs_table tbody td a.view').live('click', function () {
        var nTr = $(this).parents('tr')[0];
        
         if ( view_read_row !== null && view_read_row != nTr ) {
             
            var aData = oTable1.fnGetData( nTr );
            /* A different row is being edited - the edit should be cancelled and this row edited */
            restoreRow( oTable1, view_read_row );
             this.innerHTML= '<a style="cursor:pointer;"><u>Close</u></a>';
            oTable1.fnOpen( nTr, fnFormatDetails(oTable1, nTr), 'details' );
            oTable1.fnClose( view_read_row );
            view_read_row = nTr;
         
            
        }
        else if ( oTable1.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
           
           
            this.innerHTML= '<a style="cursor:pointer;"><u>View</u></a>';
            oTable1.fnClose( nTr );
             view_read_row=null;
            
            
        }
        else
        {
            /* Open this row */
            
            view_read_row=nTr;
           this.innerHTML= '<a style="cursor:pointer;"><u>Close</u></a>';
            oTable1.fnOpen( nTr, fnFormatDetails(oTable1, nTr), 'details' );
        }
    } );
        $('#readmsgs_table tbody td a.delete').live('click', function () {
    var nTr = $(this).parents('tr')[0];
    
      var aData = oTable1.fnGetData( nTr );
   
      
        $.ajax({
            type:"POST",
            url:"http://test-gardenshift.rhcloud.com/index.php/message/deletenotif_read",
            data:{name:usern, timestamp:aData[6]},
            success: function(response)
            {
                     
            
    
            }
         
        });
//      var updateQuery = 'https://dev-gardenshift.rhcloud.com/Gardenshift/delete_notification_unread/'+usern+'/'+aData[6];
//      alert(updateQuery);
//       $.get(updateQuery);
         oTable1.fnDeleteRow( nTr );
         location.reload(true); 
    });
    
 $( "#goBackButton" ).button().click(function() {
        window.location='http://test-gardenshift.rhcloud.com/index.php/pages/mainPageLoader';
              
    });
} );
function restoreRow ( oTable, nRow )
{
    var aData = oTable.fnGetData(nRow);
    var jqTds = $('>td', nRow);
	
    for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
        oTable.fnUpdate( aData[i], nRow, i, false );
    }
	
    oTable.fnDraw();
}     
