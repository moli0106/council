<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Creator/Moderator</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Creator/Moderator List</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Question Creator/Moderator List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/master/question_creator_moderator_jexpo/add') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Question Creator/Moderator
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Creator/Moderator</th>
                            <!-- <th>Creator/Moderator ID</th> -->
                            <th>Exam Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($trainerList))
                            {
                                $i = $offset;
                                foreach ($trainerList as $key => $trainer) { ?>

                                    <tr id="<?php echo md5($trainer['creator_moderator_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $trainer['fname'].' '.$trainer['mname'].' '.$trainer['lname']; ?></td>
                                        <td><?php echo $trainer['mobile_no']; ?></td>
                                        <td><?php echo $trainer['email_id']; ?></td>
                                        <td><?php echo $trainer['designation']; ?></td>
                                        <td><?php if($trainer['creator_moderator_type']==10){echo 'Question Creator';} else { echo 'Question Moderator';}; ?></td>
                                        <!-- <td><?php //echo $trainer['creator_moderator_code']; ?></td> -->
                                        <td><?php echo $trainer['exam_type_name']; ?></td>
                                        <td><?php echo $trainer['subject_name']; ?></td>
                                        <td><?php
                                            if($trainer['active_status'] == 0)
                                                echo'<small class="label label-warning">Pending</small>';
                                            elseif($trainer['active_status'] == 1)
                                                echo'<small class="label label-success">Active</small>';
                                            else
                                                echo'<small class="label label-danger">Suspended</small>';
                                        ?></td>
                                        <!-- <td align="center">
                                            <?php
                                                if($trainer['active_status'] == 1) {
                                                    echo'<button class="btn btn-sm btn-danger changeStatus" data-name="Suspend">
                                                        <i class="fa fa-power-off" aria-hidden="true"></i>
                                                    </button>';
                                                }    
                                                elseif($trainer['active_status'] == 2) {
                                                    echo'<button class="btn btn-sm btn-success changeStatus" data-name="Activate">
                                                        <i class="fa fa-power-off" aria-hidden="true"></i>
                                                    </button>';
                                                }    
                                            ?>
                                        </td> -->
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>