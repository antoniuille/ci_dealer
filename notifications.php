<?php
         if(isset($_POST['updates'])) {
            $dbhost = 'localhost';
            $dbuser = 'jonhall2278deale';
            $dbpass = 'andrew93';
            
            $conn = mysql_connect($dbhost, $dbuser, $dbpass);
            
            if(! $conn ) {
               die('Could not connect: ' . mysql_error());
            }
            
            $leads_id = $_POST['leads_id'];
            $notifications = $_POST['notifications'];
            
            $sql = "UPDATE tbl_leads SET notifications='$_POST[notifications]' WHERE leads_id='$_POST[leads_id]'";
            mysql_select_db('dealercoll');
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "<meta http-equiv='refresh' content='1; url=http://hfbcrm.com/dealer/admin/leads#workinprogress'>";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "200" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="notifications">
                         <option value="" selected disabled hidden><?= $v_leads->notifications ?></option>
  <option value="Off">Off</option>
  <option value="SMS">SMS</option>
  <option value="Email">Email</option>
</select>
                       </td>
                        <td>
                           <input name = "updates" type = "submit" 
                              id = "updates" value = "Updates">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?>