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
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://api.edmunds.com/v1/api/toolsrepository/vindecoder?vin=" . $_POST['vin'] . "&api_key=bxadwnm2sfgkyppg6regfc4k&fmt=json");
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
	$result = curl_exec($curl);
	
	curl_close($curl);
	
	$array_new = json_decode($result,true);
	if(isset($array_new['styleHolder'])){

		$vinvin = $_POST['vin'];
		
		$carmake = $array_new['styleHolder'][0]['makeName'];
		
		$carmodel = $array_new['styleHolder'][0]['modelName'];
	
		$caryear = $array_new['styleHolder'][0]['year'];
		
	}
    else{
		echo "<table>";
		echo "<tr><td><b>Error :</b> </td><td> " . $array_new['message']."<br></td></tr>";
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
                    <li class="<?= $active == 1 ? 'active' : ''; ?>"><a href="#manage"
                                                                        data-toggle="tab">All</a>
                    </li>
                    <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#create"
                                                                        data-toggle="tab">Add & Schedule</a>
                    </li>
                    
                </ul>
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled </th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
            
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status;
                                    }
                                    ?>      </td>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 1000000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "</span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                              
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                </td>
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "</span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                               
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                   
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "</span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                               
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                      
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "<br /></span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                               
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                   
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing == 0) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "<br /></span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                              
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                      
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "<br /></span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                               
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "<br /></span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                               
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
                        
                       
                        <th><?= lang('phone') ?></th>
                        
                        <th>Scheduled</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Vin Number</th>
                        <th>RO#</th>
                        <th>Notifications</th>
                        <th>Status</th>
                        
                        
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                         
                        <th>Repair Notes</th>
                        <th>Technician</th>
                 
                    </tr>
                    </thead>
                    <tbody>
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
                                
                               
                                <td><?= $v_leads->mobile ?></td>
                                
                                <td ><?= $v_leads->schedule_date ?></td>
                                <td><?= $v_leads->year ?></td>
                                <td><?= $v_leads->make ?></td>
                                <td><?= $v_leads->model ?></td>
                                <td><?= $v_leads->vin_number ?></td>
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
                                <td><?php
                                    if (!empty($v_leads->lead_status_id)) {
                                        $lead_status = $this->db->where('lead_status_id', $v_leads->lead_status_id)->get('tbl_lead_status')->row();

                                        if ($lead_status->lead_type == 'open') {
                                            $status = "<span class='label label-success'>" . lang($lead_status->lead_type) . "</span>";
                                        } else {
                                            $status = "<span class='label label-warning'>" . lang($lead_status->lead_type) . "</span>";
                                        }
                                        echo $status . ' ' . $lead_status->lead_status;
                                    }
                                    ?>      </td>
                                <td>

                                    <?= btn_view('admin/leads/leads_details/' . $v_leads->leads_id) ?>
                                    <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <?= btn_edit('admin/leads/index/' . $v_leads->leads_id) ?>
                                    <?php }
                                    if (!empty($can_delete) && !empty($deleted)) {
                                        ?>
                                        <?= btn_delete('admin/leads/delete_leads/' . $v_leads->leads_id) ?>
                                    <?php } ?>
  <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <?= lang('change_status') ?>
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
                                 
                                <td><a href="<?= base_url() ?>admin/leads/leads_details/<?= $v_leads->leads_id ?>#task_comments"> 
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

$sql = "SELECT task_comment_id, task_id, user_id, comment, comments_attachment, leads_id, opportunities_id, project_id, bug_id, goal_tracking_id FROM tbl_task_comment order by task_comment_id desc limit 100000";
$result = $conn->query($sql);
$testing = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if ($useridforcalling == $row["leads_id"]) {
    		if ($testing <= 3) {
    			$testing += 1;
        echo "<span class='testing'>" . $row["comment"] . "<br /></span><br />";
    }
    }
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 
                                  </a></td>
                                
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
 <a href="#" onclick="printDiv()">Print</a>
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

if(window.location.href.indexOf("4") > -1) {
       $('.Schedule').show();    
       
}

  
if(window.location.href.indexOf("4") > -1) {
       $('.Schedule').show();    
                 $("#Dans").addClass("hidenow");
    $("#Dave").addClass("hidenow");
    $("#Jeremy").addClass("hidenow");
    $("#Mark").addClass("hidenow");
    $("#Paul").addClass("hidenow");
    $("#Paint").addClass("hidenow");
    $("#Detail").addClass("hidenow");
    $("#Tow").addClass("hidenow");
        $(".hidewhite").addClass("shownows");

}

if(window.location.href.indexOf("workinprogress") > -1) {
       $('.Schedule').hide();    
           $("#Dans .DAN").addClass("shownow");
    $("#Dave .DAVE").addClass("shownow");
    $("#Jeremy .JEREMY").addClass("shownow");
    $("#Mark .MARK").addClass("shownow");
    $("#Paul .PAUL").addClass("shownow");
    $("#Paint .PAINT").addClass("shownow");
    $("#Detail .DETAIL").addClass("shownow");
    $("#Tow .TOW-IN").addClass("shownow");
    $(".hidewhite").addClass("hidenow");
 
}


  $('.Closed').hide();
  
  
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
  
  
  
});

    function printDiv() {    
    var printContents = document.getElementById('Dans').innerHTML;
    var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
    }
</script>
<style>
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
    display: none !important;
}
</style>
 