<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style>
.star {
    color: red;
    font-size: 14px;
}

.mtop20 {
    margin-top: 20px;
}

.mbottom20 {
    margin-bottom: 20px;
}

.mright20 {
    margin-right: 20px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Data List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Data List</li>
        </ol>
    </section>
    <section class="content">
        <?php if (isset($status)) { ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>

        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Student data List</h3>


                <br /><br /><br />
                <h3 class="box-title" style="color:green;"><b> Zone Wise Seat Allocation</b></h3>


                <div class="row">

                    <div class="col-md-5">
                        <label for="academic_year">Select Zone</label>
                        <select class="form-control select2 required" style="width: 100%;" name="zone" id="zone">
                        <option value="">Select Zone</option> 
                            <?php foreach ($districtlist as $dist) { ?>
                            <option value="<?php echo $dist['district_id_pk'] ?>"
                                <?php echo set_select('zone', $dist['district_id_pk']) ?>>
                                <?php echo $dist['district_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="academic_year">Select Course</label>
                        <select class="form-control select2 required" style="width: 100%;" name="course" id="course" required>
                        <option value="">Select Course</option> 
                        <?php foreach ($courses as $course) { ?>
                                <option value="<?php echo $course['exam_type_id_pk'] ?>" <?php echo set_select('course', $course['exam_type_id_pk']) ?>>
                                    <?php echo $course['exam_type_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="col-md-2" style="margin-top:5px;">
                        <br />
                        <button type="button" class="btn btn-info stu_centre_wise_seat_allocation"> Seat Allocation
                        </button>
                    </div>
                </div>

                <!-- <div style="margin-left:1000px">
                <a href="spot_council/student_data_list/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> </div>

                <div style="margin-left:1000px;"> <a href="spot_council/student_data_list/merit_list_pdf"><button type="button" class="btn btn-info" title="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>  
                -->

                <!-- </div> -->


                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/spot_council/student_data_list/excel_download') ?>"
                        class="btn bg-orange btn-sm btn-flat">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Student List
                    </a>

                    <a href="<?php echo base_url('admin/spot_council/student_data_list/merit_list_pdf') ?>"
                        class="btn btn-info btn-sm btn-flat">
                        <i class="fa fa-download" aria-hidden="true"></i> Dwonload Merit List
                    </a>

                </div>
            </div>
            <br>
            <div class="box-body">
                <?php if (count($student_data_list)) { ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Candidate Name</th>
                            <th>Guardian's Name </th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1;
                            foreach ($student_data_list as $student_data) {
                                //    echo '<pre>'; print_r($vacent_colleges); die;
                            ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $student_data['candidate_name'] ?></td>
                            <td><?php echo $student_data['guardian_name'] ?></td>
                            <td><?php echo $student_data['course_name'] ?></td>
                            <td><?php echo $student_data['gender_description'] ?></td>
                            <td class="action_buttons">

                                <a href="<?php  echo base_url('admin/spot_council/student_data_list/get_preview_student_data/' . md5($student_data['student_details_id_pk'])); ?>"
                                    class="btn btn-sm btn-success" data-toggle="modal" data-target="">View</a>


                                <!-- <a href="#" alt="<?php echo md5($qualification_domain['council_qualification_domain_pk']) ?>" class="btn btn-sm btn-success book_place" data-toggle="modal" data-target="#myModal">Book</a> -->
                                <!-- <a href="master/new_course/map_domain_qualification/<?php echo md5($course['course_id_pk']) ?>" alt="" class="btn btn-xs btn-info">Map Domain</a> -->
                            </td>
                        </tr>
                        <?php $i++;
                            } ?>
                    </tbody>
                </table>
                <?php  } else { ?>
                No Data Found

                <?php  } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        <!-- END of Search Domain -->
    </section>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>