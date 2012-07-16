

<html>                                                                  
    <head>
        
        
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

        <link href="../../../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../../css/jquery-ui.css" rel="stylesheet" type="text/css"/>  
        <link rel="stylesheet" type="text/css" href="../../../css/jquery.validate.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/style1.css" />

        

        <script src="../../../js/jquery.validate.js" type="text/javascript"></script>
        <script src="../../../js/formValidation.js" type="text/javascript"></script>
        
           
        <style type="text/css" title="currentStyle">
                @import "../../../css/demo_page.css";
                @import "../../../css/jquery.dataTables.css";
        </style>
        
        <script type="text/javascript" language="javascript" src="../../../js/jquery.dataTables.js"></script>
        
        <script type="text/javascript" src="../../../js/crops_display.js"></script>

        <link rel="stylesheet" type="text/css" href="../../../css/crops_display.css" />
        
        
       
    </head>                                                                 
   <body onload="onLoadf()">
        <script type="text/javascript">
            window.onload= function(){
                
               usern= '<?php echo($username) ?>'; 
            
            }
            
            
            
            </script>
        <div id="main" >
           <div id="dialog-confirm" title="Delete crop" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to delete this entry?</p>
</div>


            <div id ="addcropbuttondiv"><button type="button" id ="addCropButton" >Add a Crop</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<button type="button" id ="goBackButton" >Go Back</button>
                <br/>
                <br/>   
            </div>
            <div id="tablediv">

                <table id="table_id" style="background-color:grey;">
                    <thead>
                        <tr>
                            <th>Crop name</th>
                            <th>Quantity</th>
                            <th>Harvest Date</th>

                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $stack;
                        $stack = array();
                        ?>
                        <?php
                        for ($c = 0; $c < count($usercrops); $c++) {
                            echo '<tr>';

                            array_push($stack, $usercrops[$c]->{'crop_name'});

                            echo '<td align ="center">' . $usercrops[$c]->{'crop_name'} . '</td>';
                            echo '<td align ="center">' . $usercrops[$c]->{'crop_expected_quantity'} . '</td>';
                            echo '<td align ="center">' . $usercrops[$c]->{'crop_harvest_date'} . '</td>';

                            echo '<td align ="center"><a class="edit" href="" >Edit</a></td>';
                            echo '<td align ="center"><a class="delete" href="">Delete</a></td>';

                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                </table>                

            </div>

            <div id ="AddCropDiv" title ="Add a crop">

                <form id="addform" class="appnitro"  method="post" action="">
                    <div class="form_description">
                    
                        <p>Please fill in the details of your crop and click submit.</p>
                    
                    </div>						

                    <table>	<tr>

                            <td>
                                <label class="description" for="element_3">Crop Name: </label>
                            </td>
                            <td>
                                <select class="elementText" id="element_3" name="element_3" size ="1" maxlength="12"> 
                                    <option value="" selected="selected"></option>

                                    <?php
                                    for ($c = 0; $c < count($cropsarray); $c++) {

                                        if (in_array($cropsarray[$c], $stack)) {
                                            
                                        } else {
                                            echo '<option value="' . $c . '">';
                                            echo $cropsarray[$c];
                                            echo '</option>';
                                        }
                                    }
                                    ?>


                                </select>
                            </td>

                        </tr>	

                        <tr><td>
                                <label class="description" for="element_1">Quantity:</label>
                            </td>
                            <td>

                                <input id="element_1" name="element_1" class="elementText" type="text" maxlength="12" SIZE="12" value=""/> 
                            </td>		<tr>
                            <td>
                                <label class="description" for="element_2_1">Expected Harvest Date: </label></td>
                            <td>

                                <input class="elementText" type="Text" id="element_2_1" maxlength="12" size="12" readonly="readonly">
                            </td>
                        </tr>


                    </table>
                </form>	
            </div>


        </div>
    </body>                                                                 
</html>