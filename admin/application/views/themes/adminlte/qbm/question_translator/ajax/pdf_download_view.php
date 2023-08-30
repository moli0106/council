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

    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>



<?php echo form_open_multipart("admin/qbm/questions_qt/download_question_pdf_file"); ?>

    <label for="">Course Name: </label><span> <?php echo $subject_name['course_name'];?></span><br>
    <label for="">Subject Name: </label><span> <?php echo $subject_name['subject_name'];?> (<?php echo $subject_name['subject_code'];?>)</span>

    <input type="hidden" name="subject_id_hash" value="<?php echo md5($subject_name['subject_id_pk']);?>">

    <div class="">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="">Select Semester</label>
                    <select class="form-control required" name="qb_list_semester_id" >
                        <option value="" hidden="true">Select Semester</option>
                        
                        <?php foreach ($semesterList as $key => $value) { ?>
                            <option value="<?php echo $value['semester_id_pk']; ?>">
                                <?php echo $value['semester_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label></label>
                <button type="submit" class="btn btn-warning btn-block btn-flat" id="sem_pdf_dwn_btn">Download PDF</button>
            </div>

            
            
        </div>
    </div>


    




<?php echo form_close() ?>

