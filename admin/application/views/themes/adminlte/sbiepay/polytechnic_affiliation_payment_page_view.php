<div class="panel-heading" style="
                                            height: 45px;
                                            font-size: 18px;
                                            background-color: #00a65a;
                                            color: #fff;
                                            display: flex;
                                        ">
    <span class="glyphicon glyphicon-circle-arrow-right" style="padding: 2px;"></span>
    Institute Code :
    <p style="
                                                position: relative;
                                                left: 5px;
                                                font-weight: bolder;
                                                font-family: monospace;
                                                font-size: 22px;
                                                bottom: 3px;
                                                color: #141313;
                                            ">
        <?php echo $details['institute_code']?>
        
    </p>


</div>
<div class="panel-body">

    <table class="table table-striped table-condensed">
        <thead>
            <tr style="font-size: 18px;">
                <th>Description</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Application Fee (Non - Refundable)</td>
                    <td><?php echo $details['application_fees'];?></td>
                </tr>
                <tr>
                  <td>Inspection Fee (Non-Refundable)</td>
                  <td><?php echo $details['inspection_fees'];?></td>
                </tr>
                
                <!-- <tr>
                  <?php if($details['new_or_renewal'] == 1){ ?>
                    <td>Affiliation Fees</td>
                  <?php }else{?>
                    <td>Renewal of Affiliation</td>
                  <?php }?>
                    <td><?php echo $details['affiliation_fees'];?></td>
                </tr> -->
                <?php //if($details['increse_course_amnt'] != 0) {?>
                <tr>
                  <td><?php echo $details['new_or_renewal'] ?> Affiliation Fees</td>
                  <td><?php echo $details['affiliation_fees'];?></td>
                </tr>
                <!-- <tr>
                  <?php if($details['new_or_renewal'] == 1){ ?>
                    <td>Affiliation Fees</td>
                  <?php }else{?>
                    <td>Renewal of Affiliation</td>
                  <?php }?>
                    <td><?php echo $details['affiliation_fees'];?></td>
                </tr> -->
                <?php if($details['increse_course_amnt'] != 0) {?>
                  <tr>
                    <td><?php echo $details['new_or_renewal'] ?> Affiliation Fee  (for Additional Course)</td>
                    <td><?php echo $details['increse_course_amnt'] ?></td>
                  </tr>
                <?php }?>
                  
                <?php if($details['increase_intake_amount'] != 0) {?>
                  <tr>
                    <td><?php echo $details['new_or_renewal'] ?> Affiliation Fee for Additional Intake ()</td>
                    <td><?php echo $details['increase_intake_amount'] ?></td>
                  </tr>
                <?php }?>
                
                    
                  <tr>
                    <th>Total Fees need to pay</th>
                    <th><?php echo $details['total_fees']; ?></th>
                </tr>
              
            </tbody>
    </table>


</div>