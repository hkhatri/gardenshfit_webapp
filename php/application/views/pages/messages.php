<?php session_start();?>
<html>
<head>
      
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

        <link href="../../../css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../../css/jquery-ui.css" rel="stylesheet" type="text/css"/>  
        <link rel="stylesheet" type="text/css" href="../../../css/jquery.validate.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/style1.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/messages.css" />

        

        <script src="../../../js/jquery.validate.js" type="text/javascript"></script>
        <script src="../../../js/formValidation.js" type="text/javascript"></script>
        <script src="../../../js/messages.js" type="text/javascript"></script>
           
<style type="text/css" title="currentStyle">
        @import "../../../css/demo_page.css";
        @import "../../../css/jquery.datatables.messages.css";
</style>
<script type="text/javascript" language="javascript" src="../../../js/jquery.datatables.messages.js"></script>

        <style type="text/css">

        </style>
        <script type="text/javascript">

        
            window.onload= function(){
                
               usern= '<?php echo($username) ?>'; }
            
            

    </script>
</head>
<body>
        
    
     
     <div id="unreadmsgs">
            <button type="button" id ="goBackButton" style ="align:right;" >Go Back</button> <br/><br/>
                <div id ="urm"><strong>Unread Messages</strong></div>
                <table id="unreadmsgs_table" class="display" style="width: 1200px; background-color:lightgray;">
                    <thead>
                        <tr><th style="width: 20px; ">view</th>
                            <th style="width: 20px; ">From</th>
                            <th style="width: 20px; ">Message</th>
                            <th >Date</th>
                            
                            <th>Delete</th>
                            <th style="width: 20px; visibility:hidden">data</th>
                            <th style="width: 20px; visibility:hidden">data1</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                        global $stack;
//                        $stack = array();
                        ?>
                        <?php
                        date_default_timezone_set('America/New_York');
                        for ($c = 0; $c < count($unreadmsgs); $c++) {
                            echo '<tr>';

                         
                           
                            echo '<td align ="center">' . $unreadmsgs[$c]->{'from'} . '</td>';
                            echo '<td align ="center">' . substr($unreadmsgs[$c]->{'text'} , 0, 10).'... '.'</td>';
                            $date = date("D, d M Y", $unreadmsgs[$c]->{'timestamp'}/1000 );
                            $time = date("H:i:s", $unreadmsgs[$c]->{'timestamp'}/1000 );
                            echo '<td align ="center">' . $date .' at '.$time . '</td>';
                           echo '<td align ="center" ><a class="delete" href="">Delete</a></td>';
                           echo '<td align ="center">' . $unreadmsgs[$c]->{'text'}.'</td>';
                           echo '<td align ="center">' . $unreadmsgs[$c]->{'timestamp'}.'</td>';
                        echo '<td align ="center" ><a class="reply" href="">Reply</a></td>';
                           

                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                </table>                

            </div>
    
         <div id="readmsgs">
                <div id ="rm"><strong>Read Messages</strong></div>
                <table id="readmsgs_table" class="display" style="width: 1200px; background-color:lightgray;">
                    <thead>
                        <tr>
                            <th style="width: 20px; ">view</th>
                            <th style="width: 20px; ">From</th>
                            <th style="width: 20px; ">Message</th>
                            <th style="width: 20px; ">Date</th>

                            <th>Delete</th>
                            <th style="width: 20px; visibility:hidden">data</th>
                            <th style="width: 20px; visibility:hidden">data1</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //global $stack;
                        //$stack = array();
                        ?>
                        <?php
                        date_default_timezone_set('America/New_York');
                        for ($c = 0; $c < count($readmsgs); $c++) {
                            echo '<tr>';

//                            array_push($stack, $usercrops[$c]->{'crop_name'});

                            echo '<td align ="center">' . $readmsgs[$c]->{'from'} . '</td>';
                           echo '<td align ="center">' . substr($readmsgs[$c]->{'text'} , 0, 10).'... '.'</td>';
                            $date = date("D, d M Y", $readmsgs[$c]->{'timestamp'}/1000 );
                            $time = date("H:i:s", $readmsgs[$c]->{'timestamp'}/1000 );
                            echo '<td align ="center">' . $date .' at '.$time . '</td>';

                            echo '<td align ="center"><a class="delete" href="">Delete</a></td>';
                             echo '<td align ="center">' . $readmsgs[$c]->{'text'}.'</td>';
                           echo '<td align ="center">' . $readmsgs[$c]->{'timestamp'}.'</td>';
                           echo '<td align ="center"><a class="reply" href="">Reply</a></td>';
                           

                            echo '</tr>';
                        }
                        ?>
                    </tbody>

                </table>                

            </div>
    <div id="reply">
                    <form id="replyform" class="appnitro"  method="post" action="">
                <div class="form_description">
                    <h2>Reply</h2>
                    <p>Please type in your message and click send.</p>
                </div>
                <table>

                    <tr><td>
                            <label class="description" for="element_1">To:</label>
                        </td><td>
                            <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="" readonly="readonly"/> 

                        </td></tr>		
                    <tr><td>
                            <label class="description" for="element_3" value="">Message: </label>
                        </td><td>

                            <TEXTAREA NAME="comments" COLS=50 ROWS=12 id="element_3" name="element_3" class="element text medium" value=""></TEXTAREA> 
                        </td></tr></table>
            </form>
    </div>
</body>
</html>