<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Questions List</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Questions List</h3>
            </div>
            <!-- <div class="box-body">
                <?php echo form_open('admin/question/manage_question',array('autocomplete'=> 'off')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pan_no">PAN No.</label>
                            <input type="text" name="pan_no" id="pan_no" value="<?php echo set_value('pan_no')?>" class="form-control" placeholder="PAN No." style="text-transform: uppercase;">
                            <?php echo form_error('pan_no'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>SSC/ WBSCTVESD certified assessor ? <span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" id="ssc_wbsctvesd_certified" name="ssc_wbsctvesd_certified" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                    <option value="">-- Select --</option>
                                    <option value="1" <?php echo set_select("ssc_wbsctvesd_certified",1) ?>>Yes </option>
                                    <option value="2" <?php echo set_select("ssc_wbsctvesd_certified",2) ?>>No </option>
                            </select>
                            <?php echo form_error('ssc_wbsctvesd_certified'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputtp">&nbsp;</label><br>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            </div> -->
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th> Question </th>
                            <th> Option A </th>
                            <th> Option B </th>
                            <th> Option C </th>
                            <th> Option D </th>
                            <th> Correct Answer </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($questions as $question){ ?>
                        <tr id="<?php echo md5($question['question_id_pk']); ?>">
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo $question['question']; ?></td>
                            <td><?php echo $question['option1']; ?></td>
                            <td><?php echo $question['option2']; ?></td>
                            <td><?php echo $question['option3']; ?></td>
                            <td><?php echo $question['option4']; ?></td>
                            <td><?php echo $question['right_answer']; ?></td>
                            <td><?php
                                if($question['process_status_id_fk'] == 0)
                                    echo'<small class="label label-warning">Pending</small>';
                                elseif($question['process_status_id_fk'] == 5)
                                    echo'<small class="label label-success">Approved</small>';
                                else
                                    echo'<small class="label label-danger">Rejected</small>';
                            ?></td>
                            <td align="center">
                                <?php
                                    if($this->session->stake_id_fk==7){
                                    if($question['process_status_id_fk'] == 0) {
                                        echo'<button class="btn btn-sm btn-success changeStatus" data-name="approveReject">
                                            <i class="fa fa-check-circle " aria-hidden="true"></i>
                                        </button>';
                                    } 
                                }   
                                ?>

                                <button type="button" class="btn btn-info btn-sm getSectorJobRole" data-toggle="modal" data-target="#myModalList"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <?php $i++;  } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
    
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>