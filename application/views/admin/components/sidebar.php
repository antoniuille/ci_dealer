<aside class="aside">
    <!-- START Sidebar (left)-->
    <?php
    $user_id = $this->session->userdata('user_id');
    $profile_info = $this->db->where('user_id', $user_id)->get('tbl_account_details')->row();
    $user_info = $this->db->where('user_id', $user_id)->get('tbl_users')->row();
    ?>
    <div class="aside-inner">
        <nav data-sidebar-anyclick-close="" class="sidebar">
            <!-- START sidebar nav-->
            <ul class="nav">
                <!-- START user info-->
                <li class="has-user-block">
                    <div id="user-block" class="block">
                        <div class="item user-block">
                            <!-- User picture-->
                            
                            <!-- Name and Job-->
                            <div class="user-block-info">
                                <span class="user-block-name"><?= $profile_info->fullname ?></span>
                                <span class="user-block-role"></i> <?= lang('online') ?></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="/dealer/login/logout"><span>Logout</span></a></li>
            <li><a href="/dealer/admin/leads#create" data-toggle="tab"><em class="fa fa-calendar"></em><span>Add & Schedule</span></a></li>
             <li><a href="/dealer/admin/leads/index/"><em class="fa fa-calendar"></em><span>Scheduled</span></a></li>
              <li><a href="/dealer/admin/leads#workinprogress" id="workinprogress" ><em class="fa fa-calendar"></em><span>Work In Progress</span></a></li>
            </ul>
            <!-- END user info-->

            <?php
            echo $this->menu->dynamicMenu();
            ?>
            <!-- Iterates over all sidebar items-->
            <ul class="nav">
            
                <?php
                $this->db->select("tbl_project.*", FALSE);
                $this->db->select("tbl_users.*", FALSE);
                $this->db->select("tbl_account_details.*", FALSE);
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_project.timer_started_by');
                $this->db->join('tbl_account_details', 'tbl_account_details.user_id = tbl_project.timer_started_by');
                $this->db->where(array('timer_status' => 'on'));
                $project_timers = $this->db->get('tbl_project')->result_array();

                $this->db->select("tbl_task.*", FALSE);
                $this->db->select("tbl_users.*", FALSE);
                $this->db->select("tbl_account_details.*", FALSE);
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_task.timer_started_by');
                $this->db->join('tbl_account_details', 'tbl_account_details.user_id = tbl_task.timer_started_by');
                $this->db->where(array('timer_status' => 'on'));
                $task_timers = $this->db->get('tbl_task')->result_array();

                $user_id = $this->session->userdata('user_id');
                $role = $this->admin_model->check_by(array('user_id' => $user_id), 'tbl_users');
                ?>

                <?php
                if (!empty($project_timers)):
                    ?>
                    <li class="nav-heading"><?= lang('project') . ' ' . lang('start') ?> </li>
                <?php foreach ($project_timers as $p_timer) : if ($role->role_id == 1 || ($role->role_id == 2 && $user_id == $p_timer['user_id'])) : ?>
                    <li class="timer active" start="<?php echo $p_timer['timer_status']; ?>">
                        <a title="<?php echo $p_timer['project_name'] . " (" . $p_timer['username'] . ")"; ?>"
                           data-placement="top" data-toggle="tooltip"
                           href="<?= base_url() ?>admin/projects/project_details/<?= $p_timer['project_id'] ?>">
                            <img src="<?= base_url() . $p_timer['avatar'] ?>" width="30" height="30"
                                 class="img-thumbnail img-circle">
                            <span id="project_hour_timer_<?= $p_timer['project_id'] ?>"> 0 </span>
                            <!-- SEPARATOR -->
                            :
                            <!-- MINUTE TIMER -->
                            <span id="project_minute_timer_<?= $p_timer['project_id'] ?>"> 0 </span>
                            <!-- SEPARATOR -->
                            :
                            <!-- SECOND TIMER -->
                            <span id="project_second_timer_<?= $p_timer['project_id'] ?>"> 0 </span>
                            <b class="label label-danger pull-right"> <i class="fa fa-clock-o fa-spin"></i></b>
                        </a>
                    </li>
                <?php
                //RUNS THE TIMER IF ONLY TIMER_STATUS = 1
                if ($p_timer['timer_status'] == 'on') :

                $project_current_moment_timestamp = strtotime(date("H:i:s"));
                $project_timer_starting_moment_timestamp = $this->db->get_where('tbl_project', array('project_id' => $p_timer['project_id']))->row()->start_time;
                $project_total_duration = $project_current_moment_timestamp - $project_timer_starting_moment_timestamp;

                $project_total_hour = intval($project_total_duration / 3600);
                $project_total_duration -= $project_total_hour * 3600;
                $project_total_minute = intval($project_total_duration / 60);
                $project_total_second = intval($project_total_duration % 60);
                ?>

                    <script type="text/javascript">
                        // SET THE INITIAL VALUES TO TIMER PLACES
                        var timer_starting_hour = <?php echo $project_total_hour; ?>;
                        document.getElementById("project_hour_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer_starting_hour;
                        var timer_starting_minute = <?php echo $project_total_minute; ?>;
                        document.getElementById("project_minute_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer_starting_minute;
                        var timer_starting_second = <?php echo $project_total_second; ?>;
                        document.getElementById("project_second_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer_starting_second;

                        // INITIALIZE THE TIMER WITH SECOND DELAY
                        var timer = timer_starting_second;
                        var mytimer = setInterval(function () {
                            task_run_timer()
                        }, 1000);

                        function task_run_timer() {
                            timer++;

                            if (timer > 59) {
                                timer = 0;
                                timer_starting_minute++;
                                document.getElementById("project_minute_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer_starting_minute;
                            }

                            if (timer_starting_minute > 59) {
                                timer_starting_minute = 0;
                                timer_starting_hour++;
                                document.getElementById("project_hour_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer_starting_hour;
                            }

                            document.getElementById("project_second_timer_<?= $p_timer['project_id'] ?>").innerHTML = timer;
                        }
                    </script>

                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>

                <?php
                if (!empty($task_timers)):
                    ?>
                    <li class="nav-heading"><?= lang('tasks') . ' ' . lang('start') ?> </li>
                <?php
                foreach ($task_timers as $v_task_timer):
                if ($role->role_id == 1 || ($role->role_id == 2 && $user_id == $v_task_timer['user_id'])) :
                ?>
                    <li class="timer active" start="<?php echo $v_task_timer['timer_status']; ?>">
                        <a title="<?php echo $v_task_timer['task_name'] . " (" . $v_task_timer['username'] . ")"; ?>"
                           data-placement="top" data-toggle="tooltip"
                           href="<?= base_url() ?>admin/tasks/view_task_details/<?= $v_task_timer['task_id'] ?>">
                            <img src="<?= base_url() . $v_task_timer['avatar'] ?>" width="30" height="30"
                                 class="img-thumbnail img-circle">
                            <span id="tasks_hour_timer_<?= $v_task_timer['task_id'] ?>"> 0 </span>
                            <!-- SEPARATOR -->
                            :
                            <!-- MINUTE TIMER -->
                            <span id="tasks_minute_timer_<?= $v_task_timer['task_id'] ?>"> 0 </span>
                            <!-- SEPARATOR -->
                            :
                            <!-- SECOND TIMER -->
                            <span id="tasks_second_timer_<?= $v_task_timer['task_id'] ?>"> 0 </span>
                            <b class="label label-danger pull-right"> <i class="fa fa-clock-o fa-spin"></i></b>
                        </a>
                    </li>
                <?php
                //RUNS THE TIMER IF ONLY TIMER_STATUS = 1
                if ($v_task_timer['timer_status'] == 'on') :

                $task_current_moment_timestamp = strtotime(date("H:i:s"));
                $task_timer_starting_moment_timestamp = $this->db->get_where('tbl_task', array('task_id' => $v_task_timer['task_id']))->row()->start_time;
                $task_total_duration = $task_current_moment_timestamp - $task_timer_starting_moment_timestamp;

                $task_total_hour = intval($task_total_duration / 3600);
                $task_total_duration -= $task_total_hour * 3600;
                $task_total_minute = intval($task_total_duration / 60);
                $task_total_second = intval($task_total_duration % 60);
                ?>

                    <script type="text/javascript">
                        // SET THE INITIAL VALUES TO TIMER PLACES
                        var timer_starting_hour = <?php echo $task_total_hour; ?>;
                        document.getElementById("tasks_hour_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer_starting_hour;
                        var timer_starting_minute = <?php echo $task_total_minute; ?>;
                        document.getElementById("tasks_minute_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer_starting_minute;
                        var timer_starting_second = <?php echo $task_total_second; ?>;
                        document.getElementById("tasks_second_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer_starting_second;

                        // INITIALIZE THE TIMER WITH SECOND DELAY
                        var timer = timer_starting_second;
                        var mytimer = setInterval(function () {
                            task_run_timer()
                        }, 1000);

                        function task_run_timer() {
                            timer++;

                            if (timer > 59) {
                                timer = 0;
                                timer_starting_minute++;
                                document.getElementById("tasks_minute_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer_starting_minute;
                            }

                            if (timer_starting_minute > 59) {
                                timer_starting_minute = 0;
                                timer_starting_hour++;
                                document.getElementById("tasks_hour_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer_starting_hour;
                            }

                            document.getElementById("tasks_second_timer_<?= $v_task_timer['task_id'] ?>").innerHTML = timer;
                        }
                    </script>

                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php
                $viewed = can_action('139', 'view');
                if (!empty($viewed)) {
                    $online_user = $this->db->where(array('online_status' => '1'))->get('tbl_users')->result();
                    $total_user = 0;
                    if (!empty($online_user)):
                        foreach ($online_user as $v_online_user):
                            if ($v_online_user->user_id != $this->session->userdata('user_id')) {
                                $total_user += count($v_online_user);
                            }
                        endforeach;
                        ?>
                        <?php if ($total_user >= 1) { ?>
                        <li class="nav-heading"
                        ><?= lang('online') ?></li>
                        <?php
                        foreach ($online_user as $v_online_user):
                            if ($v_online_user->user_id != $this->session->userdata('user_id')) {
                                if ($v_online_user->role_id == 1) {
                                    $user = 'Admin';
                                } elseif ($v_online_user->role_id == 3) {
                                    $user = 'Staff';
                                } else {
                                    $user = 'Client';
                                }
                                ?>
                                <li class="">
                                    <a title="<?php echo $user ?>" data-placement="top" data-toggle="tooltip"
                                       class="dker"
                                       href="<?php echo base_url(); ?>admin/message/get_chat/<?php echo $v_online_user->user_id ?>">
                                        <?php echo $v_online_user->username ?>
                                        <b class="label label-success pull-right"> <i
                                                class="fa fa-dot-circle-o fa-spin"></i></b>
                                    </a>
                                </li>
                                <?php
                            }
                        endforeach;
                        ?>
                    <?php } ?>
                    <?php endif ?>
                <?php } ?>
            </ul>
   <hr align='left' style='width: 80%; margin: left;margin-left: 10px;height: 1px;' /><p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px;'><a style="color: #ef4040;" href="/dealer/admin/leads/index/by_status/5">Tow-in</a></p>
       
        <script>
   
        $( document ).ready(function() {
          	var x = document.getElementsByClassName("Tow-In").length;
          	
          	if (x > 0) {
    			document.getElementById("towins").innerHTML = 'Tow-In: ' + x;
    		}
    		
    		var scheduling = document.getElementsByClassName("Schedule").length;
    		if (scheduling > 0) {
    			document.getElementById("scheduless").innerHTML = 'Schedule: ' + scheduling;
    		}
    		
    		var working = document.getElementsByClassName("Receive").length;
    		working += document.getElementsByClassName("Tow-In").length;
    		working += document.getElementsByClassName("Off-Site").length;
    		working += document.getElementsByClassName("Teardown*").length;
    		working += document.getElementsByClassName("Working").length;
    		working += document.getElementsByClassName("Paint*").length;
    		working += document.getElementsByClassName("Re-Assemble*").length;
    		working += document.getElementsByClassName("Detail*").length;
    		working += document.getElementsByClassName("Total").length;
    		if (working > 0) {
    			document.getElementById("workinprogresss").innerHTML = 'Work In Progress: ' + working;
    		}
    		
    		});
    	
        </script>
        
        
        
          <?php
 $dbhost = "localhost";
 $dbuser = "jonhall2278deale";
 $dbpass = "andrew93";
 $dbname = "Dealerformdaysoff";

// Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID, hours, jobs, date FROM tb_cform order by id desc limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<hr align='left' style='width: 80%; margin: left;margin-left: 10px;height: 1px;' /><p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px;'>" . $row["id"] . "Working Day: <span class='hours_max_day' id='hours_max_day'>" . $row["hours"] . "</span></p><p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px;'>" . "Jobs Per Day: <span class='max_jobs_day' id='max_jobs_day'>" . $row["jobs"] . "</span></p><p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px;'>Last Blackout Date:<Br />" . $row["date"] . "</span>";
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 



<hr align='left' style='width: 80%; margin: left;margin-left: 10px;height: 1px;' />
 <p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px; font-weight: bold;' id="towins"></p>
  <p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px; font-weight: bold;' id="workinprogresss"></p>
  <p style=' font-size: 16px; margin-top: 6px; margin-bottom: 10px;color: white;padding-left: 18px; font-weight: bold;' id="scheduless"></p>


  <table style="width: 100%; margin-top: 30px;" class="table2">
        <thead style="background-color:rgba(28, 28, 28, 1); color:#ffffff">
        <tr><th colspan="3" style="background-color:#FFFFFF; color:#000000"><center>Currently Scheduled</center></th></tr>
        <tr><th>Date</th><th>Hours</th><th>Repairs</th></tr>
        </thead>
        <tbody style="background-color: #fff !important;">
       
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

$sql = "SELECT schedule_date, schedule_hours, COUNT(*) AS total_countts, SUM(schedule_hours) AS schedule_hourss FROM tbl_leads WHERE tbl_leads.lead_status_id in ('4', '8', '9') GROUP BY schedule_date HAVING count(*) > 0;";
$result = $conn->query($sql);
$othernumber = 8;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       
$input = $row["schedule_date"];
$t = date("D", strtotime($input)) . ", ";
$y = date("M", strtotime($input)) . "-";
$x = date("d", strtotime($input)) . "\n";
        echo " <tr class='schedule_date'><td>" . $t . $y . $x . "</td>" . "<td class='hours_count'>" . $row["schedule_hourss"] .  '</td><td class="repairs_count">' . $row["total_countts"] . "</td></tr>";


        
    } 
} else {
    echo "0 results";
}



$conn->close();
?> 




                            </tbody></table>
  
            <!-- END sidebar nav-->
        </nav>
    </div>
    <!-- END Sidebar (left)-->
</aside>
<script>
$(document).ready(function(){

   var x = document.getElementById("hours_max_day").innerHTML;
   var y = document.getElementById("max_jobs_day").innerHTML;

 $('.hours_count').filter(function(index){
    return parseInt(this.innerHTML) > x;
}).css({'color':'red', 'text-decoration':'underline'});
    
     $('.repairs_count').filter(function(index){
    return parseInt(this.innerHTML) > y;
}).css({'color':'red', 'text-decoration':'underline'});

    });

</script>