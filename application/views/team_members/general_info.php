<div class="tab-content">
    <?php echo form_open(get_uri("team_members/save_general_info/" . $user_info->id), array("id" => "general-info-form", "class" => "general-form dashed-row white", "role" => "form")); ?>
    <div class="panel">
        <div class="panel-default panel-heading">
            <h4> <?php echo lang('general_info'); ?></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="first_name" class=" col-md-2"><?php echo lang('first_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "first_name",
                        "name" => "first_name",
                        "value" => $user_info->first_name,
                        "class" => "form-control",
                        "placeholder" => lang('first_name'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required")
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class=" col-md-2"><?php echo lang('last_name'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "last_name",
                        "name" => "last_name",
                        "value" => $user_info->last_name,
                        "class" => "form-control",
                        "placeholder" => lang('last_name'),
                        "data-rule-required" => true,
                        "data-msg-required" => lang("field_required")
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class=" col-md-2"><?php echo lang('mailing_address'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_textarea(array(
                        "id" => "address",
                        "name" => "address",
                        "value" => $user_info->address,
                        "class" => "form-control",
                        "placeholder" => lang('mailing_address')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alternative_address" class=" col-md-2"><?php echo lang('alternative_address'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_textarea(array(
                        "id" => "alternative_address",
                        "name" => "alternative_address",
                        "value" => $user_info->alternative_address,
                        "class" => "form-control",
                        "placeholder" => lang('alternative_address')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="personal_email" class=" col-md-2"><?php echo lang('personal_email'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "personal_email",
                        "name" => "personal_email",
                        "value" => $user_info->personal_email,
                        "class" => "form-control",
                        "placeholder" => lang('personal_email'),
                        "autocomplete" => "off",
                        "data-rule-email" => true,
                        "data-msg-email" => lang("enter_valid_email"),
                        /*"data-rule-required" => true,
                        "data-msg-required" => lang("field_required"),*/
                    ));
                    ?>
                </div>
            </div>
             <div class="form-group">
                <label for="employee_id" class=" col-md-2"><?php echo lang('employee_id'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "employee_id",
                        "name" => "employee_id",
                        "value" => $user_info->employee_id,
                        "class" => "form-control",
                        "placeholder" => lang('employee_id'),
                        "readonly" => "true"
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="virtual_id" class=" col-md-2"><?php echo lang('virtual_id'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "virtual_id",
                        "name" => "virtual_id",
                        "value" => $user_info->virtual_id,
                        "class" => "form-control",
                        "placeholder" => lang('virtual_id'),
                        "readonly" => "true"
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class=" col-md-2"><?php echo lang('phone'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_inputnumber(array(
                        "id" => "phone",
                        "name" => "phone",
                        "value" => $user_info->phone,
                        "class" => "form-control",
                        "maxlength"=>15,
                        "min"=> 0,
                        "placeholder" => lang('phone')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alternative_phone" class=" col-md-2"><?php echo lang('alternative_phone'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_inputnumber(array(
                        "id" => "alternative_phone",
                        "name" => "alternative_phone",
                        "value" => $user_info->alternative_phone,
                        "class" => "form-control",
                        "maxlength"=>15,
                        "min"=>0,
                        "placeholder" => lang('alternative_phone')
                    ));
                    ?>
                </div>
            </div>
                                <div class="form-group">
                        <label class=" col-md-2"><?php echo lang('signature'); ?></label>
                        <div class=" col-md-10">
                            <div class="pull-left mr15">
                                <img name="signature" id="signature" style="max-width: 100px; max-height: 80px;" src="<?php echo get_file_uri(get_setting("profile_image_path") . "signature/".$user_info->signature); ?>" alt="" />
                            </div>
                            <div class="pull-left mr15">
                                <?php $this->load->view("includes/dropzone_preview"); ?>    
                            </div>
                            <div class="pull-left upload-file-button btn btn-default btn-xs">
                                <span>...</span>
                            </div>
                        </div>
                    </div>   
            <div class="form-group">
                <label for="skype" class=" col-md-2">Skype</label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "skype",
                        "name" => "skype",
                        "value" => $user_info->skype ? $user_info->skype : "",
                        "class" => "form-control",
                        "placeholder" => "Skype"
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="dob" class=" col-md-2"><?php echo lang('date_of_birth'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "dob",
                        "name" => "dob",
                        "value" => $user_info->dob,
                        "class" => "form-control",
                        "placeholder" => lang('date_of_birth')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="ssn" class=" col-md-2"><?php echo lang('ssn'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "ssn",
                        "name" => "ssn",
                        "value" => $user_info->ssn,
                        "class" => "form-control",
                        "placeholder" => lang('ssn')
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="blood_group" class=" col-md-2"><?php echo lang('blood_group'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_input(array(
                        "id" => "blood_group",
                        "name" => "blood_group",
                        "value" => $user_info->blood_group,
                        "class" => "form-control",
                        "placeholder" => lang('blood_group')
                    ));
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class=" col-md-2"><?php echo lang('gender'); ?></label>
                <div class=" col-md-10">
                    <?php
                    echo form_radio(array(
                        "id" => "gender_male",
                        "name" => "gender",
                        "data-msg-required" => lang("field_required"),
                            ), "male", ($user_info->gender === "female") ? false : true);
                    ?>
                    <label for="gender_male" class="mr15"><?php echo lang('male'); ?></label> <?php
                    echo form_radio(array(
                        "id" => "gender_female",
                        "name" => "gender",
                        "data-msg-required" => lang("field_required"),
                            ), "female", ($user_info->gender === "female") ? true : false);
                    ?>
                    <label for="gender_female" class=""><?php echo lang('female'); ?></label>
                </div>
            </div>


            <?php $this->load->view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => "col-md-2", "field_column" => " col-md-10")); ?> 

        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#general-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                setTimeout(function () {
                    window.location.href = "<?php echo get_uri("team_members/view/" . $user_info->id); ?>" + "/general";
                }, 500);
            }
        });
        $("#general-info-form .select2").select2();

        setDatePicker("#dob");
        var uploadUrl = "<?php echo get_uri("team_members/upload_file"); ?>";
        var validationUrl = "<?php echo get_uri("team_members/validate_file"); ?>";

        var dropzone = attachDropzoneWithForm("#general-info-form", uploadUrl, validationUrl, {maxFiles: 1});
    });
</script>    