<?php
// Check if $task_statuses is not set or null, then initialize it as an empty array
if (!isset($task_statuses) || is_null($task_statuses)) {
    $task_statuses = array(); // Initialize $task_statuses as an empty array
}

$status_dropdown = array();
foreach ($task_statuses as $status) {
    $status_dropdown[] = array(
        "value" => $status->id,
        "text" => $status->key_name ? lang($status->key_name) : $status->title
    );
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '[data-act=update-task-status]', function () {
            $(this).editable({
                type: "select2",
                pk: 1,
                name: 'status',
                ajaxOptions: {
                    type: 'post',
                    dataType: 'json'
                },
                value: $(this).attr('data-value'),
                url: '<?php echo_uri("vendors_invoice_list/save_task_status") ?>/' + $(this).attr('data-id'),
                showbuttons: false,
                source: <?php echo json_encode($status_dropdown) ?>,
                success: function (response, newValue) {
                    if (response.success) {
                        $("#vendors_invoice_list-table").appTable({newData: response.data, dataId: response.id});
                    }
                }
            });
            $(this).editable("show");
        });

        $('body').on('click', '[data-act=update-task-status-checkbox]', function () {
            $(this).find("span").addClass("inline-loader");
            $.ajax({
                url: '<?php echo_uri("vendors_invoice_list/save_task_status") ?>/' + $(this).attr('data-id'),
                type: 'POST',
                dataType: 'json',
                data: {value: $(this).attr('data-value')},
                success: function (response) {
                    if (response.success) {
                        $("#vendors_invoice_list-table").appTable({newData: response.data, dataId: response.id});
                    }
                }
            });
        });
    });
</script>