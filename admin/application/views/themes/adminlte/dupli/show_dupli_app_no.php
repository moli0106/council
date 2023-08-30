<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> Various Courses / Online Application form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>


<div class="container">

    <div class="row">
	
	<div class="box-tools pull-right">
                    <div class="has-feedback">
                        <button type="button" class="btn btn-warning pull-right change_app_no">Change Application No</button>
                    </div>
                </div>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
			

                <div class="">

                    <div class="">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>pk</th>
                                    <th>app No</th>
                                    <th>exam_type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
								<input type="checkbox" class="chk_boxes" label="check all"  />check all
                                <?php if (count($get_duplicate) > 0) { ?>
                                <?php foreach ($get_duplicate as $key => $value) { ?>
                                <tr id="<?php echo $value['student_details_id_pk']; ?>">
                                    <td>
									
									<input type="checkbox" name="std_id_pk" class="checkStd" value="<?php echo ($value['student_details_id_pk']); ?>"><br>
                                        <?php echo ++$count; ?>.
                                    </td>
									<td><?php echo $value['student_details_id_pk']; ?></td>
                                    <td><?php echo $value['application_form_no']; ?></td>
									<td><?php echo $value['exam_type_id_fk']; ?></td>
                                    
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="3" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<script>

$('.chk_boxes').click(function(){
	
	
    var chk = $(this).attr('checked',$(this).attr('checked'))?true:false;
	//alert(chk);
    $('.checkStd').attr('checked',chk);
});

 $(document).on('click', '.change_app_no', function(e) {

       
        var isChecked = $('.checkStd').is(':checked');
        
        if (isChecked == false) {
            Swal.fire('Warning!', 'Oops! Please checked atleast one student.', 'warning');
        } else {

            var stdIdArray = [];
            $.each($("input[name='std_id_pk']:checked"), function() {
                stdIdArray.push($(this).val());
            });
            alert("My favourite std_id_pk are: " + stdIdArray);
            if(stdIdArray.length > 50){
                Swal.fire('Warning!', 'Oops! checked no of 20 students at a time.', 'warning');
            }else{
                if(stdIdArray){

                    Swal.fire({
                        title: 'Are you sure?You want to change app no!',
                        text: "You will not able to revert it back.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Please wait a moment!',
                                html: 'We\'ll saving your Data.',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                
                                    setTimeout(function() {

                                        $.ajax({
                                            url: "dupli/registration/change_duplicate_app_no",
                                            data: {
                                                stdIdArray: stdIdArray
                                                
                                            },
                                            type: 'GET',
                                            dataType: "json",
                                        })
                                        .done(function(response) {
											if(response == 'done'){
                                            Swal.fire('Success!', 'Successfully Eligible for examination.', 'success');
                                            location.reload();
											}else{
												Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
											}
                                        })
                                        .fail(function(res) {
                                            
                                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                        });

                                    })
                                }
                            })
                        }
                    })
                }
            }

            

        }
    });
</script>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>