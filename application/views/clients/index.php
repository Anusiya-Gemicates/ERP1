<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
            <a class="btn btn-primary" href="javascript:window.history.go(-1);">❮ Go Back</a>
    <div class="page-title clearfix">
            <h1><?php echo lang('clients'); ?></h1>
            <div class="title-button-group">
                <?php echo modal_anchor(get_uri("clients/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_client'), array("class" => "btn btn-default", "title" => lang('add_client'))); ?>
            </div>
            <div class="title-button-group">
            <a href= "<?php echo base_url('assets/template/Clients_Template.xlsx'); ?>"  download> 
            <button type="button" class="btn btn-default"><i class='fa fa-download'></i> Download Template </button>
  <!-- <img src="<?php echo base_url('assets/images/gem.ico'); ?>" alt="W3Schools" width="50" height="50"> -->
</a>
</div>
<div class="title-button-group">
                <?php  echo modal_anchor(get_uri("clients/clients_excel_form"), "<i class='fa fa-upload' aria-hidden='true'></i> " . lang('import'), array("class" => "btn btn-default", "title" => lang('import')));  ?>
            </div>
        </div>
        <div class="table-responsive">
            <table id="client-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var showInvoiceInfo = true;
        if (!"<?php echo $show_invoice_info; ?>") {
            showInvoiceInfo = false;
        }

        $("#client-table").appTable({
            source: '<?php echo_uri("clients/list_data") ?>',
            filterDropdown: [
                {name: "group_id", class: "w200", options: <?php echo $groups_dropdown; ?>}
            ],
            columns: [
                {title: "<?php echo lang("id") ?>", "class": "text-center w50"},
                {title: "<?php echo lang("client_name") ?>"},
                {title: "<?php echo lang("primary_contact") ?>"},
                {title: "<?php echo lang("client_groups") ?>"},
                {title: "<?php echo lang("projects") ?>"},                
                {visible: showInvoiceInfo, searchable: showInvoiceInfo, title: "<?php echo lang("invoice_value") ?>"},
                {visible: showInvoiceInfo, searchable: showInvoiceInfo, title: "<?php echo lang("payment_received") ?>"},
                {visible: showInvoiceInfo, searchable: showInvoiceInfo, title: "<?php echo lang("due") ?>"}
                <?php echo $custom_field_headers; ?>,
                {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ],
            printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>')
        });
    });
</script>