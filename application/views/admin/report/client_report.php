<!-- START row-->
<?php
$client_payments = 0;
$client_outstanding = 0;
$total_estimate = 0;
$started = 0;
$in_progress = 0;
$cancel = 0;
$completed = 0;

$tickets_answered = 0;
$tickets_closed = 0;
$tickets_open = 0;
$tickets_in_progress = 0;

if (!empty($all_client_info)):foreach ($all_client_info as $v_client):

    $client_payments += $this->report_model->get_sum('tbl_payments', 'amount', $array = array('paid_by' => $v_client->client_id));
    $client_outstanding += $this->invoice_model->client_outstanding($v_client->client_id);
    $client_estimates = $this->db->where('client_id', $v_client->client_id)->get('tbl_estimates')->result();
    if (!empty($client_estimates)) {
        foreach ($client_estimates as $estimate) {
            $total_estimate += $this->estimates_model->estimate_calculation('estimate_amount', $estimate->estimates_id);
        }
    }
    $project_client = $this->db->where('client_id', $v_client->client_id)->get('tbl_project')->result();

    if (!empty($project_client)) {
        foreach ($project_client as $v_project) {
            if ($v_project->project_status == 'started') {
                $started += count($v_project->project_status);
            }
            if ($v_project->project_status == 'in_progress') {
                $in_progress += count($v_project->project_status);
            }
            if ($v_project->project_status == 'completed') {
                $completed += count($v_project->project_status);
            }
            if ($v_project->project_status == 'cancel') {
                $cancel += count($v_project->project_status);
            }
        }

    }
    $project_tickets = $this->db->get('tbl_tickets')->result();
    if (!empty($project_tickets)) {
        foreach ($project_tickets as $v_tickets) {
            $profile_info = $this->db->where(array('user_id' => $v_tickets->reporter))->get('tbl_account_details')->row();
            if (!empty($profile_info)) {
                if ($profile_info->company == $v_client->client_id) {
                    if ($v_tickets->status == 'answered') {
                        $tickets_answered += count($v_tickets->status);
                    }
                    if ($v_tickets->status == 'closed') {
                        $tickets_closed += count($v_tickets->status);
                    }
                    if ($v_tickets->status == 'open') {
                        $tickets_open += count($v_tickets->status);
                    }
                    if ($v_tickets->status == 'in_progress') {
                        $tickets_in_progress += count($v_tickets->status);
                    }
                }
            }
        }

    }

endforeach;
endif;

?>
<div class="row">

    <div class="col-md-6">
        <div id="panelChart5" class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">Job Total</div>
                
            </div>
            <div class="panel-body">
               <?php
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "dealercoll";

// Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT job_total FROM tbl_leads";
$result = $conn->query($sql);
$query_run = mysql_query($query);



if ($result->num_rows > 0) {
    // output data of each row
    $qty = 0;
    while($row = $result->fetch_assoc()) {
        $qty += $row["job_total"];
    } 
} echo "<h4>May Total:</h4><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>$" . $qty . "</p>";



$conn->close();
?> 

            </div>
        </div>
    </div>
        <div class="col-md-6">
        <div id="panelChart5" class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">Jobs</div>
            </div>
            <div class="panel-body">
                     <?php
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "dealercoll";

// Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT lead_status_id FROM tbl_leads";
$result = $conn->query($sql);
$query_run = mysql_query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $canceled = 0;
    $opened = 0;
    $completed = 0;
    $totalloss = 0;
    $delivered = 0;
    $deliveredtemp = 0;
    $opens = 0;
    while($row = $result->fetch_assoc()) {
        $displayname = $row["lead_status_id"];
        
        if ($displayname == 21) {
            $canceled += 1;
        }
        elseif ($displayname == 22) {
            $totalloss += 1;
        }
        elseif ($displayname == 18) {
            $delivered += 1;
        }
        elseif ($displayname == 19) {
            $deliveredtemp += 1;
        }
        else {
        $opens += 1;
        }
               
           
   
    } 
} ?>    <?php 
echo "<h3>May:</h3>";
echo "<a href='/dealer/admin/leads/index/by_status/21'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>- Cancelled: " . $canceled . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_status/20'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>- Total Loss: " . $totalloss . "</p></a>";
echo "<a href='//dealer/admin/leads/index/by_status/18'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>- Delivered: " . $delivered . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_status/19'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>- Delivered - Temp: " . $deliveredtemp . "</p></a>";
echo "<a href='/dealer/admin/leads#workinprogress'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>- Open: " . $opens . "</p></a>";





