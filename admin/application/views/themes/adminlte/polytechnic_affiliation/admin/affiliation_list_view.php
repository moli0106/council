<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>




<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i> Institute List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Institute List</h3>
                <div class="box-tools pull-right">
                    

                </div>
            </div>
            <div class="box-body">
                
                <?php echo form_open('admin/polytechnic_affiliation/affiliation_admin', array('id' => 'poly_search_form')) ?>
                <div class="text-center">

                    <label for="academic_year">Select Year:</label>
                    <select class ="" name="academic_year" id="academic_year"  style="width: 12em;height: 2em;">
                        <option value="">-- Select Year --</option>
                        <?php foreach($yearlist as $year){ ?>
                            <option value="<?php echo $year['academic_year'] ?>"
                                <?php if($year['academic_year'] == $academic_year) echo 'selected'; ?>>
                                <?php echo $year['academic_year'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="selected_year" value ="<?php echo $academic_year;?>">

                   

                </div>
                <?php echo form_close() ?>
               
            
                <table class="table table-hover dom-jQuery-events" id="editable-sample" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th style="width: 10em;">Name</th>
                            <th style="width: 10em;">Application Number</th>
                            <th>Affiliation Year</th>
                            <th>Affiliated Status</th>
                            <th style="width: 23em;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- <div class="box-footer">
                <?php echo $page_links; ?>
            </div> -->
        </div>

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

