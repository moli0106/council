<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Other Common Laboratory</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <?php if(!empty($vtcHSCourseList)){?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Subject Name</th>
                        <th>Infrastructure item</th>
                        <th>Applicable Present</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                    if(count($commonLabData))
                                    {
                                        $i = $offset;
                                        foreach ($commonLabData as $key => $val) { ?>

                    <tr id="<?php echo md5($val['vtc_other_common_lab_id_pk']); ?>">
                        <td><?php echo ++$i; ?>.</td>
                        <td><?php echo $val['discipline_name']; ?> </td>
                        <td><?php echo $val['item_name']; ?> </td>
                        <td>
                            <?php if($val['applicable_present'] == 0){echo 'No';}else{echo 'Yes';} ?>
                        </td>
                        
                        <td>
                            <a href="<?php echo base_url('admin/vtc_infrastructure/common_laboratory/details/' . md5($val['vtc_other_common_lab_id_pk'])); ?>"
                                class="btn btn-xs btn-flat btn-info">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
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
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Not applicable as No H.S-Voc course is chosen
            </div>
        <?php } ?>
    </div>
</div>