<html>
<head>
</head>
<body>
<?php
         if(isset($_POST['update'])) {
            $dbhost = 'localhost';
            $dbuser = 'jonhall2278deale';
            $dbpass = 'andrew93';
            
            $conn = mysql_connect($dbhost, $dbuser, $dbpass);
            
            if(! $conn ) {
               die('Could not connect: ' . mysql_error());
            }
            
            $leads_id = $_POST['leads_id'];
            $technician = $_POST['technician'];
            
            $sql = "UPDATE tbl_leads SET technician='$_POST[technician]' WHERE leads_id='$_POST[leads_id]'";
            mysql_select_db('dealercoll');
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "<meta http-equiv='refresh' content='1; url=http://hfbcrm.com/dealer/admin/leads#workinprogress'>";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "400" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr>
                        <td width = "100">Employee ID</td>
                        <td><input name = "leads_id" type = "text" 
                           id = "leads_id"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Employee Salary</td>
                        <td>
                        <select name="technician">
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
  <option value="DETAIL">DETAIL</option>
  <option value="TOW-IN">TOW-IN</option>
</select>
                       
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            <?php
         }
      ?>

</body>
</html>