$conn->close();
?>  
            </div>
        </div>
    </div>
    <div class="col-lg-6">

        <div id="panelChart4" class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">Bill To</div>
            </div>
            <div class="panel-body">
                             <?php
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "dealercoll";

// Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT lead_source_id FROM tbl_leads";
$result = $conn->query($sql);
$query_run = mysql_query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $qty = 0;
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;
    $five = 0;
    $six = 0;
    $seven = 0;
    $eight = 0;
    $nine = 0;
    $ten = 0;
    $eleven = 0;
    $twelve = 0;
     $tt = 0;
$tt = 0;
       
        	$ft = 0;
      
        	$fft = 0;
      
        	$st = 0;
        
        	$svt = 0;
       
        	$et = 0;
      
        	$nt = 0;
       
        	$tw = 0;
      
        	$two = 0;
      
        	$twt = 0;
     
        
        	$twe = 0;
 
        
        	$twf = 0;
   
      
        	$twd = 0;
     
       
        	$tws = 0;
        	$twss = 0;
      
    while($row = $result->fetch_assoc()) {
        $displayname = $row["lead_source_id"];
        
        if ($displayname == 1) {
        	$one += 1;
        }
               
                if ($displayname == 2) {
        	$two += 1;
        }
                if ($displayname == 3) {
        	$three += 1;
        }
                if ($displayname == 4) {
        	$four += 1;
        }
                if ($displayname == 5) {
        	$five += 1;
        }
                if ($displayname == 6) {
        	$six += 1;
        }
                if ($displayname == 7) {
        	$seven += 1;
        }
                if ($displayname == 8) {
        	$eight += 1;
        }
                if ($displayname == 9) {
        	$nine += 1;
        }
                if ($displayname == 10) {
        	$ten += 1;
        }
                if ($displayname == 11) {
        	$eleven += 1;
        }
                if ($displayname == 12) {
        	$twelve += 1;
        }
        if ($displayname == 13) {
        	$tt += 1;
        }
         if ($displayname == 14) {
        	$ft += 1;
        }
         if ($displayname == 15) {
        	$fft += 1;
        }
         if ($displayname == 16) {
        	$st += 1;
        }
         if ($displayname == 17) {
        	$svt += 1;
        }
         if ($displayname == 18) {
        	$et += 1;
        }
         if ($displayname == 19) {
        	$nt += 1;
        }
         if ($displayname == 20) {
        	$tw += 1;
        }
         if ($displayname == 21) {
        	$two += 1;
        }
         if ($displayname == 22) {
        	$twt += 1;
        }
         if ($displayname == 23) {
        	$twe += 1;
        }
         if ($displayname == 24) {
        	$twf += 1;
        }
         if ($displayname == 25) {
        	$twd += 1;
        }
         if ($displayname == 26) {
        	$tws += 1;
        }
        if ($displayname == 27) {
        	$twss += 1;
        }
    } 
} ?>    <?php echo "<h3>May Total:</h3><div class='col-md-6'> <a href='/dealer/admin/leads/index/by_source/1'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Farmers: " . $one . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/2'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>American Family: " . $two . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/3'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>21st Century: " . $three . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/4'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>AAA: " . $four . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/5'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>AAA of CALIFORNIA: " . $five . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/6'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>ACUITY: " . $six . "</p>";
echo "<a href='/dealer/admin/leads/index/by_source/7'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Alliance Claims Solutions: " . $seven . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/8'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Allied: " . $eight . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/9'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Allstate: " . $nine . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/10'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>American National: " . $ten . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/11'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Ameriprise: " . $eleven . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/12'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Amica: " . $twelve . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/13'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>ANPAC: " . $tt . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/14'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Auto Owners: " . $ft . "</p></a>"; ?> </div><div class="col-md-6">  <?php
echo "<a href='/dealer/admin/leads/index/by_source/15'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Bear River: " . $fft . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/16'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Bristol West: " . $st . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/17'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>California Casualty: " . $svt . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/18'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Casualty Underwriters: " . $et . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/19'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>CEI: " . $nt . "</p>";
echo "<a href='/dealer/admin/leads/index/by_source/20'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>CINCINNATI INSURANCE: " . $tw . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/21'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Country Mutual: " . $two . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/22'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Customer Pay: " . $twt . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/23'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Depositors Insurance: " . $twe . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/24'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>EMC INSURANCE COMPANY: " . $twf . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/25'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Enterprise Rent-A-Car: " . $twd . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/26'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Erie Insurance: " . $tws . "</p></a>";
echo "<a href='/dealer/admin/leads/index/by_source/27'><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>Esurance: " . $twss . "</p></a>";




