<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<div class="container">
    
    <?php if(isset($success)){ ?>
    <div class="alert alert-<?php echo $success; ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $message; ?>
    </div>
    <?php } ?>
    
</div>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>