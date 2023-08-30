<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>VTC Details</title>

</head>
<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<body>

    <table width="100%">

        <tr>
            <td>

                <p style="color: #1A237E;">
                    <center>
                        <b style="font-size: 20px; font-weight: 700;">VTC Name :</b>
                        <span><?php echo $vtcDetails['vtc_name'];?></span><br>
                        <b style="font-size: 20px; font-weight: 700;">VTC Code :</b>
                        <span><?php echo $vtcDetails['vtc_code'];?></span><br>

                    </center>
                </p>
            </td>
        </tr>
    </table><br>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Basic Details</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <div class="col-xs-12 table-responsive">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <tr>
                    <th width="15%">VTC Email:</th>
                    <td width="35%"><?php echo $vtcDetails['vtc_email']; ?></td>
                    <th width="15%">HOI Name:</th>
                    <td width="35%"><?php echo $vtcDetails['hoi_name']; ?></td>
                </tr>
                <tr>
                    <th>HOI Designation:</th>
                    <td><?php echo $vtcDetails['hoi_designation']; ?></td>
                    <th>HOI email:</th>
                    <td><?php echo $vtcDetails['hoi_email']; ?></td>
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


    </div>

    <!-- Course Selection -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Course Selection</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
            <tr style="background: #E1F5FE;">
                <th>#</th>
                <th>Course Type</th>
                <th>Details</th>
            </tr>

            <tr style="background: <?php echo $css; ?>;">
                <td align="center" style="width:5%">1.</td>
                <td style="width:20%">

                    <strong>Course Type : </strong>HS-Voc <br><br>
                </td>
                <td>
                    <table width="100%" border="1" cellspacing="0px" cellpadding="4px"
                        style="font-size: 10px; page-break-inside:avoid;">
                        <thead>
                            <tr>
                                <th>Discipline</th>
                                <th>Course List</th>

                            </tr>

                        </thead>
                        <tbody>

                            <tr>
                                <?php if (isset($hsDiscipline)) { ?>
                                    <td>

                                        <?php $i = 0;
                                        foreach ($hsDiscipline as $key => $value) { ?>
                                        <strong><?php echo ++$i;?>.</strong><span
                                            class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?>,</span>
                                        <?php } ?>
                                        <br><br>
                                    </td>
                                    <td>
                                        <?php $i = 0;
                                        foreach ($hsCourseList as $key => $value) { ?>
                                        <strong><?php echo ++$i;?>.</strong><span
                                            class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>)</span>
                                        <?php } ?>
                                        <br><br>

                                    </td>
                                <?php }else{?>
                                    <td colspan="2">No Data Found</td>
                                <?php }?>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>

            <tr style="background: <?php echo $css; ?>;">
                <td align="center" style="width:5%">2.</td>
                <td style="width:20%">

                    <strong>Course Type : </strong>VIII+ STC <br><br>
                </td>
                <td>
                    <table width="100%" border="1" cellspacing="0px" cellpadding="4px"
                        style="font-size: 10px; page-break-inside:avoid;">
                        <thead>
                            <tr>
                                <th>Discipline</th>
                                <th>Course List</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td>

                                    <?php $i = 0;
                                    foreach ($stcDiscipline as $key => $value) { ?>
                                    <strong><?php echo ++$i;?>.</strong> <span
                                        class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?>,</span>
                                    <?php } ?>
                                    <br><br>
                                </td>
                                <td>
                                    <?php $i = 0;
                                    foreach ($stcCourseList as $key => $value) { ?>
                                    <strong><?php echo ++$i;?>.</strong> <span
                                        class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>),
                                    </span>
                                    <?php } ?>
                                    <br><br>

                                </td>

                            </tr>


                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

    </div>

    <!-- Teachers Details -->

    <div>
        <div class="box-header with-border">
            <h3 class="box-title">Teachers Details</h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0; ?>
                    <?php if (count($teacherList) > 0) { ?>
                    <?php foreach ($teacherList as $key => $value) { ?>
                    <tr id="<?php echo md5($value['teacher_id_pk']); ?>">
                        <td><?php echo ++$count; ?>.</td>
                        <td><?php echo $value['teacher_name']; ?></td>
                        <td><?php echo $value['mobile_no']; ?></td>
                        <td><?php echo $value['email_id']; ?></td>
                        <td>
                            <?php
                                if (!empty($value['designation_id_fk'])) {
                                    echo $value['designation_name'];
                                } else {
                                    echo $value['other_designation'];
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if (!empty($value['group_name'])) {
                                    echo $value['group_name'] . ' [' . $value['group_code'] . ']';
                                } else {
                                    echo $value['course_name'];
                                }
                            ?>
                        </td>

                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Student Details -->
    <div>
        <div class="box-header with-border">
            <h3 class="box-title">Student Details</h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course of the Year</th>
                        <th>Enrolled Student</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0; ?>
                    <?php if (count($studentCountDetails) > 0) { ?>
                    <?php foreach ($studentCountDetails as $key => $value) { ?>
                    <tr>
                        <td><?php echo ++$count; ?>.</td>
                        <td>
                            <b><?php echo $value['group_name']; ?></b>
                            (<?php echo $value['group_code']; ?>)
                        </td>
                        <td><?php echo $value['enrolled_student']; ?></td>

                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Vocational Paper Laboratory- -->

    <div>
        <div class="box-header with-border">
            <h3 class="box-title">Vocational Paper Laboratory</h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Group Name</th>
                        <th>Infrastructure item</th>
                        <th>Applicable Present</th>

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

    <!-- Other Common Laboratory -->

    <div>
        <div class="box-header with-border">
            <h3 class="box-title">Other Common Laboratory</h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Subject Name</th>
                        <th>Infrastructure item</th>
                        <th>Applicable Present</th>

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

                        
                    </tr>

                    <?php }
                                } else { ?>
                    <tr>
                        <td colspan="5" align="center" class="text-danger">No Data Found...</td>
                    </tr>

                    <?php }
                            ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Class Room Details -->

    <div>
        <div class="box-header with-border">
            <h3 class="box-title">Class Room Details</h3>
            <div class="box-tools pull-right"></div>
        </div>
        
        <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
            <tr style="background: #E1F5FE;">
                <th>#</th>
                <th>Course Type</th>
                <th>Room Size (sq ft)</th>
            </tr>

            <tr style="background: <?php echo $css; ?>;">
                <td align="center" style="width:5%">1.</td>
                <td style="width:20%">

                    <strong>Course Type : </strong>HS-Voc <br><br>
                    <strong>No of Room : </strong><?php echo $classRoomData['no_of_room'];?> <br><br>
                </td>
                <td>
                    <?php if($classRoomData['room_size']!=''){?>
                        <?php for ($i = 0; $i < $classRoomData['no_of_room']; $i++) { ?>
                                
                            <strong>room <?php echo $i+1;?> : </strong>
                            <?php echo $classRoomData['room_size'][$i]; ?> sq.ft ,
                                    
                        <?php }
                    }else{?>
                        <?php echo 'No Data Found..'?>
                    <?php }?>
                </td>
            </tr>

            <tr style="background: <?php echo $css; ?>;">
                <td align="center" style="width:5%">2.</td>
                <td style="width:20%">

                    <strong>Course Type : </strong>VIII+ STC <br><br>
                    <strong>No of Room : </strong><?php echo $labSizeData['no_of_lab'];?> <br><br>
                </td>
                <td>
                <?php if($labSizeData['lab_size']!=''){?>
                    <?php for ($i = 0; $i < $labSizeData['no_of_lab']; $i++) { ?>
                            
                        <strong>room <?php echo $i+1;?> : </strong>
                        <?php echo $labSizeData['lab_size'][$i]; ?> sq.ft ,
                                
                    <?php }
                }else{?>
                    <?php echo 'No Data Found..'?>
                <?php }?>
                </td>
            </tr>
        </table>
    </div>

    <!-- Other Infrastructure Details -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Other Infrastructure Details</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <div class="col-xs-12 table-responsive">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <tr>
                    <th width="35%">Electricity availability/Solar electricity:</th>
                    <td width="10%">
                        <?php echo $otherData['available_electricity'] == 1 ? "Yes" : "No"; ?>
                    </td>
                    <th width="35%">Availability of 3 phase supply:</th>
                    <td width="10%">
                        <?php if($otherData['available_electricity'] == 1){?>
                            <?php echo $otherData['phase3_supply'] == 1 ? "Yes" : "No"; ?>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <th>Internet Connection:</th>
                    <td><?php echo $otherData['internet_connect'] == 1 ? "Yes" : "No"; ?></td>
                    <th>Type of available connection:</th>
                    <td>
                        <?php if($otherData['internet_connect'] == 1){?>
                            <?php echo $otherData['connection_type_name']; ?>
                        <?php }?>
                    </td>
                </tr>
                
            </table>
        </div>


    </div>

    <!-- Computer Lab Data -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Computer Lab Data</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <div class="col-xs-12 table-responsive">
            <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                <tr>
                    <th width="35%"> Computer Lab Present:</th>
                    <td width="10%" colspan="3">
                        <?php echo $computerLabData['lab_present'] == 1 ? "Yes" : "No"; ?>
                    </td>
                    
                </tr>
                <?php if($computerLabData['lab_present'] == 1){?>
                    <tr>
                        <th>No of Computers:</th>
                        <td><?php echo $computerLabData['no_of_computer']; ?></td>
                        <th>No of Working Computers:</th>
                        <td>
                        
                            <?php echo $computerLabData['no_of_working_computer']; ?>
                        </td>
                    </tr>
                <?php }?>
                
            </table>
        </div>


    </div>

    <!-- Agriculture Discipline -->

    <?php if($agriDisciplineExist == 'yes'){?>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Agriculture Discipline Details</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="col-xs-12 table-responsive">
                <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
                    <tr>
                        <th width="35%">Pond:</th>
                        <td width="10%">
                            <?php echo $agriData['pond'] == 1 ? "Yes" : "No"; ?>
                        </td>
                        <th width="35%">Fish Cultivation done:</th>
                        <td width="10%">
                            <?php if($agriData['pond'] == 1){?>
                                <?php echo $agriData['fish_cultivation'] == 1 ? "Yes" : "No"; ?>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th>POULTRY SHED/FARM:</th>
                        <td><?php echo $agriData['poultry_shed'] == 1 ? "Yes" : "No"; ?></td>
                        <th>AVAILABILITY OF LIVE UNITS:</th>
                        <td>
                            <?php if($agriData['poultry_shed'] == 1){?>
                                <?php echo $agriData['poultry_live'] == 1 ? "Yes" : "No"; ?>
                            <?php }?>
                        </td>
                    </tr>

                    <tr>
                        <th>ANIMAL SHED:</th>
                        <td><?php echo $agriData['animal_shed'] == 1 ? "Yes" : "No"; ?></td>
                        <th>AVAILABILITY OF LIVE UNITS:</th>
                        <td>
                            <?php if($agriData['animal_shed'] == 1){?>
                                <?php echo $agriData['animal_live'] == 1 ? "Yes" : "No"; ?>
                            <?php }?>
                        </td>
                    </tr>

                    <tr>
                        <th>Cattle SHED:</th>
                        <td><?php echo $agriData['cattle_shed'] == 1 ? "Yes" : "No"; ?></td>
                        <th>AVAILABILITY OF LIVE UNITS:</th>
                        <td>
                            <?php if($agriData['cattle_shed'] == 1){?>
                                <?php echo $agriData['cattle_live'] == 1 ? "Yes" : "No"; ?>
                            <?php }?>
                        </td>
                    </tr>


                    <tr>
                        <th>Goat/Pig SHED:</th>
                        <td><?php echo $agriData['goat_shed'] == 1 ? "Yes" : "No"; ?></td>
                        <th>AVAILABILITY OF LIVE UNITS:</th>
                        <td>
                            <?php if($agriData['goat_shed'] == 1){?>
                                <?php echo $agriData['goat_live'] == 1 ? "Yes" : "No"; ?>
                            <?php }?>
                        </td>
                    </tr>

                    <tr>
                        <th>Compost Pit:</th>
                        <td><?php echo $agriData['compost_pit'] == 1 ? "Yes" : "No"; ?></td>
                        <th>No OF Pits:</th>
                        <td>
                            <?php if($agriData['compost_pit'] == 1){?>
                                <?php echo $agriData['no_of_pit']; ?>
                            <?php }?>
                        </td>
                    </tr>

                    <tr>
                        <th>Land:</th>
                        <td><?php echo $agriData['land'] == 1 ? "Yes" : "No"; ?></td>
                        <th width="10%">LAND Details:</th>
                        <td>
                            <?php if($agriData['land'] == 1){?>
                                <strong>Whether LAND IS FOR AGRICULTURE?: </strong><?php echo $agriData['agri_land'] == 1 ? "Yes" : "No"; ?><br><br>
                                <strong>Land Size : </strong><?php echo $agriData['land_size'];?> cottahs
                            <?php }?>
                        </td>
                        
                    </tr>
                    
                </table>
            </div>
        </div>
    <?php }?>

</body>

</html>