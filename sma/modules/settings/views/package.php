<script>
    $(document).ready(function() {
        $('#fileData').dataTable( {
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": <?php echo ROWS_PER_PAGE; ?>,
            "oTableTools": {
                "sSwfPath": "smlib/media/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    // "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": ""
                    },
                    "print"
                ]
            },
            "oLanguage": {
                "sSearch": "Filter: "
            },
            "aoColumns": [
                { "bSortable": false },
                null,
                null,
                null,
                null,
                { "bSortable": false }
            ]

        } );

    } );

</script>

<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>

<h3 class="title"><?php echo $page_title; ?></h3>
<p class="introtext"><?php echo $this->lang->line('list_results'); ?></p>

<table id="fileData" class="table table-bordered table-hover table-striped" style="margin-bottom: 5px;">
    <thead>
    <tr>
        <th style="width:35px; text-align:center;"><?php echo $this->lang->line('no'); ?></th>
        <th><?php echo $this->lang->line('package_code'); ?></th>
        <th><?php echo $this->lang->line('package_name'); ?></th>
        <th style="width:45px;"><?php echo $this->lang->line('actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $r = 1;
    foreach ($packages as $row):?>
        <tr>
            <td style="text-align:center;"><?php echo $r; ?></td>
            <td><?php echo $row->package_code; ?></td>
            <td><?php echo $row->package_name; ?></td>
            <td><?php echo '<center>
                				<a href="index.php?module=settings&view=edit_package&name=' . $row->package_name . '" title="'.$this->lang->line('update_package').'" class="tip"><i class="icon-edit"></i></a>
								<a href="index.php?module=settings&view=delete_package&name=' . $row->package_name . '" onClick="return confirm(\''. $this->lang->line('alert_x_warehouse') .'\')"  title="'.$this->lang->line('delete_package').'" class="tip"><i class="icon-trash"></i></a>
								
                </center>'; ?></td>
        </tr>

        <?php $r++; endforeach;?>
    </tbody>
</table>

<p><a href="<?php echo site_url('module=settings&view=add_package');?>" class="btn btn-primary"><?php echo $this->lang->line('add_package'); ?></a></p>
