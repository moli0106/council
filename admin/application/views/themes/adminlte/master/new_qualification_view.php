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
        <h1>Add qualification</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Add qualification</li>
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
                <?php echo form_open('admin/master/new_qualification',array("id"=> "course_entry_form")) ?>
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="" for="">Qualification Name *</label>
                            <input type="text" class="form-control" name="qualification_name" id="qualification_name"
                                value="<?php echo set_value('qualification_name'); ?>" placeholder="Enter qualification name">
                            <?php echo form_error('qualification_name'); ?>
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
                <h3 class="box-title">Qualification List</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php if(count($qualifications)){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Qualification Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1; foreach($qualifications as $qualification){ ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $qualification['qualification'] ?></td>
                            <td class="action_buttons">
                                <!-- <a href="#" alt="<?php echo md5($course['course_id_pk']) ?>" class="btn btn-xs btn-primary view_course" data-toggle="modal" data-target="#myModal">View</a> -->
                                <a href="#" alt="<?php echo md5($qualification['qualification_id_pk']) ?>" class="btn btn-xs btn-primary delete_qualification" data-toggle="modal" data-target="#myModal">Delete</a>
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