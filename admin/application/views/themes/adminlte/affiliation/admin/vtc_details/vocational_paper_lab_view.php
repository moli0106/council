<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Vocational Paper Laboratory</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Group Name</th>
                    <th>Infrastructure item</th>
                    <th>Applicable Present</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                <?php
                                if(count($paperLabData))
                                {
                                    $i = $offset;
                                    foreach ($paperLabData as $key => $val) { ?>

                <tr id="<?php echo md5($val['vtc_vocational_paper_lab_id_pk']); ?>">
                    <td><?php echo ++$i; ?>.</td>
                    <td><?php echo $val['group_name']; ?> </td>
                    <td><?php echo $val['item_name']; ?> </td>
                    <td>
                        <?php if($val['applicable_present'] == 0){echo 'No';}else{echo 'Yes';} ?>
                    </td>
                    <!-- <td><?php echo $val['mentor_designation']; ?></td>
                                        
                                            <td>
                                                <?php if ($val['prd_image'] != NULL) { ?>
                                                <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64, <?php echo $val['prd_image'][0]; ?>" alt="Product Image" style="margin:0px;">
                                                <?php } else { ?>
                                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/no-product-image.png'); ?>" alt="Product Image" style="margin:0px;">
                                                <?php } ?>  
                                                
                                            </td> -->

                    <td>
                        <a href="<?php echo base_url('admin/affiliation/vtc/paperLabDetails/' . md5($val['vtc_vocational_paper_lab_id_pk'])); ?>"
                            class="btn btn-xs btn-flat btn-info">
                            <i class="fa fa-pencil" aria-hidden="true"></i> View
                        </a>
                    </td>
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
</div>