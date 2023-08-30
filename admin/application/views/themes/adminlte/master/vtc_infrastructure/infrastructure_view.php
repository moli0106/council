<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Infrastructure Item</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Infrastructure Item List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Infrastructure Item</h3>
                    </div>
                    
                    <div class="box-body">
                        <?php echo form_open('admin/master/infrastructure') ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Infrastructure Item Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="item_name" value="<?php echo set_value('item_name'); ?>" placeholder="Enter Infrastructure Item">
                                    <?php echo form_error('item_name'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Infrastructure Category <span class="text-danger">*</span></label>
                                    <select class="form-control" style="width: 100%;" name="category_name" id="category_name">
                                        <option value="" hidden="true">Select Infrastructure Category</option>
                                        <option value="1" <?php echo set_select('category_name', 1) ?>>Vocational Paper Laboratory</option>
                                        <option value="2" <?php echo set_select('category_name', 2) ?>>Other Common Laboratory</option>
                                    </select>
                                    <?php echo form_error('category_name'); ?>
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block btn-flat" name="submitInfrastructureItem" value="1">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    Submit Infrastructure Item
                                </button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Map Infrastructure with Course </h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/master/infrastructure') ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_name_id">Course Name<span class="text-danger">*<span></label>
                                    <select class="form-control" style="width: 100%;" name="course_name_id" id="course_name_id">
                                        <option value="" hidden="true">Select Course Name</option>

                                        <?php foreach ($courseNameList as $courseName) { ?>
                                            <option value="<?php echo $courseName['course_name_id_pk'] ?>" <?php echo set_select('course_name_id', $courseName['course_name_id_pk']) ?>>
                                                <?php echo $courseName['course_name'] ?>
                                            </option>
                                        <?php } ?>
                                        
                                    </select>
                                    <?php echo form_error('course_name_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Discipline <span class="text-danger">*<span></label>
                                    <select class="form-control" style="width: 100%;" name="discipline_id" id="discipline_list">
                                        <option value="" hidden="true">Select Discipline</option>
                                        <?php foreach ($disciplineList as $value) {?>
                                        <option value="<?php echo $value['discipline_id_pk']?>" <?php echo set_select('discipline_id' , $value['discipline_id_pk']); ?>>
                                            <?php echo $value['discipline_name']?></option>
                                        <?php }?>
                                       

                                    </select>
                                    <?php echo form_error('discipline_id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Group/Trade <span class="text-danger">*<span></label>
                                    <select class="form-control select2" style="width: 100%;" name="course_id" id="group_list">
                                        <option value="">-- Select Group/Trade --</option>
                                       
                                    </select>
                                    <?php echo form_error('course_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="" for="">Infrastructure Item <span class="text-danger">*<span></label>
                                <select class="form-control select2" style="width: 100%;" multiple="multiple" name="item_id[]" id="item_id">
                                    <option value="">-- Select Infrastructure Item --</option>

                                    <?php foreach ($infrastructureItem as $key => $item) { ?>
                                        <option value="<?php echo $item['infrastructure_item_id_pk']; ?>" <?php echo set_select('item_id[]', $item['infrastructure_item_id_pk']); ?>>
                                            <?php echo $item['item_name']; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                                <?php echo form_error('item_id[]'); ?>
                            </div>

                        </div>
                        <div class="row">   
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label for=""></label>
                                <button type="submit" class="btn btn-warning btn-block btn-flat" name="mapInfrastructureWithCourse" value="2">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    Map Infrastructure with Course
                                </button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Infrastructure Item List</h3>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th >Infrastructure Item Name</th>
                                <th>Action</th>
                                
                            </tr>
                            <?php
                            if (count($infrastructureItem)) {
                                $i = $offset;
                                foreach ($infrastructureItem as $key => $val) { ?>

                                    <tr id="<?php echo md5($val['infrastructure_item_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $val['item_name']; ?></td>

                                        <td>
                                            <?php if($val['map_status'] == 'no'){?>
                                                


                                                <?php echo form_open("admin/master/infrastructure/delete_infrastructure_item", array("id" => "itemDelete")); ?>
                                                    <input type="hidden" name="item_id" value="<?php echo md5($val['infrastructure_item_id_pk']); ?>">
                                                    <a class="btn btn-sm btn-flat btn-info delete-infra-item-btn"> <i class='fa fa-trash' style='color: red'></i></a>
                                                <?php echo form_close() ?>&nbsp;&nbsp;
                                            <?php }?>
                                            <a  class="btn btn-sm btn-flat btn-info infra-item-details-btn"  data-toggle="modal" data-target="#modal-infra-item-details">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                       
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Map Infrastructure with Course</h3>
						<div class="pull-right">
							<!-- <a href="qbm_master/question_type_mark/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> -->
                            <a href="<?php echo base_url('admin/master/infrastructure/downloadExcel') ?>" class="btn btn-info btn-sm">
                                <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Map Infrastructure with Course
                            </a>
                        </div>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Discipline</th>
								<th>Group Name</th>
                                <th >Infrastructure Item</th>
                                
                                <th style="width: 11%;">Action</th>
                            </tr>
                            <?php
                            if (count($infrastructureMapCourseList)) {
                                $i = $offset;
                                foreach ($infrastructureMapCourseList as $key => $val) { ?>

                                    <tr id="<?php echo md5($val['infrastructure_item_course_map_id_pk']); ?>" >
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $val['course_name']; ?></td>
                                        <td><?php echo $val['discipline_name']; ?></td>
										<td><?php echo $val['group_name']; ?></td>
                                        <td><?php echo $val['item_name']; ?></td>
                                        
                                        <td>
                                            <a class="btn btn-sm btn-flat btn-info delete-infrastructure-btn mydelete" >
                                            <i class='fa fa-trash' style='color: red'></i>
                                            </a>
                                            <!-- <a  class="btn btn-sm btn-flat btn-info infra-map-details-btn"  data-toggle="modal" data-target="#modal-infra-map-details">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a> -->
                                        </td>
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>

                    <!-- <div class="box-footer"></div> -->

                </div>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<!-- Infrastructure Item Details -->

<div class="modal modal-success fade" id="modal-infra-item-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Infrastructure Item</h4>
            </div>
            <div class="modal-body infra-item-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-success fade" id="modal-infra-map-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Map Infrastructure with Course</h4>
            </div>
            <div class="modal-body infra-map-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


