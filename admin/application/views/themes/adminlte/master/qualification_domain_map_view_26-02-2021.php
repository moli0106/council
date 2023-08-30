<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
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
        <h1>Qualification domain Map</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Qualification domain Map</li>
        </ol>
    </section>
    <section class="content">
        <?php if(isset($status)){ ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Entry form</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/qualification_domain_map',array("id"=> "course_entry_form")) ?>
                <div class="row">
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Qualification *</label>
                        <select class="form-control select2 qualification" style="width: 100%;" name="qualification" >
                            <option value="">-- Select Qualification --</option>
                            <?php foreach($qualifications as $qualification){ ?>
                            <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("qualification", $qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('qualification'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Domain *</label>
                        <select class="form-control select2 domain" style="width: 100%;" name="domain">
                            <option value="">-- Select Domain --</option>
                            <?php foreach($domains as $domain){ ?>
                                <option value="<?php echo $domain['domain_id_pk'] ?>" <?php echo set_select("domain", $domain['domain_id_pk']); ?>><?php echo $domain['domain_name'] ?></option>
                            <?php } ?>
                            
                        </select>
                        <?php echo form_error('domain'); ?>
                    </div>
                </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Qualification domain map List</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php if(count($qualification_domain_map)){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Qualification </th>
                            <th>Domain </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1; foreach($qualification_domain_map as $qualification_domain){ ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $qualification_domain['qualification'] ?></td>
                            <td><?php echo $qualification_domain['domain_name'] ?></td>
                            <td class="action_buttons">
                                <!-- <a href="#" alt="<?php echo md5($course['course_id_pk']) ?>" class="btn btn-xs btn-primary view_course" data-toggle="modal" data-target="#myModal">View</a> -->
                                <a href="#" alt="<?php echo md5($qualification_domain['council_qualification_domain_pk']) ?>" class="btn btn-xs btn-primary delete_domain" data-toggle="modal" data-target="#myModal">Delete</a>
                                <!-- <a href="master/new_course/map_domain_qualification/<?php echo md5($course['course_id_pk']) ?>" alt="" class="btn btn-xs btn-info">Map Domain</a> -->
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    No data found
                <?php } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
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
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>