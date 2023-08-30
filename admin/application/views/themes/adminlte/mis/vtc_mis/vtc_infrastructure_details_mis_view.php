<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
     .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>VTC Infrastructure Details MIS</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> VTC Infrastructure Details MIS</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">VTC Infrastructure Details MIS</h3>
            </div>
            <div class="box-body">
                
                <div class="row">
                <div class="col-md-4">
                    <label for="academic_year">Academic Year</label>
                    <select class="form-control select2 required" style="width: 100%;" name="academic_year" id="academic_year">
                        <option value="">-- Select Year --</option>
                        <?php foreach($yearlist as $year){ ?>
                            <option value="<?php echo $year['academic_year'] ?>"
                            <?php echo set_select('academic_year',$year['academic_year']) ?> selected="true">
                            <?php echo $year['academic_year'] ?></option>
                        <?php } ?>
                    </select>
                </div>
				
				
				<div class="col-md-4">
                    <label for="teacher_type">Nodal Name </label>
                    <select class="form-control select2 required" style="width: 100%;" name="nodal_name" id="nodal_name">
                        <option value="" hidden="true">Select Nodal Name</option>
                        <?php foreach ($nodallist as $nodal){ ?>
                        <option value="<?php echo $nodal['nodal_officer_id_pk'] ?>" <?php echo set_select('nodal_name',$nodal['nodal_officer_id_pk'] ) ?> selected="true"><?php echo $nodal['nodal_centre_name'] ?></option>
                       
                    <?php } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="inputtp">&nbsp;</label><br>
                    <a id="href_add" onclick="ChangeHref()">
                        <button  type="button" class="btn btn-success">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        </button>
                        
                    </a>
                   
                </div>
            </div>
            
            
        </div>
    </section>
</div>






<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script>
    function ChangeHref(){
        var academic_year = $('#academic_year').val();
		//var teacher_type = $('#teacher_type').val();
		var nodal_name = $('#nodal_name').val();
        //alert (nodal_name);
        document.getElementById("href_add").setAttribute("href", "mis/vtc_infrastructure_mis/download_vtc_infrastructure_details/"+academic_year+"/"+nodal_name);
    }
</script>

