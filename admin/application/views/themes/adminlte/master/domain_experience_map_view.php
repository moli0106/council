<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Map domain qualification</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Council Course</li>
        </ol>
    </section>
    <section class="content">
        
    <?php if(count($course)){ ?>
        <div class="well"><b>Course name: </b><?php echo $course[0]["course_name"] ?>, <b>Course code: </b><?php echo $course[0]["course_code"] ?></div>

        <?php if(isset($success)) { ?>
            
            <div class="alert alert-<?php echo $success ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message; ?>
            </div>
            
        <?php } ?>
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Domain mapping</h3>
            </div>
            <div class="box-body">
            <?php echo form_open("admin/master/new_course/map_domain_qualification/".$course_id_hash) ?>
                <input type="hidden" value="<?php echo $course[0]['course_id_pk'] ?>" name="course_id">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Qualification *</label>
                            <select class="form-control select2 qualification" style="width: 100%;" name="qualification" >
                                <option value="">-- Select Qualification --</option>
                                <?php foreach($qualifications as $qualification){ ?>
                                <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("course_id", $qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('qualification'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Domain *</label>
                            <select class="form-control select2 domain" style="width: 100%;" name="domain">
                                <option value="">-- Select Domain --</option>
                                <?php foreach($domains as $domain){ ?>
                                    <option value="<?php echo $domain['domain_id_pk'] ?>" <?php echo set_select("domain", $domain['domain_id_pk']); ?>><?php echo $domain['domain_name'] ?>"</option>
                                <?php } ?>
                               
                            </select>
                            <?php echo form_error('domain'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Domain Experience(year)*</label>
                            <input type="text" class="form-control" name="domain_exp" id="domain_exp" value="" placeholder="Domain Experience">
                            <?php echo form_error('domain_exp'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="" for="">&nbsp;</label><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
            </div>
        </div>
        <?php if(count($domain_experiences )){ ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Domain List</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Qualification</th>
                            <th>Domain Experience in year(s)</th>
                            <th>Domain</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($domain_experiences as $domain_experience){ ?>
                        <tr id="<?=$domain_experience['course_qualification_map_id_pk']?>">
                            <td><?php echo $i ?></td>
                            <td><?php echo $domain_experience['qualification'] ?></td>
                            <td><?php echo $domain_experience['domain_specific_working_experience'] ?></td>
                            <td><?php echo $domain_experience['domain_name'] ?></td>
                            <td>
                            <a href="<?php echo $domain_experience['course_qualification_map_id_pk'] ?>" alt="<?php echo $course_id_hash; ?>" class="btn btn-danger btn-sm delete_quali_exp_domain_map" data-toggle="modal" data-target="#deleteModal">Delete</a>

                            <a href="#" alt="<?php echo md5($domain_experience['course_qualification_map_id_pk']) ?>" class="btn btn-sm btn-primary editDomain" data-toggle="modal" data-target="#editDomainModal">Edit</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
        
        <?php } else { ?>  
            <div class="alert alert-warning">
                No domain qualification found for this course                
            </div>
        <?php }?>
        <?php } else { ?>
            
            <div class="alert alert-danger">
                Invalid Course 
            </div>
            
        <?php } ?>
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