<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action('55', 'created');
$edited = can_action('55', 'edited');
$deleted = can_action('55', 'deleted');
$kanban = $this->session->userdata('leads_kanban');
$uri_segment = $this->uri->segment(4);
if (!empty($kanban)) {
    $k_leads = 'kanban';
} elseif ($uri_segment == 'kanban') {
    $k_leads = 'kanban';
} else {
    $k_leads = 'list';
}

if ($k_leads == 'kanban') {
    $text = 'list';
    $btn = 'purple';
} else {
    $text = 'kanban';
    $btn = 'danger';
}

?>


<div class="row mb-lg">
    <div class="col-sm-2 ">
        <div class="pull-left pr-lg">
            <a href="<?= base_url() ?>admin/leads/index/<?= $text ?>"
               class="btn btn-xs btn-<?= $btn ?> pull-right"
               data-toggle="tooltip"
               data-placement="top" title="<?= lang('switch_to_kanban') ?>">
                <i class="fa fa-undo"> </i>Switch to Drag & Drop
            </a>
        </div>
    </div>
    <?php if ($text == 'kanban') {
        $type = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        ?>
        <div class="col-sm-2">
            <div class="btn-group">
                <button class=" btn btn-xs btn-white dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fa fa-search"></i>
Filter By Job Status
                    <?php
                    
                    if (!empty($type) && $type == 'by_status') {
                        $key_name = $this->db->where('lead_status_id', $id)->get('tbl_lead_status')->row();
                        echo ' : ' . $key_name->lead_status;
                    } ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu animated zoomIn">
                    <li><a href="<?= base_url() ?>admin/leads/index/by_status/all"><?= lang('none'); ?></a></li>
                    <?php
                    $astatus_info = $this->db->get('tbl_lead_status')->result();
                    if (!empty($astatus_info)) {
                        foreach ($astatus_info as $v_status) {
                            ?>
                            <li <?php if (!empty($type) && $type == 'by_status' && $v_status->lead_status_id == $id) {
                                echo 'class="active"';
                            } ?> >
                                <a href="<?= base_url() ?>admin/leads/index/by_status/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        
        

                 <div class="col-sm-2">
            <div class="btn-group">
                <button class=" btn btn-xs btn-white dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fa fa-search"></i>
                            Notes Status
                    <?php
                    
                    if (!empty($type) && $type == 'by_status') {
                        $key_name = $this->db->where('lead_status_id', $id)->get('tbl_lead_status')->row();
                        echo ' : ' . $key_name->lead_status;
                    } ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu animated zoomIn">
                <li><a href="<?= base_url() ?>admin/leads/index/by_status/all"><?= lang('none'); ?></a></li>
                    <li><a href="<?= base_url() ?>admin/leads/index/by_status/all">Show</a></li>
                    <li><a href="<?= base_url() ?>admin/leads/index/by_status/all">Hide</a></li>
                    
                </ul>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="btn-group">
                <button class=" btn btn-xs btn-white dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fa fa-search"></i>
                            Job Status
                    <?php
                    
                    if (!empty($type) && $type == 'by_status') {
                        $key_name = $this->db->where('lead_status_id', $id)->get('tbl_lead_status')->row();
                        echo ' : ' . $key_name->lead_status;
                    } ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu animated zoomIn">
                <li><a id="all">All</a></li>
                    <li><a id="open">Open</a></li>
                    <li><a id="close">Closed</a></li>
                    
                </ul>
            </div>
        </div>
        
        
        
        
        <div class="col-sm-2">
            <div class="btn-group">
                <button class=" btn btn-xs btn-white dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fa fa-search"></i>
Filter By Insurance Company
                    <?php
                    
                    if (!empty($type) && $type == 'by_source') {
                        $key_name = $this->db->where('lead_source_id', $id)->get('tbl_lead_source')->row();
                        echo ' : ' . $key_name->lead_source;
                    } ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu animated zoomIn">
                    <li><a href="<?= base_url() ?>admin/leads/index/by_source/all"><?= lang('none'); ?></a></li>
                    <?php
                    $asource_info = $this->db->get('tbl_lead_source')->result();
                    if (!empty($asource_info)) {
                        foreach ($asource_info as $v_source) {
                            ?>
                            <li <?php if (!empty($type) && $type == 'by_source' && $v_source->lead_source_id == $id) {
                                echo 'class="active"';
                            } ?> >
                                <a href="<?= base_url() ?>admin/leads/index/by_source/<?= $v_source->lead_source_id ?>"><?= $v_source->lead_source ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>
 <?php 
 $vinvin = " ";
 $carmake = " ";
 $carmodel = " ";
 $caryear = " ";
 
 if(isset($_POST['submit']) && !empty($_POST['vin'])){

    require realpath($_SERVER['DOCUMENT_ROOT']).'/dealer/vendor/autoload.php';

    define('API_BASE_URL', 'https://vindecoder.p.mashape.com/v1.1/decode_vin');
    define('API_KEY', 'Q3AxAsAX5DmshZNcer08RigRZvMpp1iJzczjsnN7bQCzpbJc3E');


    $headers = [
        'accept' => 'application/json',
        'X-Mashape-Key' => API_KEY,
        'fmt' => "json"
    ];
    $query = [
        'vin' => $_POST['vin']
    ];

    $response = Unirest\Request::get(API_BASE_URL, $headers, $query);

    $res_body = $response->body;

    if (isset($res_body->success) && $res_body->success) {
        $vinvin = $_POST['vin'];
    
        $carmake = $res_body->specification->make;
        
        $carmodel = $res_body->specification->model;
    
        $caryear = $res_body->specification->year;
        
        echo "Vin: " . $vinvin . "<br>";
        echo "Make: " . $carmake . "<br>";
        echo "Model: " . $carmodel . "<br>";
        echo "Year: " . $caryear . "<br>";
    }
    else {
        echo "<table>";
        echo "<tr><td><b>Error :</b> </td><td> " . isset($res_body->message) ? $res_body->message : "Failed to decode vin." . "<br></td></tr>";
        echo "</table><br><br>";
    }

 }
?>
<form style="padding-bottom: 20px;" method="POST">
	Vin Lookup: <input type="text" name="vin">
	<input type="submit" name="submit" value="Submit">
</form>  
<div class="row">
    <div class="col-sm-12">
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs">
                    <li class="<?= $active == 1 ? 'active' : ''; ?> dispatchjobnone"><a href="#manage"
                                                                        data-toggle="tab">All</a>
                    </li>
                    <li class="<?= $active == 1 ? 'active' : ''; ?> dispatchjob"><a href="#manage"
                                                                        data-toggle="tab">Dispatch Job</a>
                    </li>
                    <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#create"
                                                                        class="hideifneededboy" data-toggle="tab">Add & Schedule</a>
                    </li>
                    
                </ul>
                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong>Dispatch Job</strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables" id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Hours</th>
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
            
                    </tr>
                    </thead>
                    <tbody class="testingdavekirkland">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                             
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                                <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {
$text = $row["comment"];
        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                              
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
      <td><strong>
              <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
      
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?>
</strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>
                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>

            </div>
        <?php } ?>
    </div>
</div>
<div style="margin-top: 50px;" class="row danprint" id="Dan">

    <div class="col-sm-12">
    <h2>DAN STEVENS</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped" id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>

                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                    </tr>
                    </thead>
                    <tbody id="danonlyleads">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td class="leadname">
                                    <a style="color: #000; text-decoration: underline;" href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td class="leadhours"><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td class="leadyear"><?= $v_leads->year ?></td>
                                <td class="leadmake"><?= $v_leads->make ?></td>
                                <td class="leadmodel"><?= $v_leads->model ?></td>
                                <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td class="leadronumber"><?= $v_leads->ro_number ?></td>
                              
                                    <Td class="notifications">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
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
      ?></Td>
                            
                          
                                <td class="leadstatus">

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
             <td class="notes jonnotes"><a style="color: #000;" href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 1) {

        echo "<span style='font-size: 13px;' class='testing dannotes'>" . preg_replace('/<p>/', ' ', $row["comment"]) . "</span><Br />";
    }
    }

    } 
} else {
    echo "View Notes";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?> technicianname">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
      <td class="billto"><Strong>
                <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
      
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?>
</Strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbutton" class="print">Print Dan</button>
<div style="margin-top: 50px;" class="row danprint" id="Dave">

    <div class="col-sm-12">
    <h2>DAVE KIRKLAND</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
    
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        
                        <th>Bill To</th>
                    </tr>
                    </thead>
                    <tbody id="daveonlyleads" class="daveonlyleads">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                              
                                    <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                               
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                <td class="notes jonnotes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?>
       </strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttondave" class="print">Print Dave</button>
<div style="margin-top: 50px;" class="row danprint" id="Jeremy">

    <div class="col-sm-12">
    <h2>JEREMY FLOWERS</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                   
                    </tr>
                    </thead>
                    <tbody id="jeremyleadsonly" class="jeremyleadsonly">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                              <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
   <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
  <option value="DETAIL">DETAIL</option>
  <option value="TOW-IN">TOW-IN</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
       <td><Strong>
                <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
      
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?>
</Strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttonjeremy" class="print">Print Jeremy</button>
<div style="margin-top: 50px;" class="row danprint" id="Mark">

    <div class="col-sm-12">
    <h2>MARK STEVENS</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                      
                    </tr>
                    </thead>
                    <tbody id="leadonlymark" class="leadonlymark">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                                <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
 
         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?></strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttonmark" class="print">Print Mark</button>
<div style="margin-top: 50px;" class="row danprint" id="Paul">

    <div class="col-sm-12">
    <h2>PAUL VLAHOVICH</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                   
                    </tr>
                    </thead>
                    <tbody id="leadonlypaul" class="leadonlypaul">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                                 <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                              
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
       <?php $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       ?>

         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?></strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttonpaul" class="print">Print Mark</button>
<div style="margin-top: 50px;" class="row danprint" id="Paint">

    <div class="col-sm-12">
    <h2>Paint</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                      
                    </tr>
                    </thead>
                    <tbody id="leadonlypaint" class="leadonlypaint">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>s">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                          <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
       <?php $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       ?>

         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?></strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttonpaint" class="print">Print Paint</button>
<div style="margin-top: 50px;" class="row danprint" id="Detail">

    <div class="col-sm-12">
    <h2>Detail</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                
                    </tr>
                    </thead>
                    <tbody id="leadsonlydetail" class="leadsonlydetail">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>s">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                        <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                               
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
       <?php $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       ?>

         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?></strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttondetail" class="print">Print Detail</button>
<div style="margin-top: 50px;" class="row danprint" id="Tow">

    <div class="col-sm-12">
    <h2>Tow-In</h2>
        <?php if ($k_leads == 'kanban') { ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/kanban/kan-app.css"/>
            <div class="app-wrapper">
                <p class="total-card-counter" id="totalCards"></p>
                <div class="board" id="board"></div>
            </div>
            <?php include_once 'assets/plugins/kanban/leads_kan-app.php'; ?>
        <?php } else { ?>
            <?php if (!empty($created) || !empty($edited)) {
                ?>
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content bg-white">
                <!-- ************** general *************-->
                <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
                <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_leads') ?></strong></div>
                </header>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Hours</th>
                        
                       
                        <th class="phonehideforwork"><?= lang('phone') ?></th>
                        
                        <th class="schedulehideforwork">Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th class="vinvinnumber">Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                        <th>Bill To</th>
                 
                    </tr>
                    </thead>
                    <tbody id="leadsonlytowin" class="leadsonlytowin">
                    <?php

                    if (!empty($all_leads)):foreach ($all_leads as $v_leads):
                        if ($v_leads->converted_client_id == 0) {
                            $can_edit = $this->items_model->can_action('tbl_leads', 'edit', array('leads_id' => $v_leads->leads_id));
                            $can_delete = $this->items_model->can_action('tbl_leads', 'delete', array('leads_id' => $v_leads->leads_id));
                            
                            ?>
                            <tr style="display: none;" class="<?= $v_leads->technician ?> <?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "Open";
                                        } else {
                                            $status = "Closed";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>s">
                                <td>
                                    <a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>"><?= $v_leads->lead_name ?></a>
                                </td>
                                
                               <td ><?= $v_leads->schedule_hours ?></td>
                                
                               
                                <td class="phonehideforwork"><?= $v_leads->mobile ?></td>
                                
                                <td class="schedulehideforwork"><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                 <td class="vinvinnumber"><?= $v_leads->vin_number ?></td>
                                <td><?= $v_leads->ro_number ?></td>
                                          <Td>
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
                <form method = "post" action = "http://hfbcrm.com/dealer/notifications.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
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
      ?></Td>
                          
                                <td>

  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown"><span><?php echo $lead_status->lead_status; ?></span>
                                               
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <?php
                                                $astatus_info = $this->db->get('tbl_lead_status')->result();
                                                if (!empty($astatus_info)) {
                                                    foreach ($astatus_info as $v_status) {
                                                        ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>admin/leads/change_status/<?= $v_leads->leads_id ?>/<?= $v_status->lead_status_id ?>"><?= lang($v_status->lead_type) . '-' . $v_status->lead_status ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?> 
                                </td>
                                 
                                <td class="notes"><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments">

        <?php
        $useridforcalling = $v_leads->leads_id;
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

$sql = "SELECT leads_id, user_id, users_id, comment FROM comments order by leads_id desc limit 10000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($useridforcalling == $row["leads_id"]) {
            if ($testing <= 3) {

        echo "<span class='testing dannotes'>" . $row["comment"] . "</span>";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  View Notes</a></td>
                                
                                <Td class="<?= $v_leads->technician ?>">
        
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
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>
               <form method = "post" action = "http://hfbcrm.com/dealer/change_technician.php">
                  <table width = "150" border =" 0" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr style="display: none !important;">
                        <td width = "100">Lead Id ID</td>
                        <td><input name = "leads_id" type = "text" id = "leads_id" value="<?= $v_leads->leads_id ?>"></td>
                     </tr>
                  
                     <tr>
                        <td>
                        <select name="technician">
                         <option value="" selected disabled hidden><?= $v_leads->technician ?></option>
                         <option value="NO TECH">NO TECH</option>
  <option value="DAN STEVENS">DAN STEVENS</option>
  <option value="DAVE KIRKLAND">DAVE KIRKLAND</option>
  <option value="JEREMY FLOWERS">JEREMY FLOWERS</option>
  <option value="MARK STEVENS">MARK STEVENS</option>
  <option value="PAUL VLAHOVICH">PAUL VLAHOVICH</option>
  <option value="PAINT">PAINT</option>
</select>
                       </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                 
                  
                  </table>
               </form>
            <?php
         }
      ?></Td>
         <td><strong>
       <?php $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       ?>

         <?php 
        $leadbilltonumber = $v_leads->lead_source_id; 
       $lead_source_info = $this->db->get('tbl_lead_source')->result();
       foreach ($lead_source_info as $v_lead_source) {
                                            
        $testing = $v_lead_source->lead_source; 
        $countingleads = $v_lead_source->lead_source_id; 
                                            
        if ($leadbilltonumber == $countingleads) {
            echo $testing; 
            }
                                           
                                        }
       ?></strong>
      </td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php if (!empty($created) || !empty($edited)) { ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            
    
            
                <form role="form" enctype="multipart/form-data" id="form"
                      action="<?php echo base_url(); ?>admin/leads/saved_leads/<?php
                      if (!empty($leads_info)) {
                          echo $leads_info->leads_id;
                      }
                      ?>" method="post" class="form-horizontal  ">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->lead_name;
                                }
                                ?>" name="lead_name" required="">
                            </div>
                            
                        </div>
                        
                      
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bill To </label>
                            <div class="col-lg-4">
                                <select name="lead_source_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php
                                    $lead_source_info = $this->db->get('tbl_lead_source')->result();
                                    if (!empty($lead_source_info)) {
                                        foreach ($lead_source_info as $v_lead_source) {
                                            ?>
                                            <option
                                                value="<?= $v_lead_source->lead_source_id ?>" <?= (!empty($leads_info) && $leads_info->lead_source_id == $v_lead_source->lead_source_id ? 'selected' : '') ?>><?= $v_lead_source->lead_source ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Status </label>
                            <div class="col-lg-4">
                                <select name="lead_status_id" class="form-control select_box"
                                        style="width: 100%"
                                        required="">
                                    <?php

                                    if (!empty($status_info)) {
                                        foreach ($status_info as $type => $v_leads_status) {
                                            if (!empty($v_leads_status)) {
                                                ?>
                                                <optgroup label="<?= lang($type) ?>">
                                                    <?php foreach ($v_leads_status as $v_l_status) { ?>
                                                        <option
                                                            value="<?= $v_l_status->lead_status_id ?>" <?php
                                                        if (!empty($leads_info->lead_status_id)) {
                                                            echo $v_l_status->lead_status_id == $leads_info->lead_status_id ? 'selected' : '';
                                                        }
                                                        ?>><?= $v_l_status->lead_status ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                         
                           
                          

                        </div>
                        
                        <!-- End discount Fields -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('mobile') ?><span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php
                                if (!empty($leads_info)) {
                                    echo $leads_info->mobile;
                                }
                                ?>" name="mobile"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">Vin Number<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $vinvin; ?>" name="vin_number" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Make<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmake; ?>" name="make"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Model<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $carmodel; ?>" name="model"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Car Year<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4">
                                <input type="text" min="0" required="" class="form-control" value="<?php echo $caryear; ?>" name="year"/>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                        if (!empty($leads_info)) {
                            $leads_id = $leads_info->leads_id;
                        } else {
                            $leads_id = null;
                        }
                        ?>
                        <?= custom_form_Fields(5, $leads_id, true); ?>

                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($leads_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?>
                                        <i
                                            title="<?= lang('permission_for_customization') ?>"
                                            class="fa fa-question-circle" data-toggle="tooltip"
                                            data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-2 control-label">Assigned Technicians
                                <span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($assign_user)) {
                                    foreach ($assign_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $disable = true;
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $disable = false;
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                        <span
                                                            class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                            $get_permission = json_decode($leads_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     type="checkbox"
                                                     value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input <?php if (!empty($disable)) {
                                                    echo 'disabled' . ' ' . 'checked';
                                                } ?> id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($leads_info->permission) && $leads_info->permission != 'all') {
                                                        $get_permission = json_decode($leads_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                     name="action_<?= $v_user->user_id ?>[]"
                                                     type="checkbox"
                                                     value="delete">
                                                        <span
                                                            class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <?php if (empty($leads_info->converted_client_id) || $leads_info->converted_client_id == 0) { ?>
                                <div class="col-lg-5">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                </div>
                            <?php } ?>
                        </div>

                </form>
            </div>
        <?php } else { ?>
            </div>
        <?php } ?>
            </div>
            
            </div>
        <?php } ?>
    </div>
</div>
<button id="printbuttontowin" class="print">Print Tow-In</button>
<script>
$(document).ready(function(){
  $("#Jon").click(function(){
    $('.Scott').hide();
    $('.None').hide();
    $('.Jon').show();
    $(this).next().toggle();  
         
  });
  $("#workinprogress").click(function(){
 	$('.Schedule').hide();     
 	$('.None').hide();   
 	
  });
   $("#Scott").click(function(){
    $('.Scott').show();
    $('.None').hide();
    $('.Jon').hide();
    $(this).next().toggle();      
  });
    $("#None").click(function(){
    $('.Scott').hide();
    $('.None').show();
    $('.Jon').hide();
    $(this).next().toggle();      
  });


  
if(window.location.href.indexOf("scheduleremove") > -1) {
       $('.Schedule').show();    
                 $("#Dans").remove();
    $("#Dave").remove();
    $("#Jeremy").remove();
    $("#Mark").remove();
    $("#Paul").remove();
    $("#Paint").remove();
    $("#Detail").remove();
    $("#Tow").remove();
    $("#Dan").remove();
        $(".hidewhite").addClass("shownows");
        $(".dispatchjob").remove();
        $(".dispatchjobnone").addClass("shownow");
}

if(window.location.href.indexOf("workinprogress") > -1) {
    $('.Scheduled').remove(); 
       $('.Schedule').remove();    
    $("#Dans .DAN").addClass("shownow");
    $("#Dan .DAN").addClass("shownow");
    $("#Dave .DAVE").addClass("shownow");
    $("#Jeremy .JEREMY").addClass("shownow");
    $("#Mark .MARK").addClass("shownow");
    $("#Paul .PAUL").addClass("shownow");
    $("#Paint .PAINT").addClass("shownow");
    $("#Paint .Paints").addClass("shownow");
    $("#Detail .DETAIL").addClass("shownow");
    $("#Detail .Details").addClass("shownow");
    $("#Tow .TOW-IN").addClass("shownow");
    $("#Tow .Tow-Ins").addClass("shownow");
    $(".testingdavekirkland .Working").addClass("shownow");
    $(".hidewhite").remove();
    $(".hideifneededboy").remove();
    $(".phonehideforwork").remove();
    $(".schedulehideforwork").remove();
    $(".testingdavekirkland .Tow-In").remove();
    $(".testingdavekirkland .DAN").remove();
    $(".dispatchjob").addClass("shownow");
    $(".dispatchjobnone").remove();

    $("#danonlyleads .Tow-In").remove();
    $("#danonlyleads .DAVE").remove();
    $("#danonlyleads .JEREMY").remove();
    $("#danonlyleads .MARK").remove();
    $("#danonlyleads .PAINT").remove();
    $("#danonlyleads .PAUL").remove();
    $("#danonlyleads .No").remove();

        $("#jeremyleadsonly .Tow-In").remove();
    $("#jeremyleadsonly .DAN").remove();
    $("#jeremyleadsonly .DAVE").remove();
    $("#jeremyleadsonly .MARK").remove();
    $("#jeremyleadsonly .PAINT").remove();
    $("#jeremyleadsonly .PAUL").remove();

        $("#daveonlyleads .Tow-In").remove();
    $("#daveonlyleads .DAN").remove();
    $("#daveonlyleads .JEREMY").remove();
    $("#daveonlyleads .MARK").remove();
    $("#daveonlyleads .PAINT").remove();
    $("#daveonlyleads .PAUL").remove();
    
        $("#leadonlymark .Tow-In").remove();
    $("#leadonlymark .DAN").remove();
    $("#leadonlymark .JEREMY").remove();
    $("#leadonlymark .DAVE").remove();
    $("#leadonlymark .PAINT").remove();
    $("#leadonlymark .PAUL").remove();

            $("#leadonlypaul .Tow-In").remove();
    $("#leadonlypaul .DAN").remove();
    $("#leadonlypaul .JEREMY").remove();
    $("#leadonlypaul .DAVE").remove();
    $("#leadonlypaul .PAINT").remove();
    $("#leadonlypaul .MARK").remove();

            $("#leadonlypaint .Tow-In").remove();
    $("#leadonlypaint .DAN").remove();
    $("#leadonlypaint .JEREMY").remove();
    $("#leadonlypaint .DAVE").remove();
    $("#leadonlypaint .PAUL").remove();
    $("#leadonlypaint .Schedules").remove();
    $("#leadonlypaint .MARK").remove();

$( "#leadsonlydetail tr:first" ).not( ".Details" ).remove();
  $("#leadsonlydetail .Schedules").remove();
  $("#leadsonlydetail .Scheduleds").remove();

$( "#leadsonlytowin tr:first" ).not( ".Details" ).remove();
  $("#leadsonlytowin .Schedules").remove();
  $("#leadsonlytowin .Scheduleds").remove();

    $(".daveonlyleads .Tow-In").remove();
    $(".daveonlyleads .JEREMY").remove();
    $(".daveonlyleads .MARK").remove();
    $(".daveonlyleads .DAN").remove();
    
$(".leadonlypaint .Scheduleds").remove();


$(".Closed").remove();
    $(".notes br").remove();
     $(".vinvinnumber").remove();
   
// Jeremy Dan
$('#printbutton').click(function() {
    $( "#danonlyleads .odd" ).addClass( "selected" );
    $( "#danonlyleads .even" ).addClass( "selected" );
  w=window.open();
  var name = '<table><tbody>';
  $('#danonlyleads .selected ul').remove();
  $('#danonlyleads .selected ul').remove();
  $('#danonlyleads .selected ul').remove();
  $('#danonlyleads .selected #updates').remove();
  $('#danonlyleads .notifications').remove();
  $('#danonlyleads .billto').remove();
  $('#danonlyleads .technicianname').remove();
  $('#danonlyleads .No').remove();
  var testing = "";
  $( "#danonlyleads .selected" ).each(function() {
   testing += "<div style='width: 50%; float: left; height: 130px;'> Name: " + $(this).find('.leadname').html() + "<br />Hours: " + $(this).find('.leadhours').html() + "<br />RO #: " + $(this).find('.leadronumber').html() + "<br />Status: " + $(this).find('.leadstatus div button span').html() + "<br />Vehicle: " + $(this).find('.leadyear').html() + " " + $(this).find('.leadmake').html() + " " + $(this).find('.leadmodel').html() + "<br /></h3></div><div style='width: 50%; float: right; height: 130px;'>Notes: " + $(this).find('.notes').html() + "</div><hr />";
   });

 
  var other = '</tbody></table>';
w.document.write("<h2>Dan Stevens</h2><hr style='border-top: 3px solid black;' /><table style='width: 30%; float: left; display: inline-block;'>" + testing + "</table>");
w.print();
w.close();
window.location.reload();
});

// Jeremy Dave
$('#printbuttondave').click(function() {
    $( "#daveonlyleads .odd" ).addClass( "selected" );
    $( "#daveonlyleads .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#daveonlyleads .selected ul').remove();
  $('#daveonlyleads .selected ul').remove();
  $('#daveonlyleads .selected #updates').remove();
  $('#daveonlyleads .selected #update').remove();
  var testing = "";
  $( "#daveonlyleads .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#daveonlyleads .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");

w.print();

w.close();


});

// Jeremy Print
$('#printbuttonjeremy').click(function() {
      $( "#jeremyleadsonly .odd" ).addClass( "selected" );
    $( "#jeremyleadsonly .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#jeremyleadsonly .selected ul').remove();
  $('#jeremyleadsonly .selected ul').remove();
  $('#jeremyleadsonly .selected #updates').remove();
  $('#jeremyleadsonly .selected #update').remove();
  var testing = "";
  $( "#jeremyleadsonly .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#jeremyleadsonly .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

// Jeremy Mark
$('#printbuttonmark').click(function() {
      $( "#leadonlymark .odd" ).addClass( "selected" );
    $( "#leadonlymark .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#leadonlymark .selected ul').remove();
  $('#leadonlymark .selected ul').remove();
  $('#leadonlymark .selected #updates').remove();
  $('#leadonlymark .selected #update').remove();
  var testing = "";
  $( "#leadonlymark .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#leadonlymark .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

// Jeremy Paul
$('#printbuttonpaul').click(function() {
      $( "#leadonlypaul .odd" ).addClass( "selected" );
    $( "#leadonlypaul .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#leadonlypaul .selected ul').remove();
  $('#leadonlypaul .selected ul').remove();
  $('#leadonlypaul .selected #updates').remove();
  $('#leadonlypaul .selected #update').remove();
  var testing = "";
  $( "#leadonlypaul .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#leadonlypaul .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

// Paint Print
$('#printbuttonpaint').click(function() {
      $( "#leadonlypaint .odd" ).addClass( "selected" );
    $( "#leadonlypaint .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#leadonlypaint .selected ul').remove();
  $('#leadonlypaint .selected ul').remove();
  $('#leadonlypaint .selected #updates').remove();
  $('#leadonlypaint .selected #update').remove();
  var testing = "";
  $( "#leadonlypaint .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#leadonlypaint .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

// Detail Print
$('#printbuttondetail').click(function() {
      $( "#leadsonlydetail .odd" ).addClass( "selected" );
    $( "#leadsonlydetail .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#leadsonlydetail .selected ul').remove();
  $('#leadsonlydetail .selected ul').remove();
  $('#leadsonlydetail .selected #updates').remove();
  $('#leadsonlydetail .selected #update').remove();
  var testing = "";
  $( "#leadsonlydetail .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#leadsonlydetail .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

// Tow In Print
$('#printbuttontowin').click(function() {
      $( "#leadsonlytowin .odd" ).addClass( "selected" );
    $( "#leadsonlytowin .even" ).addClass( "selected" );

  w=window.open();
  var name = '<table><tbody>';
  $('#leadsonlytowin .selected ul').remove();
  $('#leadsonlytowin .selected ul').remove();
  $('#leadsonlytowin .selected #updates').remove();
  $('#leadsonlytowin .selected #update').remove();
  var testing = "";
  $( "#leadsonlytowin .selected" ).each(function() {
   testing += "<tr style='border: 1px solid black;'>" + $( this ).html() + "</tr>";
   });
  tests = $('#leadsonlytowin .selected').html();
  var other = '</tbody></table>';
w.document.write("<html><head></head><body><table style='width: 100%;'><thead><tr><th style='border: 1px solid black; width: 7%;'>Name</th><th style='border: 1px solid black; width: 7%;'>Hours</th><th style='border: 1px solid black; width: 7%;'>Year</th><th style='border: 1px solid black; width: 7%;'>Make</th><th style='border: 1px solid black; width: 7%;'>Model</th><th style='border: 1px solid black; width: 7%;'>RO#</th><th style='border: 1px solid black; width: 7%;'>Notifications</th><th style='border: 1px solid black; width: 7%;'>Action</th><th style='border: 1px solid black; width: 15%;'>Repair Notes</th><th style='border: 1px solid black; width: 7%;'>Technician</th><th style='border: 1px solid black; width: 7%;'>Bill To</th></tr></thead><tbody style='width: 100%;'>" + testing + "</tbody></table>");
w.print();
w.close();
});

}
else {
           $('.Schedule').show();    
                 $("#Dans").remove();
    $("#Dave").remove();
    $("#Jeremy").remove();
    $("#Mark").remove();
    $("#Paul").remove();
    $("#Paint").remove();
    $("#Detail").remove();
    $("#Tow").remove();
    $("#Dan").remove();
// remove print on schedule page
    $('#printbutton').remove();
    $('#printbuttondave').remove();
    $('#printbuttonjeremy').remove();
    $('#printbuttonmark').remove();
    $('#printbuttonpaul').remove();
    $('#printbuttonpaint').remove();
    $('#printbuttondetail').remove();
    $('#printbuttontowin').remove();

        $(".hidewhite").addClass("shownows");
        $(".dispatchjob").remove();
        $(".dispatchjobnone").addClass("shownow");
}

  $('.Closed').hide();
  $(".buttons-print").click(function(){
  alert("Test");

  });
  $("#All").click(function(){
    $('.Open').show();
    $('.Closed').show();
    $(this).next().toggle();      
  });
  
    $("#open").click(function(){
    $('.Open').show();
    $('.Closed').hide();
    $(this).next().toggle();      
  });
  
  $("#close").click(function(){
    $('.Open').hide();
    $('.Closed').show();
    $(this).next().toggle();      
  });

  $('.testingcommentingnotes:not(:last-child)').remove();
  $('.dannotes:not(:last-child)').remove();
  $('.dannotes:not(:last-child)').remove();
 
 
  
});
</script>
<style>
@media print {
   tr { display: none !important; }
}
.dispatchjobnone {
display: none;
}
.shownow {
display: table-row !important;
}
.shownows {
display: block !important;
}
.hidenow {
    display: none !important;
}
#DataTables_info {
    display: none !important;
}
.dt-buttons {
    display: none !;
}
.dt-buttons .btn-danger {
    display: none !important;
}
.buttons-html5 {
    display: none !important;
}
.buttons-html5 {
    display: none !important;
}
.testingdavekirkland .DAVE {
    display: none !important;
}


.testingdavekirkland .Paint {
    display: none !important;
}
.testingdavekirkland .Detail {
    display: none !important;
}
.testingdavekirkland .Working {
    display: none;
}
.dt-buttons {
	display: none !important;
}
.notes a {
	color: #000000;
}
.testing {
    display: block;
}
.dannotes p {
    margin-bottom: 0px !important;
}
</style>
 