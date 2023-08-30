<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Basic Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <?php echo form_open('admin/affiliation/vtc/vtcEmailUpdate', array('id' => 'updateVtcEmail')) ?>
        <input type="hidden" name="vtc_details_id_hash" value="<?php echo md5($basicDetails['vtc_details_id_pk']); ?>">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th width="15%">Institute Email:</th>
                        <td width="35%"><input type="email" name="ins_email" class="form-control"
                                value="<?php echo $basicDetails['institute_email']; ?>"></td>
                        <th width="15%">Primary Contact Number:</th>
                        <td width="35%"><?php echo $basicDetails['mobile_no_1']; ?></td>
                    </tr>
                    <tr>
                        <th>Secondary Contact Number:</th>
                        <td><?php echo $basicDetails['mobile_no_2']; ?></td>
                        <th>Fax Number:</th>
                        <td><?php echo $basicDetails['fax_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Website.:</th>
                        <td><?php echo $basicDetails['web_url']; ?></td>
                        <th>Type:</th>
                        <td>
                            <?php
                                echo $basicDetails['category_name'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        
                        <th colspan="3">Address:</th>
                        <td><?php echo $basicDetails['address']; ?></td>
                    </tr>
                    <tr>
                        <th>District:</th>
                        <td><?php echo $basicDetails['district_name']; ?></td>
                        <th>Sub Division:</th>
                        <td><?php echo $basicDetails['subdiv_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Pin Code:</th>
                        <td><?php echo $basicDetails['pin_code']; ?></td>
                        
                    </tr>
                    <tr>
                        <th>Police Station:</th>
                        <td><?php echo $basicDetails['police_station']; ?></td>
                        <th>Phone Number of Police Station:</th>
                        <td><?php echo $basicDetails['ps_phone_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Nearest Railway Station:</th>
                        <td><?php echo $basicDetails['near_rail_station']; ?></td>
                        <th>Distance of Nearest Railway Station (in KM) :</th>
                        <td><?php echo $basicDetails['distance_rail_station']; ?></td>
                    </tr>
                    <tr>
                        <th>Principal / Officer in Charge:</th>
                        <td><?php echo $basicDetails['principal_name']; ?></td>
                        <th>Principal's Mobile Number :</th>
                        <td><?php echo $basicDetails['principal_mobile_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Principal's Age:</th>
                        <td><?php echo $basicDetails['principal_age']; ?></td>
                        <th>Qualification :</th>
                        <td><?php echo $basicDetails['principal_qualification']; ?></td>
                    </tr>
                    <tr>
                        <th>Year of experience:</th>
                        <td><?php echo $basicDetails['year_of_exp']; ?></td>
                        <th>Date of Joining  :</th>
                        <td><?php echo $basicDetails['principal_join_date']; ?></td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <?php //if($this->session->userdata('stake_id_fk') == 25){ ?>
                    <!-- <button type="button" class="btn btn-flat btn-block bg-navy" id="updateVtcEmailBtn">Update VTC
                        Details</button> -->
                <?php //}?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>