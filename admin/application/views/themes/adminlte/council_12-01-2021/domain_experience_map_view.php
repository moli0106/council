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
        <?php if(count($domain_experiences )){ ?>

        <div class="well"><b>Course name: </b><?php echo $domain_experiences[0]["course_name"] ?>, <b>Course code: </b><?php echo $domain_experiences[0]["course_code"] ?></div>

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
            <?php echo form_open("admin/council/new_course/map_domain_qualification/".$course_id_hash) ?>
                <input type="hidden" value="<?php echo $domain_experiences[0]['course_id_pk'] ?>" name="course_id">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Qualification *</label>
                            <select class="form-control select2" style="width: 100%;" name="qualification">
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
                            <select class="form-control select2" style="width: 100%;" name="domain">
                                <option value="">-- Select Domain --</option>
                                <?php foreach($domains as $domain){ ?>
                                <option value="<?php echo $domain['domain_id_pk'] ?>" <?php echo set_select("domain", $domain['domain_id_pk']); ?>><?php echo $domain['domain_name'] ?></option>
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
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $domain_experience['qualification'] ?></td>
                            <td><?php echo $domain_experience['domain_specific_working_experience'] ?></td>
                            <td><?php echo $domain_experience['domain_name'] ?></td>
                            <td>
                            <a href="<?php echo $domain_experience['course_qualification_map_id_pk'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    
                    <div class="alert alert-warning">
                        No domain qualification found for this course                
                    </div>
                    
                <?php }?>
            </div>
        </div>
        
        
    </section>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>