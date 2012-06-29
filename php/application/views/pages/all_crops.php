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

  <script type="text/javascript" src="../../../js/all_crops.js"></script>
        
        
        <link rel="stylesheet" type="text/css" href="../../../css/all_crops.css" />

     
        

    </head>
    <body>
        <div id ="main">
      

    <div id="tablediv">
        <button type="button" id ="addnewcrop" >Add a Crop</button> 
        <br/>
        <br/>
        <table id="table_id" class="display" style="width: 800px;">
            <thead>
                <tr>
                    <th style="width: 20px; ">Crop name</th>
                    <th style="width: 20px; ">Description</th>

                </tr>
            </thead>
            <tbody>
                <?php
                global $stack;
                $stack = array();
                ?>
                <?php
                for ($c = 0; $c < count($allcrops); $c++) {
                    echo '<tr>';

                    array_push($stack, $allcrops[$c]->{'crop_name'});

                    echo '<td>' . $allcrops[$c]->{'crop_name'} . '</td>';
                    echo '<td>' . $allcrops[$c]->{'crop_description'} . '</td>';

                    echo '</tr>';
                }
                ?>
            <script type="text/javascript"> array2 = <?php echo json_encode($stack); ?>;</script>
            </tbody>

        </table>    

        <div id ="AddCrop">

            <form id="addform" class="appnitro"  method="post" action="">
                <div class="form_description">
                    <h2>Add a crop</h2>
                    <p>Please fill in the details of a crop and click submit.</p>
                    <p id="emptycrop" style="display: none" > <font color="red">Please select a Crop.</font></p>
                    <p id="emptydesc" style="display: none" > <font color="red">Please enter the Description.</font></p>
                    <p id="existingcrop" style="display: none" > <font color="red">A crop entry already exists with the given name-Sorry.</font></p>

                </div>
                <table>

                    <tr><td>
                            <label class="description" for="element_3">Crop Name </label>
                        </td><td>
                            <input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/> 

                        </td></tr>		
                    <tr><td>
                            <label class="description" for="element_1">Description </label>
                        </td><td>

                            <TEXTAREA NAME="comments" COLS=40 ROWS=6 id="element_1" name="element_1" class="element text medium" value=""></TEXTAREA> 
                        </td></tr></table>
            </form>	
        </div>
    </div>
        </div>
</body>
</html>
