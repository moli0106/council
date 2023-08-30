<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
.mbotm20 {margin-bottom:20px;}
.imgcard {width:450px; height: 300px; overflow: hidden;}
.imgcard img {width: 100%; height: 100%;}
</style>
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
                            
                            <th> Question Category</th>
                            <th> Question Details</th>
                            <!-- <th> Status </th> -->
                            <?php //if($this->session->stake_id_fk==7){?>
                            <th style="width: 7%;"> Action </th>
                            <?php //}?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($questions as $question){ ?>
                        <tr id="<?php echo md5($question['question_id_pk']); ?>">
                            <td><?php echo $offset + $i; ?></td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Exam Type :</b> <?php echo $question['exam_type_name']; ?></li>
                                    <li class="list-group-item"><b>Subject :</b> <?php echo $question['subject_name']; ?></li>
                                    <li class="list-group-item"><b>Level :</b> <?php echo $question['level_name']; ?></li>
                                    
                                
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Question :</b> <?php echo openssl_decrypt($question['question'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?>
                                    <li class="list-group-item"><a href="<?php echo md5($question['question_id_pk']); ?>" class="btn btn-info btn-xs btn-block question_view" data-toggle="modal" data-target="#myModal" style="width: 25%;"><i class="fa fa-eye"></i> View Question</a>
                                    </li>
                                    
                                    <li class="list-group-item"><b>Status :</b> 
                                        <?php
                                            if($question['process_status_main'] == 0)
                                                echo'<small class="label label-warning">Pending</small>';
                                            elseif($question['process_status_main'] == 5)
                                                echo'<small class="label label-success">Approved</small>';
                                            else
                                                echo'<small class="label label-danger">Rejected</small>';
                                        ?>
                                    </li>
                                    <li class="list-group-item"><b>Bengali Language Status :</b> 
                                        <?php
                                            if($question['bengali_lan_quesstion_status'] == 0)
                                                echo'<small class="label label-warning">Pending</small>';
                                            else
                                                echo'<small class="label label-success">Inserted</small>';
                                        ?>
                                    </li>
                                </ul>
                            </td>

                            
                            
                            <td>
                                <?php
                                    if($this->session->stake_id_fk==11){
                                    if($question['process_status_main'] == 0) {?>
                                        <button class="btn btn-sm btn-success changeStatus" data-name="approveReject">
                                            <i class="fa fa-check-circle " aria-hidden="true"></i>
                                        </button>

                                        <a href="question/manage_question_jexpo_voclet/edit/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o " aria-hidden="true"></i></button></a>

                                        <?php if($question['bengali_lan_quesstion_status'] == 1){?>
                                            <a href="question/manage_question_jexpo_voclet/add_bengali_question/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-eye " aria-hidden="true"> Bangali</button></i></a>
                                        <?php }?>
                                   <?php } 
                                }   
                                ?>
                                <?php if($this->session->stake_id_fk==10){?>
                                <a href="question/manage_question_jexpo_voclet/add_bengali_question/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus " aria-hidden="true"> Bangali</button></i></a>
                                <?php }?>
                                
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



<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title modal_title">Modal Header</h4>
	      </div>
	      <div class="modal-body" id="modal_view">
	       
	      </div>
	      <div class="modal-footer">
          	<!-- <button type="button" class="btn btn-primary print_details_tp">Print</button> -->
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	
	  </div>
	</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>