<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Subject wise Topics/Chapter </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Subject wise Topics/Chapter</li>
        </ol>
    </section>
    <section class="content">
    <?php if(isset($success)) { ?>
            
            <div class="alert alert-<?php echo $success ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message; ?>
            </div>
            
            <?php } ?>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subject wise Topics/Chapter</h3>
                    </div>
                    <div class="box-body">
                    <?php echo form_open("admin/qbm_master/subject/add_topics/".$subject_id_hash) ?>
                        <input type="hidden" value="<?php echo $subject['subject_id_pk'] ?>" name="subject_id">
                        <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label class="" for="">Topics/Chapter *</label>
                                    <input type="text" class="form-control" name="topics" id="topics" value="" placeholder="Topics/Chapter">
                                    <?php echo form_error('topics'); ?>
                                </div>
                            </div>
                        </div>
                            <?php //if($subject["course_id_fk"]==1 || $subject["course_id_fk"]==2){?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <label class="" for="">Semester</label><br>
										<label style="color:red;">Select Semester only for HS-VOC (XI) & HS-VOC (XII)</label>
                                        <select class="form-control select2" style="width: 100%;" name="sam_year_id" id="sam_year_id">
                                            <option value="">-- Select Semester --</option>
                                            <?php foreach($semesters as $semester){ ?>
                                                <option value="<?php echo $semester['semester_id_pk']; ?>" <?php echo set_select('sam_year_id', $semester['semester_id_pk']); ?>><?php echo $semester['semester_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('sam_year_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <?php //}?>
                            <div class="col-md-4 col-md-offset-4">
                                <label class="" for="">&nbsp;</label><br>
                                <button type="submit" class="btn btn-info btn-block btn-flat">Submit Topics/Chapter</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        
        
        <?php if(count($topics_chapter_list )){ ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Subject wise Topics/Chapter List</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Subject</th>
                            <th>Topics/Chapter</th>
                            <th>Semester</th>
        
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($topics_chapter_list as $topics_chapter){ ?>
                        <tr id="<?=$topics_chapter['subject_topics_map_id_pk']?>">
                            <td><?php echo $i ?></td>
                            <td><?php echo $topics_chapter['subject_name']; ?></td>
                            <td><?php echo $topics_chapter['topics_chapter_name']; ?></td>
                            <td><?php echo ($topics_chapter['semester_name']!='') ? $topics_chapter['semester_name'] : 'N/A' ;?></td>
                            
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
        
        <?php } else { ?>  
            <div class="alert alert-warning">
                No Topics/Chapter found for this Subject                
            </div>
        <?php }?>
        
    </section>


    
    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure? You want to delete this?</p>

                    <input type="hidden" id="map_id" value="">
                    <input type="hidden" id="redirect" value=""> 
                
                    <button type="button" class="btn btn-danger delete_data">Delete</button>
                
                </div>
                <div class="modal-footer">
                    <a href="master/new_course/map_domain_qualification/<?php echo $course_id_hash; ?>" class="btn btn-default">Close</a>
                
                </div>
            
            
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div id="editDomainModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Update Domain Details</strong></h4>
                </div>
                <div class="modal-body">

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>