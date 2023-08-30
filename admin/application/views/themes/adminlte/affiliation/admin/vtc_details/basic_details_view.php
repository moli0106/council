<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Basic Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <?php echo form_open('admin/affiliation/vtc/vtcEmailUpdate', array('id' => 'updateVtcEmail')) ?>
        <input type="hidden" name="vtc_details_id_hash" value="<?php echo md5($vtcDetails['vtc_details_id_pk']); ?>">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th width="15%">VTC Email:</th>
                        <td width="35%"><input type="email" name="vtc_email" class="form-control"
                                value="<?php echo $vtcDetails['vtc_email']; ?>"></td>
                        <th width="15%">HOI Name:</th>
                        <td width="35%"><?php echo $vtcDetails['hoi_name']; ?></td>
                    </tr>
                    <tr>
                        <th>HOI Designation:</th>
                        <td><?php echo $vtcDetails['hoi_designation']; ?></td>
                        <th>HOI email:</th>
                        <td><input type="email" name="hoi_email" class="form-control"
                                value="<?php echo $vtcDetails['hoi_email']; ?>"></td>
                    </tr>
                    <tr>
                        <th>HOI Mobile No.:</th>
                        <td><?php echo $vtcDetails['hoi_mobile_no']; ?></td>
                        <th>Type:</th>
                        <td>
                            <?php
                                if (!empty($vtcDetails['other_type'])) {
                                    echo $vtcDetails['other_type'];
                                } else {
                                    echo $vtcDetails['vtc_type_name'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Medium of Instruction:</th>
                        <td>
                            <?php
                                                        if (!empty($vtcDetails['other_medium'])) {
                                                            echo $vtcDetails['other_medium'];
                                                        } else {
                                                            echo $vtcDetails['medium_of_instruction'];
                                                        }
                                                        ?>
                        </td>
                        <th>Address:</th>
                        <td><?php echo $vtcDetails['vtc_address']; ?></td>
                    </tr>
                    <tr>
                        <th>District:</th>
                        <td><?php echo $vtcDetails['district_name']; ?></td>
                        <th>Sub Division:</th>
                        <td><?php echo $vtcDetails['subdiv_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Municipality:</th>
                        <td><?php echo $vtcDetails['block_municipality_name']; ?></td>
                        <th>Panchayat:</th>
                        <td><?php echo $vtcDetails['panchayat']; ?></td>
                    </tr>
                    <tr>
                        <th>Police Station:</th>
                        <td><?php echo $vtcDetails['police_station']; ?></td>
                        <th>Pin Code:</th>
                        <td><?php echo $vtcDetails['pin_code']; ?></td>
                    </tr>
                    <tr>
                        <th>Inst. Phone No.:</th>
                        <td><?php echo $vtcDetails['phone_no']; ?></td>
                        <th>Nodal:</th>
                        <td><?php echo $vtcDetails['nodal_centre_name']; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">Does the school have Higher Secondary or equivalent in regular section:</th>
                        <td><?php echo ($vtcDetails['hs_equivalent'] == 1) ? 'Yes' : 'No'; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">Does the school have Higher Secondary Science (Mathematics) in regular section:
                        </th>
                        <td><?php echo ($vtcDetails['hs_science'] == 1) ? 'Yes' : 'No'; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">Does the school have Higher Secondary Science (Biology) in regular section:</th>
                        <td><?php echo ($vtcDetails['hs_biology'] == 1) ? 'Yes' : 'No'; ?></td>
                    </tr>
                    <tr>
                        <th colspan="3">Does the school have Higher Secondary Commerce in regular section:</th>
                        <td><?php echo ($vtcDetails['hs_commerce'] == 1) ? 'Yes' : 'No'; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <?php if($this->session->userdata('stake_id_fk') == 25){ ?>
                    <button type="button" class="btn btn-flat btn-block bg-navy" id="updateVtcEmailBtn">Update VTC
                        Details</button>
                <?php }?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>