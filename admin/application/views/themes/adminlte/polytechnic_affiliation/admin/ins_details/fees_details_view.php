<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Library Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
        <?php if(!empty($fetch_fees_data)) {?>
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>#</th>
                <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <th>Management Quota *</th>
                <th>JEXPO Quota *</th>
                <th>VOCLET *</th>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>
                <th>Management Quota *</th>
                <th>Entrance Exam Quota *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <th>First Year *</th>
                <th>Second Year *</th>
                <th>Third Year *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <th>Semester-1 *</th>
                <th>Semester-2 *</th>
                <th>Semester-3 *</th>
                <th>Semester-4 *</th>
                <th>Semester-5 *</th>
                <th>Semester-6 *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <th>Sem–1 / 1st Year *</th>
                <th>Sem–2 / 2nd Year *</th>
                <th>Sem–3 / 3rd Year *</th>
                <th>Sem–4 / 4th Year *</th>
                <th>Semester-5 </th>
                <th>Semester-6 </th>
               <?php } ?>
              </tr>
               <?php foreach($fetch_fees_data as $row){ ?>
               <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-1" name="m_sem[]" value="<?php echo $row['m_sem'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-1" name="j_sem[]" value="<?php echo $row['j_sem'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-1" name="v_sem[]" value="<?php echo $row['v_sem'] ?>"></td>
               </tr>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>

                <tr>
                <td><?php echo $row['semester'] ?><input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]" value="<?php echo $row['part_1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]" value="<?php echo $row['part_2'] ?>"></td>
               </tr>
              <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–1" name="dvoc_s1[]" value="<?php echo $row['dvoc_s1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–2" name="dvoc_s2[]"  value="<?php echo $row['dvoc_s2'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–3" name="dvoc_s3[]"  value="<?php echo $row['dvoc_s3'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–4" name="dvoc_s4[]"  value="<?php echo $row['dvoc_s4'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dvoc_s5[]"  value="<?php echo $row['dvoc_s5'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dvoc_s6[]"  value="<?php echo $row['dvoc_s6'] ?>"></td>
               </tr>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?> 

               <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]"  value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="First Year Fees" name="1_year[]" value="<?php echo $row['1_year'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Second Year Fees" name="2_year[]" value="<?php echo $row['2_year'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Third Year Fees" name="3_year[]" value="<?php echo $row['3_year'] ?>"></td>
               </tr>
             <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–1 / 1st Year" name="dip_s1[]" value="<?php echo $row['dip_s1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–2 / 2nd Year" name="dip_s2[]" value="<?php echo $row['dip_s2'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–3 / 3rd Year" name="dip_s3[]" value="<?php echo $row['dip_s3'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–4 / 4th Year" name="dip_s4[]" value="<?php echo $row['dip_s4'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dip_s5[]" value="<?php echo $row['dip_s5'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dip_s6[]" value="<?php echo $row['dip_s6'] ?>"></td>
               </tr>
               <?php } ?>
              <?php } ?>
            </table>
          <?php }else{ ?>
             <table class="table table-bordered">
              <tr class="bg-primary">
                <th>#</th>
                <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <th>Management Quota *</th>
                <th>JEXPO Quota *</th>
                <th>VOCLET *</th>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>
                <th>Management Quota *</th>
                <th>Entrance Exam Quota *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <th>First Year *</th>
                <th>Second Year *</th>
                <th>Third Year *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <th>Semester-1 *</th>
                <th>Semester-2 *</th>
                <th>Semester-3 *</th>
                <th>Semester-4 *</th>
                <th>Semester-5 *</th>
                <th>Semester-6 *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <th>Sem–1 / 1st Year *</th>
                <th>Sem–2 / 2nd Year *</th>
                <th>Sem–3 / 3rd Year *</th>
                <th>Sem–4 / 4th Year *</th>
                <th>Semester-5 </th>
                <th>Semester-6 </th>
               <?php } ?>
              </tr>
               <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <tr>
                <td>Semester-1 <input type="hidden" required value="Semester-1" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-1" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-1" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-1" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-2 <input type="hidden" required value="Semester-2" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-2" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-2" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-2" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-3 <input type="hidden" required value="Semester-3" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-3" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-3" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-3" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-4 <input type="hidden" required value="Semester-4" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-4" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-4" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-4" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-5 <input type="hidden" required value="Semester-5" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-5" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-5" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-5" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-6 <input type="hidden" required value="Semester-6" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-6" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-6" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-6" name="v_sem[]"></td>
               </tr>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>

                <tr>
                <td>PART-I <input type="hidden" required value="PART_I" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]"></td>
               </tr>
               <tr>
                <td>PART-II <input type="hidden" required value="PART_II" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]"></td>
               </tr>

              <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <tr>
                <td>DVOC <input type="hidden" required value="DVOC" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–1" name="dvoc_s1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–2" name="dvoc_s2[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–3" name="dvoc_s3[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–4" name="dvoc_s4[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dvoc_s5[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dvoc_s6[]"></td>
               </tr>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?> 

               <tr>
                <td>HMCT <input type="hidden" required value="HMCT" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="First Year Fees" name="1_year[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Second Year Fees" name="2_year[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Third Year Fees" name="3_year[]"></td>
               </tr>
             <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <tr>
                <td>DIPLOMA <input type="hidden" required value="DIPLOMA" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–1 / 1st Year" name="dip_s1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–2 / 2nd Year" name="dip_s2[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–3 / 3rd Year" name="dip_s3[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–4 / 4th Year" name="dip_s4[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dip_s5[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dip_s6[]"></td>
               </tr>
               <?php } ?>
            </table>
          <?php } ?>
                
            
        </div>
    </div>
    </div>
</div>