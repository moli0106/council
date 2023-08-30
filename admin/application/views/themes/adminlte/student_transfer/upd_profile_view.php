<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .content-block {
        border: 4px solid #43A047;
        border-radius: 10px;
        border-top: none;
        border-bottom: none;
        padding: 5px 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: #ECEFF1;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="cssvse/student"><i class="fa fa-list"></i> Student List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Student</li>
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
                <h3 class="box-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Update Student</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                
                <?php echo form_open_multipart("admin/student_transfer/update_profile",array("id" => "update-student-form")); ?>
                    <input type="hidden" name="std_id" value="<?php echo $student_id_pk;?>">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="col-md-8">
                            <span>
                                TFW
                                <span class="text-danger">*</span>
                            </span>
                            
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" <?php if($formData['tfw'] == 1){echo 'checked';}?> type="radio" name="tfw" id="tfw_yes">
                            <label class="form-check-label" for="tfw_yes">
                                YES
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" value="0" <?php if($formData['tfw'] == 0){echo 'checked';}?> type="radio" name="tfw" id="tfw_no">
                            <label class="form-check-label" for="tfw_no">
                               NO
                            </label>
                        </div>
                        <?php echo form_error('tfw'); ?>
                    </div> 

                    <div class="col-md-6">
                            
                        <div class="form-group">
                            <label class="" for="tfw_doc">
                            Upload TFW Doc
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>

                                <?php if($trasfer_details['tfw_doc'] !='') {?>
                                    <a href="<?php echo base_url('admin/student_transfer/update_profile/show_tfw_doc/' . $student_id_pk); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i>View</a>
                                <?php }?>
                            </label>
                        
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="tfw_doc" id="tfw_doc">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('tfw_doc'); ?>
                        </div>
                    </div>
                    
                    
                </div>

                

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Academic details:</strong></h4>
                <div class="content-block">
                    <h4 style="margin-left:30px"> <b>Examination Qualified - Class 10 / Madhyamik/Equivalent Examination</b></h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="" for="board_id">Select Board name <span class="text-danger">*</span></label>
                                <select class="form-control" name="board_id" id="board_id">
                                    <option value="" hidden="true">Select Board name</option>
                                    <?php foreach ($board_name as $value) { ?>
                                    <option value="<?php echo $value['board_id_pk']?>"
                                        <?php if($formData['board_id'] == $value['board_id_pk']){echo 'selected';}?>>
                                        <?php echo $value['board_name']?></option>
                                    <?php }?>



                                </select>
                                <?php echo form_error('board_id'); ?>
                            </div>
                        </div>
                       

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="passing_year">Year of Passing <span class="text-danger">*</span></label>

                                
                                <input type="number" class="form-control" id="passing_year" name="passing_year"
                                    value="<?php echo $formData['passing_year']; ?>" placeholder="Passing Year"/>
                                <?php echo form_error('passing_year'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fullmark">Total Aggregate Marks <span class="text-danger">*</span></label>

                               
                                <input type="number" class="form-control" id="fullmark" name="fullmark"
                                    value="<?php echo $formData['full_marks']; ?>" placeholder="Full Marks" />
                                <?php echo form_error('fullmark'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>

                                
                                <input type="number" class="form-control" id="marks_obtain" name="marks_obtain"
                                    value="<?php echo $formData['marks_obtain']; ?>" placeholder="Marks Obtain" />
                                <?php echo form_error('marks_obtain'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="percentage">Percentage % <span class="text-danger">*</span></label>

                               
                                <input type="number" class="form-control" id="percentage" name="percentage"
                                    value="<?php echo $formData['percentage']; ?>" placeholder="Percentage" readonly />
                                
                                <?php echo form_error('percentage'); ?>
                            </div>
                        </div>

                       
                    </div>
                </div>

               

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
					<?php if($trasfer_details['update_transfer_profile'] != 1){?>
                        <button type="button" class="btn btn-sm btn-info btn-flat" id="update-student-profile">
                            Update Profile
                        </button>
					<?php }?>
					<?php //}?>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>

        </div>
    </section>
</div>

<script>


$(document).on('click', '#update-student-profile', function () {
		Swal.fire({
			title: 'Warning!<br>Are you sure?You want to update student profile.',
			text: "You won't be able to revert this!",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Do it!',
			allowEscapeKey: false,
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {

				Swal.fire({
					title: 'Please wait a moment!',
					allowEscapeKey: false,
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
						$('#update-student-form').submit();
					}
				});
			}
		});
	});

     $('#fullmark').on('input', function() {
        calculate();
      });
      $('#marks_obtain').on('input', function() {
       calculate();
      });
    function calculate(){
        var fullmark = parseInt($('#fullmark').val()); 
        var marks_obtain = parseInt($('#marks_obtain').val());
		var exam_type_id = parseInt($('#exam_type_id').val());
        var perc="";
        if(isNaN(fullmark) || isNaN(marks_obtain)){
            perc=" ";
        }else{
			perc = ((marks_obtain/fullmark) * 100).toFixed(3);
		}
			
		

        $('#percentage').val(perc);
    }
    $("#fullmark, #marks_obtain").on("keyup", function() {
        var fullmark = $("#fullmark").val();
        var marks_obtain = $("#marks_obtain").val();
        if (Number(marks_obtain) > Number(fullmark)) {
            // alert("Second value should less than first value");
            Swal.fire('Obtain marks value should less than to value of Full marks')
            return true;
        }
    });

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });
</script>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>