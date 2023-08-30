<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}

.question-box {
    background-color: #fff;
    border: 4px solid #43A047;
    border-radius: 10px;
    border-top: none;
    border-bottom: none;
    padding: 5px 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
}

.question-box:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
</style>

<div class="box box-success">
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="header pull-left">
                            <i class="fa fa-university"></i>
                            Nearest VTC List
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <?php if ($nearest_vtc) {?>

            <?php foreach ($nearest_vtc as $key => $value) { ?>

                <?php 

                    $hs_group_code_name = '';
                    
                    if($value['hs_group_code_name'] != ''){
                        
                        foreach ($value['hs_group_code_name'] as $hs_name) {
                            $hs_group_code_name .= $hs_name['group_name'].' , ';
                        }
                    }


                    $viii_nqr_group_name = '';
                    
                    if($value['viii_nqr_group_name'] != ''){
                        foreach ($value['viii_nqr_group_name'] as $vii_name) {
                            $viii_nqr_group_name .= $vii_name['group_name'].' , ';
                        }
                    }
                

                    $viii_others_group_name = '';
                    
                    if($value['viii_others_group_name'] != ''){
                        foreach ($value['viii_others_group_name'] as $vii_other_name) {
                            $viii_others_group_name .= $vii_other_name['group_name'].' , ';
                        }
                    }
                ?>

                <div class="question-box">
                    <div class="row question-box-row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>VTC Name:</th>
                                    <td><?=$value['vtc_name'];?></td>
                                    <th>VTC Distance:</th>
                                    <td><?=$value['vtc_distance'];?></td>
                                </tr>
                                <tr>
                                    <th>Course Running in VTC:</th>
                                    <td>
                                        <?php if($value['hs_voc_courses'] == 1){echo 'HS-Voc';}?>
                                    </td>
                                    <th>Group/Trade Code Running in VTC:</th>
                                    <td>
                                        <?=$hs_group_code_name;?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Course Running in VTC:</th>
                                    <td><?php if($value['viii_nqr_courses'] == 2){echo 'VIII + NQR';}?></td>
                                    <th>Group/Trade Code Running in VTC:</th>

                                    <td><?=$viii_nqr_group_name;?> </td>
                                </tr>
                                <tr>
                                    <th>Course Running in VTC:</th>
                                    <td><?php if($value['viii_others_courses'] == 4){echo 'VIII + Others';}?></td>
                                    <th>Group/Trade Code Running in VTC:</th>
                                    <td><?=$viii_others_group_name;?> </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

            <?php } 
        }else{ ?>
            <span>No Data Found...</span>
        <?php } ?>

    </div>
</div>