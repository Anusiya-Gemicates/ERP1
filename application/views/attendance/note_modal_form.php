<div id="sss" class="modal-body clearfix general-form ">
<!-- <div id="sss" class="p20 clearfix"> -->
    <div id="page-content" class="p20 clearfix">

<?php 

$optionss = array(
            "id" =>$model_info->id,
                   );
        $clock_in_data = $this->Attendance_model->get_details($optionss)->row();
        //echo format_to_time($clock_in_data->in_time);
       // echo $clock_in_data->id;
        //echo $clock_in_data->user_id;
//$in_time = format_to_time($clock_in_data->in_time); 
            $target_date = new DateTime($clock_in_data->in_time);
            $in_time =  $target_date->format("H:i:s"); 
        if (isset($clock_in_data->id)&& ($in_time =='00:00:00')) {
        ?>
    <h5 style="color:red;">Add Atleast One Todo and One Task to Save the Clock in Time  </h5> 
    <?php } ?>
     <!-- <?php /*  $attendancetask_options = array(
            "todo_id" =>$model_info->id,
                   );
        $attendance_task_data = $this->Attendance_task_todo_model->get_details($attendancetask_options)->row();if($attendance_task_data) { */?> -->
    <?php echo form_open(get_uri("attendance/todo_save"), array("id" => "todo-inline-form", "class" => "", "role" => "form")); ?>
    <input type="hidden" name="id" id="todo_id" value="<?php echo $todo_id; ?>" />
    <!-- <div class="todo-input-box"> -->
        <div class="clearfix">

        <!-- <div class="input-group">
            <?php /*
            echo form_input(array(
                "id" => "todo-title",
                "name" => "title",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('add_a_todo'),
                "autocomplete" => "off",
                "autofocus" => true
            ));
            ?>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); */?></button>
            </span>
        </div> -->

        <div class="form-group">
            <label for="income_user_id" class=" col-md-3"><?php echo lang('my_task_list'); ?></label>
            <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "task_user_id",
                "name" => "task_user_id",
                "value" => "",
                "class" => "form-control validate-hidden ",
                "placeholder" => lang('select_your_task'),
               // "autocomplete" => "off",
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
               // "autofocus" => true
            ));
            ?>
            </div>
        </div>
        <div class="form-group">
            <label for="add_a_todo" class=" col-md-3"><?php echo lang('add_a_todo'); ?></label>
            <div class="col-md-9">
            <?php
            echo form_input(array(
                "id" => "todo-title",
                "name" => "title",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('add_a_todo'),
                "autocomplete" => "off",
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
            </div>
        </div>

        <div class="modal-footer">
   
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>

    </div>
    <?php echo form_close(); ?>
<!-- <?php /* } */ ?> -->
<!-- <div class="page-title clearfix">
            <h1> <?php /* echo lang('tasks'); */?></h1>
</div> -->
<!-- pending task list -->
<!-- <div class="checklist-items">

</div>
           
 <div class="Attendance_savetask-items">

</div> -->
<!-- end save pending task -->

    <div class="panel panel-default">
        <div class="page-title clearfix">
            <!--h1> <?php /*echo lang('todo') . " (" . lang('private') . ")"; */?></h1-->
            <h1> <?php echo lang('todo_list'); ?></h1>
        </div>
        <div class="table-responsive">
            <table id="attendance-todo-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<div class="panel">
    <div class="tab-title clearfix">
        <h4><?php echo lang('my_tasks'); ?></h4>
    </div>
    <div class="table-responsive">
        <table id="task-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>

<?php $this->load->view("attendance/add_todo/helper_js"); ?>


<?php
$url = "attendance/save_note";

if ($clock_out == "1") {
    $url = "attendance/log_time";
}

echo form_open(get_uri($url), array("id" => "attendance-note-form", "class" => "general-form", "role" => "form"));
?>
<!-- <div class="modal-body clearfix"> -->
    <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

    <div class="form-group">
        <label for="note" class=" col-md-12">Note (Enable location mode in your device to clock out)</label>
        <div class=" col-md-12">
            <?php
            echo form_textarea(array(
                "id" => "note",
                "name" => "note",
                "class" => "form-control",
                "placeholder" => lang('note'),
                "value" => $model_info->note,
                "readonly"=>true,
            ));
            ?>
        </div>
        <input name="clock_out" type="hidden" value="<?php echo $clock_out; ?>" />
    </div>
<!-- </div> -->
 

<div class="modal-footer">
     <div id="link-of-task-view" class="hide">
            <?php
           // echo modal_anchor(get_uri("attendance/todo_view"), "", array());
            echo modal_anchor(get_uri("attendance/todo_view/"), "<i class='fa fa-pencil'></i> " . lang('edit'), array("class" => "btn btn-default", "data-post-id" => $todo_id, "title" => lang('add_todo')));
            ?>
        </div>
    <button type="button" class="btn btn-default" data-dismiss="modal" id='closetodo'><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <!--button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button-->
    <?php if (!$clock_out == "1") { ?>
     <button  id="note_save" disabled  type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
     <?php } ?>
     <?php if ($clock_out == "1") { ?>
    <?php 

$optionss = array(
            "id" =>$model_info->id,
                   );
        $clock_in_data = $this->Attendance_model->get_details($optionss)->row();
        //echo format_to_time($clock_in_data->in_time);
       // echo $clock_in_data->id;
        //echo $clock_in_data->user_id;
//$in_time = format_to_time($clock_in_data->in_time);
$target_date = new DateTime($clock_in_data->in_time);
$in_time =  $target_date->format("H:i:s");  
if (isset($clock_in_data->id)&& ($in_time !=='00:00:00')) {
        ?>
    <button id="note_save"  style="display:none" type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
    <button  id="check_status" disabled type="button" class="btn btn-primary" title="Please enable location mode in your device to clock out" ><span class="fa check-circle"></span> <?php echo lang('save'); ?></button>
    <?php } ?>
    <?php } ?>
</div><input type="hidden" name="result" id="result" >
<input type="hidden" name="timezone_result" id="timezone_result" >
<input type="hidden" name="loginuser_timezone" id="loginuser_timezone" value="<?php echo $this->login_user->user_timezone; ?>" />
<input type="hidden" name="loginuser_id" id="loginuser_id" value="<?php echo $this->login_user->id; ?>" />

<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize variables to prevent undefined warnings
        var checklistItemsHtml = "<?php echo isset($checklist_items) ? $checklist_items : ''; ?>";
        var saveTaskItemsHtml = "<?php echo isset($Attendance_savetask_items) ? $Attendance_savetask_items : ''; ?>";

        // Show the items in checklist
        $(".checklist-items").html(checklistItemsHtml);
        $(".Attendance_savetask-items").html(saveTaskItemsHtml);

        // Initialize select2 for task_user_id
        $("#task_user_id").select2({
            multiple: false,
            data: <?php echo $tasks_list_dropdown; ?>
        });

        $(".checklist-items").click(function () {
            var $taskViewLink = $("#link-of-task-view").find("a");
            setTimeout(function () { 
                $taskViewLink.trigger("click"); 
            }, 1000);
        });
    });


  $("#task_user_id").select2({
                multiple: false,
                data: <?php echo $tasks_list_dropdown; ?>
            });
        
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance-note-form").appForm({
            onSuccess: function (result) {
                if (result.clock_widget) {
                   $("#timecard-clock-out").closest("#js-clock-in-out").html(result.clock_widget);
                } else {
                    if (result.isUpdate) {
                        $(".dataTable:visible").appTable({newData: result.data, dataId: result.id});
                    } else {
                        $(".dataTable:visible").appTable({reload: true});
                    }
                }
            }
        });

        $("#note").focus();
        <?php if ($clock_out == "1") { ?>  
         $("#check_status").click(function () {

    
    $.ajax({
                    url: "<?php echo get_uri("attendance/get_status_suggestion"); ?>",
                    data: {item_name: $("#todo_id").val()},
                    cache: false,
                    type: 'POST',
                    dataType: "json",
                    success: function (response) {

                        //auto fill the description, unit type and rate fields.
                        if (response && response.success) {

                            
                         /*   if (!$("#item_rate").val()) {
                                $("#item_rate").val(response.item_info.total);
                            } */
                            
                            //alert("arun");
                         $("#check_status").show(); 
                         alert("Mark all the tasks in the Todo list as Completed to close the attendance."); 
//$("#note_save").show();
//$("#note_save").prop("readonly", true);


                       }else{
                            $("#note_save").click();
                            $("#note_save").show();
                            $("#check_status").hide();
                       }
                    }
                });
});
         <?php } ?>
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#attendance-todo-table").appTable({
            source: '<?php echo_uri("attendance/todo_list_data/". $model_info->id . "/") ?>',
            order: [[1, 'desc']],
            columns: [
               {visible: false, searchable: false},
                {title: '', "class": "w25"},
                {title: '<?php echo lang("title"); ?>'},
                {targets: [5], visible: false},
               {title: '<?php echo lang("date"); ?>', "class": "w200"},
                {title: '<?php echo lang("task") ?>'},
                {title: '<?php echo lang("start_date") ?>'},
                {title: '<?php echo lang("deadline") ?>'},
                {title: '<?php echo lang("client") ?>'},
                {title: '<?php echo lang("project") ?>'},
                 {title: '<?php echo lang("status") ?>'},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
        /*  checkBoxes: [
                {text: '<?php echo lang("to_do") ?>', name: "status", value: "to_do", isChecked: true},
                {text: '<?php echo lang("done") ?>', name: "status", value: "done", isChecked: false}
            ], */
            printColumns: [2, 4],
            xlsColumns: [2, 4],
            rowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).addClass(aData[0]);
            }
        });
    });
