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
<h1>Vacency wise College List</h1>
<ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-align-center"></i> Vacency wise College List</li>
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
    <div class="box-body">
        <?php echo form_open('admin/spot_council/vacent_college_list/search_discipline_college_map') ?>
        <div class="row">

        <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control select2 domain" style="width: 100%;" name="search_college">
                        <option value="" hidden="true">Search by College Name</option>
                        <?php foreach ($colleges as $college) { ?>
                            <option value="<?php echo $college['college_id_pk'] ?>" <?php echo set_select("search_college", $college['college_id_pk']); ?>> <?php echo $college['college_name'] ?></option>
                        <?php } ?>

                    </select>
                    <?php echo form_error('search_college'); ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control select2 qualification" style="width: 100%;" id="search_discipline" name="search_discipline">
                        <option value="" hidden="true">Search by Discipline</option>
                        <?php foreach ($disciplines as $discipline) { ?>
                            <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php echo set_select("search_discipline", $discipline['discipline_id_pk']); ?>>
                                <?php echo $discipline['discipline_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('search_discipline'); ?>
                </div>
            </div>
        

            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">
                        Search <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

        </div>
        <?php echo form_close() ?>
    </div>
    <!-- END of Search Domain -->
    <div class="box-header with-border">
        <h3 class="box-title">Vacency wise College List</h3>
        <!-- <div class="box-tools pull-right">
            <span class="label label-primary">Label</span>
        </div> -->
    </div>
    <div class="box-body" style="overflow-x: auto" >
        <?php if (count($college_list)) { ?>
            <table class="table table-bordered table-hover table-responsive" >
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>College Name</th>
                        <th>College Code</th>
                        <th> College Type </th>
                        <th>Discipline Name </th>
                        <th> College District </th>
                        <th>General<br/> with Vacent Place</th>
                        <th>SC <br/> with Vacent Place</th>
                        <th>ST <br/> with Vacent Place</th>
                        <th>PC <br/> with Vacent Place</th>
                       <!--  <th>OBC-A <br/> with Vacent Place</th>
                        <th>OBC-B <br/> with Vacent Place</th> -->
                        
                    
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $offset + 1; 
                    // echo '<pre>'; print_r($college_list); die;
                    foreach ($college_list as $vacent_colleg_list) {
                           
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $vacent_colleg_list['college_name'] ?> </td>
                    <td><?php echo $vacent_colleg_list['college_code'] ?></td>
                    <td><?php echo $vacent_colleg_list['college_type'] ?></td>
                    <td><?php echo $vacent_colleg_list['discipline_name'] ?></td>
                    <td><?php echo $vacent_colleg_list['district_name'] ?></td>
                    <td style="text-align:center;" class="action_buttons">
                    <?php if($vacent_colleg_list['gen_count']!=0){  echo $vacent_colleg_list['gen_count']?>  <br/>
                        <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/1/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ ?>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>  
                    <?php } ?>
                    <td style="text-align:center;" class="action_buttons" >
                    <?php if($vacent_colleg_list['sc_count'] !=0 && $vacent_colleg_list['gen_count']==0){ echo $vacent_colleg_list['sc_count']; ?><br/>
                    <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/2/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ echo $vacent_colleg_list['sc_count'];?><br/>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>
                        <?php } ?>

                        <td style="text-align:center;" class="action_buttons" >
                    <?php if($vacent_colleg_list['st_count'] !=0 && $vacent_colleg_list['gen_count']==0){ echo $vacent_colleg_list['st_count']; ?><br/>
                    <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/3/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ echo $vacent_colleg_list['st_count']; ?><br/>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>
                        <?php } ?>
                        <td style="text-align:center;" class="action_buttons" >
                    <?php if($vacent_colleg_list['pc_count'] !=0 ){ echo $vacent_colleg_list['pc_count']; ?><br/>
                    <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/6/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ ?>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>
                        <?php } ?>

                       <!-- <td style="text-align:center;" class="action_buttons" >
                    <?php if($vacent_colleg_list['obc_a_count'] !=0){ echo $vacent_colleg_list['obc_a_count']; ?><br/>
                    <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/'.$vacent_colleg_list['caste_id_fk'].'/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ ?>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>
                        <?php } ?>

                        <td style="text-align:center;" class="action_buttons" >
                    <?php if($vacent_colleg_list['obc_b_count'] !=0){ echo $vacent_colleg_list['obc_b_count']; ?><br/>
                    <a href="<?php echo base_url('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . md5($vacent_colleg_list['college_id_fk']).'/'.$vacent_colleg_list['caste_id_fk'].'/'.$vacent_colleg_list['discipline_id_fk']); ?>" title="Book Now" data-toggle="modal" data-target=""><img src="themes\adminlte\assets\image\book.png" ></a></td>
                    <?php } else{ ?>
                        <label><img src="themes\adminlte\assets\image\no.png" height="20px" width="20px" title="No vacent"></label>
                        <?php } ?> -->

                        

                
                </tr>
                    <?php  $i++;
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