$conn->close();
?>  
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div id="panelChart5" class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">Technician Report</div>
            </div>
            <div class="panel-body">
            <!--    <?php
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "dealercoll";

// Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ro_number, lead_name, schedule_hours, technician, created_time  FROM tbl_leads";
$result = $conn->query($sql);
$query_run = mysql_query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $qty = 0;
    $totalhours = 0;
    echo "<h4>Technician Jon:</h4><table style='padding-left: 18px;'><tr><th>RO#</th><th>Customer</th><th> Technician </th><th> Hours </th><th> Receive Date </th></tr>";
    while($row = $result->fetch_assoc()) {
    $totalhours += $row["schedule_hours"];
        echo "<tr><td><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;'>" . $row["ro_number"] . "</p></td><Td><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;'>" . $row["lead_name"] . "</p></td><Td><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;'> " . $row["technician"] . " </p></td><Td><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;'> " . $row["schedule_hours"] . "</p></td><Td><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;'>" . $row["created_time"] . "</p></td></tr>";
    } 
    echo "</tr></table>";
} 

 echo "<h4>Total Hours:</h4><p style='font-size: 19px; margin-top: 6px; margin-bottom: 10px;color: black;padding-left: 18px;'>$" . $totalhours . "</p>";




$conn->close();
?> -->
<h4>DAN STEVENS</h4>
<table>
  <tr>
    <th>RO#</th>
    <th>Customer</th>
    <th>Technician</th>
    <th>RO Hours</th>
    <th>Received Date</th>
    <th>Delivery Date</th>
    <th>Days</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<hr />
<h4>DAVE KIRKLAND</h4>
<table>
   <tr>
    <th>RO#</th>
    <th>Customer</th>
    <th>Technician</th>
    <th>RO Hours</th>
    <th>Received Date</th>
    <th>Delivery Date</th>
    <th>Days</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<hr />
<h4>JEREMY FLOWERS</h4>
<table>
  <tr>
    <th>RO#</th>
    <th>Customer</th>
    <th>Technician</th>
    <th>RO Hours</th>
    <th>Received Date</th>
    <th>Delivery Date</th>
    <th>Days</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<hr />
<h4>MARK STEVENS</h4>
<table>
  <tr>
    <th>RO#</th>
    <th>Customer</th>
    <th>Technician</th>
    <th>RO Hours</th>
    <th>Received Date</th>
    <th>Delivery Date</th>
    <th>Days</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<hr />
<h4>PAUL VLAHOVICH</h4>
<table>
  <tr>
    <th>RO#</th>
    <th>Customer</th>
    <th>Technician</th>
    <th>RO Hours</th>
    <th>Received Date</th>
    <th>Delivery Date</th>
    <th>Days</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url() ?>assets/plugins/Chart/Chart.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.resize.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.pie.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.time.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.categories.js"></script>
