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

<?php foreach ($question_details as $key => $question) { ?>

    <div class="question-box">
        <div class="row question-box-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Enter Question (Text) <span class="text-danger">*<span></label>
                    <textarea rows="3" style="width: 100%;" name="question[]" class="required"><?php echo $question['question']; ?></textarea>
                    <?php echo form_error('question'); ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Enter Clue/Answer (Text) <span class="text-danger">*<span></label>
                    <textarea rows="3" style="width: 100%;" name="question_clue[]" class="required"><?php echo $question['question_clue']; ?></textarea>
                    <?php echo form_error('question_clue'); ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="upload_file">Upload Equation Image <small>(Max size 100 KB)</small><span class="star">*</span></label>
                    <div class="input-group">
                        <input type="file" name="question_pic[]" class="form-control">
                        <?php echo form_error('question_pic'); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="">Image</label><br>
                    <?php if ($question['question_pic'] != NULL) { ?>
                        <a href="<?php echo base_url('admin/qbm/questions/eng_question_image/' . md5($question['eng_question_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                    <?php } else { ?>
                        <span class="text-danger"><i>No image found...</i></span>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="" for="">Question Marks <span class="text-danger">*<span></label>
                    <input type="number" class="form-control per-question-marks required" name="per_question_marks[]" value="<?php echo $question['per_question_marks']; ?>">
                    <?php echo form_error('per_question_marks'); ?>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <label>&nbsp;</label><br>
                <!-- <button type="button" class="btn btn-flat btn-sm btn-success"><i class="fa fa-file-text" aria-hidden="true"></i> Update Question</button> -->
            </div>
        </div>
    </div>

<?php } ?>