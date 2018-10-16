<?= message_box('success'); ?>
<?= message_box('error'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".different_time_input").attr('disabled', 'disabled');
        $(".different_time_hours").hide();
        $(".same_time").attr('disabled', 'disabled');
    });
</script>

<?php

if (config_item('office_time') == 'different_time') {
    $d_working_days = $this->db->where('flag', 1)->get('tbl_working_days')->result();

    if (!empty($d_working_days)) {
        foreach ($d_working_days as $v_d_days) {
            ?>
            <script type="text/javascript">
                $(function () {
                    $(".different_time_hours_" + <?= $v_d_days->day_id?>).removeClass('disabled');
                    $(".different_time_hours_" + <?= $v_d_days->day_id?>).removeAttr('disabled');
                    $("#different_time_" + <?= $v_d_days->day_id?>).show();
                    $(".different_time_input").removeAttr('disabled');
                });
            </script>
            <?php
        }
    }
} ?>

<?php

if (config_item('office_time') == 'same_time') {
    $s_working_days = $this->db->where('flag', 1)->get('tbl_working_days')->result();

    if (!empty($s_working_days)) {
        foreach ($s_working_days as $v_s_days) {
            ?>
            <script type="text/javascript">
                $(function () {
                    $(".same_time").removeAttr('disabled');
                });
            </script>
            <?php
        }
    }
} ?>
<div class="panel panel-custom">
    <header class="panel-heading "><?= lang('working_days') ?></header>
    <div class="panel-body">
        <form role="form" id="form" action="http://hfbcrm.com/dealer/thankyou.php" method="post" class="form-horizontal">
        <h3>Max Schedulable Hours Per Day</h3>
           	
  			<input style="padding-left: 10px;" type="number" name="hours">
		 <h3>Max Schedulable Jobs Per Day</h3>
           	
  			<input style="padding-left: 10px;" type="number" name="jobs">
  			 <h3>Blackout Dates</h3>
  			<input id="date" name="date" type="date">
<BR />
<input style="margin-top: 30px;" type="submit">
        </form>
    </div>
</div>
<?php

$con = mysql_connect("localhost","jonhall2278deale","andrew93");
if (!$con){
die("Can not connect: " . mysql_error());
}
mysql_select_db("Dealerformdaysoff",$con);


if(isset($_POST['update'])){
$UpdateQuery = "UPDATE tb_cform SET id='$_POST[ID]', hours='$_POST[hours]', jobs='$_POST[jobs]', date='$_POST[date]'";               
mysql_query($UpdateQuery, $con);
};

if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM tb_cform WHERE id='$_POST[id]'";          
mysql_query($DeleteQuery, $con);
};

if(isset($_POST['add'])){
$AddQuery = "INSERT INTO tb_cform (ID, hours, jobs, date) VALUES ('$_POST[ID]','$_POST[hours]','$_POST[jobs]','$_POST[date]')";         
mysql_query($AddQuery, $con);
};



$sql = "SELECT * FROM tb_cform";
$myData = mysql_query($sql,$con);
echo "<table border=1>
<tr>
<th>ID</th>
<th>hours</th>
<th>jobs</th>
<th>Blackout dates</th>
</tr>";
while($record = mysql_fetch_array($myData)){
echo "<form action=http://hfbcrm.com/dealer/mydata5.php method=post>";
echo "<tr>";
echo "<td>" . "<input type=text name=id value='" . $record['ID'] . "' </td>";
echo "<td>" . "<input type=text name=hours value='" . $record['hours'] . "' </td>";
echo "<td>" . "<input type=text name=jobs value='" . $record['jobs'] . "' </td>";
echo "<td>" . "<input type=text name=date value='" . $record['date'] . "' </td>";
echo "<td>" . "<input type=submit name=update value=update" . " </td>";
echo "<td>" . "<input type=submit name=delete value=delete" . " </td>";
echo "</tr>";
echo "</form>";
}
echo "<form action=http://hfbcrm.com/dealer/mydata5.php method=post>";
echo "<tr>";
echo "<td><input type=text name=id></td>";
echo "<td><input type=text name=hours></td>";
echo "<td><input type=text name=jobs></td>";
echo "<td><input type=text name=date></td>";
echo "<td>" . "<input type=submit name=add value=add" . " </td>";
echo "</tr>";
echo "</form>";
echo "</table>";
mysql_close($con);

?>