</script>
<?php
//if we get any task parameter, we'll show the task details modal automatically
$preview_task_id = get_array_value($_GET, 'task');
if ($preview_task_id) {
    echo modal_anchor(get_uri("projects/task_view"), "", array("id" => "preview_task_link", "title" => lang('task_info') . " #$preview_task_id", "data-post-id" => $preview_task_id));
}

$statuses = array();
foreach ($task_statuses as $status) {
    $is_selected = false;
    if ($status->key_name != "done") {
        $is_selected = true;
    }

    $statuses[] = array("text" => ($status->key_name ? lang($status->key_name) : $status->title), "value" => $status->id, "isChecked" => $is_selected);
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#task-table").appTable({
            source: '<?php echo_uri("projects/my_tasks_list_data_at") ?>',
            order: [[1, "desc"]],
            filterDropdown: [
                {name: "specific_user_id", class: "w200", options: <?php echo $team_members_dropdown; ?>},
                {name: "milestone_id", class: "w200", options: [{id: "", text: "- <?php echo lang('milestone'); ?> -"}], dependency: ["project_id"], dataSource: '<?php echo_uri("projects/get_milestones_for_filter") ?>'},
                {name: "project_id", class: "w200", options: <?php echo $projects_dropdown; ?>, dependent: ["milestone_id"]}
            ],
            singleDatepicker: [{name: "deadline", defaultText: "<?php echo lang('deadline') ?>",
                options: [
                    {value: "expired", text: "<?php echo lang('expired') ?>"},
                    {value: moment().format("YYYY-MM-DD"), text: "<?php echo lang('today') ?>"},
                    {value: moment().add(1, 'days').format("YYYY-MM-DD"), text: "<?php echo lang('tomorrow') ?>"},
                    {value: moment().add(7, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('in_number_of_days'), 7); ?>"},
                    {value: moment().add(15, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('in_number_of_days'), 15); ?>"}
                ]}],
            multiSelect: [
                {
                    name: "status_id",
                    text: "<?php echo lang('status'); ?>",
                    options: <?php echo json_encode($statuses); ?>
                }
            ],
            columns: [
                {visible: false, searchable: false},
                {title: '<?php echo lang("id") ?>'},
                {title: '<?php echo lang("title") ?>'},
                {visible: false, searchable: false},
                {title: '<?php echo lang("start_date") ?>', "iDataSort": 3},
                {visible: false, searchable: false},
                {title: '<?php echo lang("deadline") ?>', "iDataSort": 5},
                {title: "<?php echo lang("client") ?>", "class": ""},
                {title: '<?php echo lang("project") ?>'},
                {title: '<?php echo lang("assigned_to") ?>', "class": "min-w150"},
                {title: '<?php echo lang("collaborators") ?>'},
                {title: '<?php echo lang("status") ?>'}
                <?php echo $custom_field_headers; ?>,
                {visible: false, searchable: false}
            ],
            printColumns: combineCustomFieldsColumns([1, 2, 4, 6, 7, 8, 9, 10], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([1, 2, 4, 6, 7, 8, 9, 10], '<?php echo $custom_field_headers; ?>'),
            rowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).attr("style", "border-left:5px solid " + aData[0] + " !important;");
            }
        });

        // Open task details modal automatically
        if ($("#preview_task_link").length) {
            $("#preview_task_link").trigger("click");
        }

        // Call the geolocation and timezone functions on page load
        handleGeolocation();
        handleTimeZone();
    });

    function dd() {
        setTimeout(function () { 
            $("#closetodo").click();
            $("#timecard-clock-out").click();  
        }, 1000);
    }

    function handleGeolocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                $("#result").val(lat + "," + lon);
                
                // Fetch address from coordinates
                getAddressFromCoordinates(lat, lon).then(address => {
                    $('#note').append("\nClock out Location : " + address + "\nClock out - Lat, Long : " + $("#result").val());
                    $("#check_status").removeAttr("disabled").prop('title', "");
                });
            });
        } else {
            console.log("Browser doesn't support geolocation!");
        }
    }

    async function getAddressFromCoordinates(lat, lon) {
        const url = https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1&accept-language=en;
        try {
            const response = await fetch(url);
            const data = await response.json();
            return data.display_name;
        } catch (error) {
            console.error('Error fetching the address:', error);
            return "Address not found";
        }
    }

    function handleTimeZone() {
        const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $("#timezone_result").val(timeZone);
        const loginuser_timezone = $("#loginuser_timezone").val();
        
        if (timeZone !== loginuser_timezone) {
            if (confirm("Your current timezone differs from your previously saved timezone. Do you want to change your current timezone as default one?")) {
                const loginuser_id = $("#loginuser_id").val();
                $.ajax({
                    url: "<?php echo get_uri('attendance/update_user_timezone') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: { login_user_id: loginuser_id, login_user_timezone: timeZone },
                    success: function (result) {
                        if (result.success) {
                            appAlert.warning(result.message, { duration: 10000 });
                        } else {
                            appAlert.error(result.message);
                        }
                    }
                });
            }
        }
    }
</script>