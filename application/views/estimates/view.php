<?php 
$estimate_item_options = array("estimate_id" => $estimate_info->id);
$estimate_item_list_data = $this->Estimate_items_model->get_details($estimate_item_options)->result();
?>
<div id="page-content" class="clearfix">
    <div style="max-width: 1000px; margin: auto;">
        <div class="page-title clearfix mt15">
            <h1><?php echo /*get_estimate_id($estimate_info->id)*/$estimate_info->estimate_no ?$estimate_info->estimate_no:get_estimate_id($estimate_info->id); ?></h1>
            <div class="title-button-group">
                <span class="dropdown inline-block">
                    <button class="btn btn-info dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
                        <i class='fa fa-cogs'></i> <?php echo lang('actions'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                    
                        <li role="presentation">
<?php 
$DB10 = $this->load->database('default', TRUE);
$DB10->select ("hsn_code,hsn_description,gst");
 $DB10->from('estimate_items');
 $DB10->where('estimate_items.estimate_id',$estimate_info->id);
  $DB10->where('estimate_items.gst!=','0');
 $DB10->where('estimate_items.deleted','0');
 
$queryhsn=$DB10->get();
$hsngst=$queryhsn->result();
$hsn_size= sizeof($hsngst);


if($hsn_size>0||$estimate_total_summary->freight_tax_amount||$estimate_total_summary->installation_tax) {?>

                        <?php echo anchor(get_uri("estimates/download_pdf/" . $estimate_info->id), "<i class='fa fa-download'></i> " . lang('download_pdf'), array("title" => lang('download_pdf'))); ?>
<?php } else { ?>
<?php echo anchor(get_uri("estimates/download_estimate_without_gst_pdf/" . $estimate_info->id), "<i class='fa fa-download'></i> " . lang('download_pdf'), array("title" => lang('download_pdf'))); ?> <?php } ?> </li>
                        <li role="presentation">


                        <?php echo anchor(get_uri("estimates/preview/" . $estimate_info->id . "/1"), "<i class='fa fa-search'></i> " . lang('estimate_preview'), array("title" => lang('estimate_preview')), array("target" => "_blank")); ?> </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><?php echo modal_anchor(get_uri("estimates/modal_form"), "<i class='fa fa-edit'></i> " . lang('edit_estimate'), array("title" => lang('edit_estimate'), "data-post-id" => $estimate_info->id, "role" => "menuitem", "tabindex" => "-1")); ?> </li>

                        <?php
                        if ($estimate_item_list_data && $estimate_status == "draft") {
                            ?>
                            <li role="presentation"><?php echo ajax_anchor(get_uri("estimates/update_estimate_status/" . $estimate_info->id . "/sent"), "<i class='fa fa-send'></i> " . lang('mark_as_sent'), array("data-reload-on-success" => "1")); ?> </li>
                        <?php } else if ($estimate_status == "sent") { ?>
                            <li role="presentation"><?php echo ajax_anchor(get_uri("estimates/update_estimate_status/" . $estimate_info->id . "/accepted"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_accepted'), array("data-reload-on-success" => "1")); ?> </li>
                            <li role="presentation"><?php echo ajax_anchor(get_uri("estimates/update_estimate_status/" . $estimate_info->id . "/declined"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_declined'), array("data-reload-on-success" => "1")); ?> </li>
                        <?php } else if ($estimate_status == "accepted") { ?>
                            <li role="presentation"><?php echo ajax_anchor(get_uri("estimates/update_estimate_status/" . $estimate_info->id . "/declined"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_declined'), array("data-reload-on-success" => "1")); ?> </li>
                        <?php } else if ($estimate_status == "declined") { ?>
                            <li role="presentation"><?php echo ajax_anchor(get_uri("estimates/update_estimate_status/" . $estimate_info->id . "/accepted"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_accepted'), array("data-reload-on-success" => "1")); ?> </li>
                        <?php } ?>

                        <?php if ($estimate_status == "accepted") { ?>
                            <li role="presentation" class="divider"></li>
                            <?php if ($can_create_projects && !$estimate_info->project_id) { ?>
                                <li role="presentation"><?php echo modal_anchor(get_uri("projects/modal_form"), "<i class='fa fa-plus'></i> " . lang('create_project'), array("data-post-estimate_id" => $estimate_info->id, "title" => lang('create_project'), "data-post-client_id" => $estimate_info->client_id)); ?> </li>
                            <?php } ?>
                            <?php if ($show_invoice_option) { ?>
                                <li role="presentation"><?php echo modal_anchor(get_uri("invoices/modal_form/"), "<i class='fa fa-refresh'></i> " . lang('create_invoice'), array("title" => lang("create_invoice"), "data-post-estimate_id" => $estimate_info->id)); ?> </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </span>
                <?php echo modal_anchor(get_uri("estimates/item_modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_item'), array("class" => "btn btn-default", "title" => lang('add_item'), "data-post-estimate_id" => $estimate_info->id)); ?>
                 <?php if ($estimate_status == "accepted") { ?>
                <?php echo modal_anchor(get_uri("estimate_payments/payment_modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_payment'), array("class" => "btn btn-default", "title" => lang('add_payment'), "data-post-estimate_id" => $estimate_info->id)); ?>
                <?php } ?>
            </div>
        </div>
        <div id="estimate-status-bar">
            <?php $this->load->view("estimates/estimate_status_bar"); ?>
        </div>
        <div class="mt15">
            <div class="panel panel-default p15 b-t">
                <div class="clearfix p20">
                    <!-- small font size is required to generate the pdf, overwrite that for screen -->
                    <style type="text/css"> .invoice-meta {font-size: 100% !important;}</style>

                    <?php
                    $color = get_setting("invoice_color");
                    if (!$color) {
                        $color = "#2AA384";
                    }
                    $style = get_setting("invoice_style");
                    ?>
                    <?php
                    $data = array(
                        "client_info" => $client_info,
                        "color" => $color,
                        "estimate_info" => $estimate_info
                    );
                    if ($style === "style_2") {
                        $this->load->view('estimates/estimate_parts/header_style_2.php', $data);
                    } else {
                        $this->load->view('estimates/estimate_parts/header_style_1.php', $data);
                    }
                    ?>

                </div>

                <div class="table-responsive mt15 pl15 pr15">
                    <table id="estimate-item-table" class="display" width="100%">            
                    </table>
                </div>

                <div class="clearfix">
                    <div class="col-sm-8">

                    </div>
                    <div class="pull-right pr15" id="estimate-total-section" style="width: 420px;">
                        <?php $this->load->view("estimates/estimate_total_section"); ?>
                    </div>
                </div>

                <!--p class="b-t b-info pt10 m15"><?php echo nl2br($estimate_info->note); ?></p-->

            </div>
        </div>

        <!-- payslip payments table -->
        <div class="panel panel-default">
                <div class="tab-title clearfix">
                    <h4> <?php echo lang('estimate_payment_list'); ?></h4>
                </div>
                <div class="table-responsive">
                    <table id="estimate-payment-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
            <!-- payslip payments table end -->

    </div>
</div>



<script type="text/javascript">
    RELOAD_VIEW_AFTER_UPDATE = true;
    $(document).ready(function () {
        $("#estimate-item-table").appTable({
            source: '<?php echo_uri("estimates/item_list_data/" . $estimate_info->id . "/") ?>',
            order: [[0, "asc"]],
            hideTools: true,
            columns: [

                {title: '<?php echo lang("model") ?> ', "bSortable": false},
                {title: '<?php echo lang("category") ?>', "class": "text-right w15p", "bSortable": false},
                {title: '<?php echo lang("make") ?>', "class": "text-right w15p", "bSortable": false},
                {title: '<?php echo lang("hsn_code") ?>', "class": "text-right w10p", "bSortable": false},
                {title: '<?php echo lang("quantity") ?>', "class": "text-right w10p", "bSortable": false},
                {title: '<?php echo lang("rate") ?>', "class": "text-right w10p", "bSortable": false},
                 
                {title: '<?php echo lang("total") ?>', "class": "text-right w15p", "bSortable": false},
                {title: '<?php echo lang("gst") ?>', "class": "text-right w10p", "bSortable": false},
               {title: '<?php echo lang("tax_amount") ?>', "class": "text-right w15p", "bSortable": false},
               {title: '<?php echo lang("discount_percent") ?>', "class": "text-center w10p", "bSortable": false},
               {title: '<?php echo lang("discount_amount") ?>', "class": "text-right w15p", "bSortable": false},
               {title: '<?php echo lang("installation_rate") ?>', "class": "text-right w15p", "bSortable": false},
            {title: '<?php echo lang("installation_total") ?>', "class": "text-right w15p", "bSortable": false},
               {title: '<?php echo lang("net_total") ?>', "class": "text-right w15p", "bSortable": false},
                {title: "<i class='fa fa-bars'></i>", "class": "text-center option w100"}

            ],
            onDeleteSuccess: function (result) {
                $("#estimate-total-section").html(result.estimate_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.estimate_id);
                }
            },
            onUndoSuccess: function (result) {
                $("#estimate-total-section").html(result.estimate_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.estimate_id);
                }
            }
        });
    });

    updateInvoiceStatusBar = function (estimateId) {
        $.ajax({
            url: "<?php echo get_uri("estimates/get_estimate_status_bar"); ?>/" + estimateId,
            success: function (result) {
                if (result) {
                    $("#estimate-status-bar").html(result);
                }
            }
        });
    };

</script>
<script type="text/javascript">
    RELOAD_VIEW_AFTER_UPDATE = true;
    $(document).ready(function () {
        //payslip payment table
         $("#estimate-payment-table").appTable({
            source: '<?php echo_uri("estimate_payments/payment_list_data/" . $estimate_info->id . "/") ?>',
            order: [[0, "asc"]],
            columns: [
                {targets: [0], visible: false, searchable: false},
                {title: "<?php echo lang("client") ?>", "class": "w15p"},
                {title: "<?php echo lang("project") ?>", "class": "w15p"},
                {visible: false, searchable: false},
                {title: '<?php echo lang("payment_date") ?> ', "class": "w15p", "iDataSort": 1},
                {title: '<?php echo lang("payment_method") ?>', "class": "w15p"},
                //{title: '<?php echo lang("note") ?>'},
                 {title: '<?php echo lang("reference_number") ?>', "class": "w15p"},
                {title: '<?php echo lang("amount") ?>', "class": "text-right w15p"},
                 {title: '<?php echo lang("files") ?>', "class": "w10p"},
                {title: '<?php echo lang("description") ?>', "class": "text-center w25p"},
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            onDeleteSuccess: function (result) {

                updateInvoiceStatusBar();
                $("#estimate-total-section").html(result.estimate_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.estimate_id);
                }
                 location.reload(true)
            },
            onUndoSuccess: function (result) {
                updateInvoiceStatusBar();
                $("#estimate-total-section").html(result.estimate_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.estimate_id);
                }
                 location.reload(true)
            }
        });
    });

    updateInvoiceStatusBar = function (estimateId) {
        $.ajax({
            url: "<?php echo get_uri("estimates/get_estimate_status_bar"); ?>/" + estimateId,
            success: function (result) {
                if (result) {
                    $("#estimate-status-bar").html(result);
                }
            }
        });
    };

</script>

<?php
//required to send email 

load_css(array(
    "assets/js/summernote/summernote.css",
));
load_js(array(
    "assets/js/summernote/summernote.min.js",
));
?>