<script src="<?= base_url() ?>assets/plugins/Flot/jquery.flot.spline.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        // Polar chart
        // -----------------------------------
        var polarData = [
            {
                value: <?= $client_payments + $client_outstanding?>,
                color: '#27c24c',
                highlight: '#27c24c',
                label: '<?= lang('invoice_amount')?>'
            },
            {
                value: <?= $client_payments?>,
                color: '#23b7e5',
                highlight: '#23b7e5',
                label: '<?= lang('paid_amount')?>'
            },
            {
                value: <?= $client_outstanding?>,
                color: '#ff902b',
                highlight: '#ff902b',
                label: '<?= lang('due_amount')?>'
            },
            {
                value: <?= $total_estimate?>,
                color: '#f05050',
                highlight: '#f05050',
                label: '<?= lang('estimates') . ' ' . lang('amount')?>'
            },
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: 'rgba(255,255,255,0.75)',
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: '#fff',
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: 'easeOutBounce',
            animateRotate: true,
            animateScale: false,
            responsive: true
        };

        var polarctx = document.getElementById("chartjs-polarchart").getContext("2d");
        var polarChart = new Chart(polarctx).PolarArea(polarData, polarOptions);

        // CHART PIE
        // -----------------------------------
        (function (window, document, $, undefined) {

            $(function () {

                var data = [{
                    "label": "<?= lang('paid_amount')?>",
                    "color": "#23b7e5",
                    "data": <?= $client_payments?>
                }, {
                    "label": "<?= lang('due_amount')?>",
                    "color": "#ff902b",
                    "data": <?= $client_outstanding?>
                }, {
                    "label": "<?= lang('invoice_amount')?>",
                    "color": "#27c24c",
                    "data": <?= $client_payments + $client_outstanding?>
                }, {
                    "label": "<?= lang('estimates') . ' ' . lang('amount')?>",
                    "color": "#f05050",
                    "data": <?= $total_estimate?>
                }];

                var options = {
                    series: {
                        pie: {
                            show: true,
                            innerRadius: 0,
                            label: {
                                show: true,
                                radius: 0.8,
                                formatter: function (label, series) {
                                    return '<div class="flot-pie-label">' +
                                            //label + ' : ' +
                                        Math.round(series.percent) +
                                        '%</div>';
                                },
                                background: {
                                    opacity: 0.8,
                                    color: '#222'
                                }
                            }
                        }
                    }
                };

                var chart = $('.chart-pie');
                if (chart.length)
                    $.plot(chart, data, options);

            });

        })(window, document, window.jQuery);

        // CHART PIE
        // -----------------------------------
        (function (window, document, $, undefined) {

            $(function () {

                var data = [{
                    "label": "<?= lang('started')?>",
                    "color": "#ff902b",
                    "data": <?= $started?>
                }, {
                    "label": "<?= lang('in_progress')?>",
                    "color": "#5d9cec",
                    "data": <?= $in_progress?>
                }, {
                    "label": "<?= lang('completed')?>",
                    "color": "#23b7e5",
                    "data": <?= $completed?>
                }, {
                    "label": "<?= lang('cancel')?>",
                    "color": "#7266ba",
                    "data": <?= $cancel?>
                }];

                var options = {
                    series: {
                        pie: {
                            show: true,
                            innerRadius: 0,
                            label: {
                                show: true,
                                radius: 0.8,
                                formatter: function (label, series) {
                                    return '<div class="flot-pie-label">' +
                                            //label + ' : ' +
                                        Math.round(series.percent) +
                                        '%</div>';
                                },
                                background: {
                                    opacity: 0.8,
                                    color: '#222'
                                }
                            }
                        }
                    }
                };

                var chart = $('.project_chart-pie');
                if (chart.length)
                    $.plot(chart, data, options);

            });

        })(window, document, window.jQuery);
        // CHART PIE
        // -----------------------------------
        (function (window, document, $, undefined) {

            $(function () {
                var data = [{
                    "label": "<?= lang('answered')?>",
                    "color": "#ff902b",
                    "data": <?= $tickets_answered?>
                }, {
                    "label": "<?= lang('in_progress')?>",
                    "color": "#5d9cec",
                    "data": <?= $tickets_in_progress?>
                }, {
                    "label": "<?= lang('closed')?>",
                    "color": "#23b7e5",
                    "data": <?= $tickets_closed?>
                }, {
                    "label": "<?= lang('open')?>",
                    "color": "#7266ba",
                    "data": <?= $tickets_open?>
                }];

                var options = {
                    series: {
                        pie: {
                            show: true,
                            innerRadius: 0,
                            label: {
                                show: true,
                                radius: 0.8,
                                formatter: function (label, series) {
                                    return '<div class="flot-pie-label">' +
                                            //label + ' : ' +
                                        Math.round(series.percent) +
                                        '%</div>';
                                },
                                background: {
                                    opacity: 0.8,
                                    color: '#222'
                                }
                            }
                        }
                    }
                };

                var chart = $('.tickets_chart-pie');
                if (chart.length)
                    $.plot(chart, data, options);

            });

        })(window, document, window.jQuery);
        // CHART BAR STACKED
        // -----------------------------------

    });

</script>
<style>
td {
padding-left: 20px;
padding-right: 20px;
}
th {
padding-left: 20px;
padding-right: 20px;
}
</style>