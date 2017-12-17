<script src="<?php echo $this->config->base_url(); ?>assets/js/validation.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/validation.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').form();
    });
</script>
<?php if ($message) {
    echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>";
} ?>

<h3 class="title"><?php echo $page_title; ?></h3>
<p><?php echo $this->lang->line("enter_info"); ?></p>
<?php $attrib = array('class' => 'form-horizontal');
echo form_open("module=settings&view=add_package", $attrib); ?>
<div class="control-group">
    <label class="control-label" for="category"><?php echo $this->lang->line("items"); ?></label>

    <div class="controls">
        <select name="item[]" id="items" class="item_list" multiple="multiple" required="required"">
        <option selected="selected"></option>
        <?php
        foreach ($items as $item) {
            ?>
            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
        <?php
        } ?>
        </select>

    </div>
</div>



<div class="control-group">
    <label class="control-label" for="code"><?php echo $this->lang->line("package_code"); ?></label>

    <div
        class="controls"> <?php echo form_input('code', '', 'class="span4" id="code" required="required"  data-error="' . $this->lang->line("code") . ' ' . $this->lang->line("is_required") . ' ' . $this->lang->line("min_2") . '"'); ?> </div>
</div>
<div class="control-group">
    <label class="control-label" for="name"><?php echo $this->lang->line("package_name"); ?></label>

    <div
        class="controls"> <?php echo form_input('name', '', 'class="span4" id="name" required="required" data-error="' . $this->lang->line("name") . ' ' . $this->lang->line("is_required") . '"'); ?> </div>
</div>
<div class="control-group">
    <div
        class="controls"> <?php echo form_submit('submit', $this->lang->line("add_package"), 'class="btn btn-primary"'); ?> </div>
</div>
<?php echo form_close(); ?>
