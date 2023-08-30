<?php for ($i = 0; $i < $numberOfQuestionType; $i++) { ?>

        <div class="question-box">
            <div class="row question-box-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="">Questions Title/Heading <span class="text-danger">*<span></label>
                        <input type="text" class="form-control required" name="questions_title_heading[]" value="" placeholder="Enter Questions Title/Heading">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="">Question Category/Type [Marks] <span class="text-danger">*<span></label>
                        <select class="form-control required question-category-type" style="width: 100%;" name="question_type_marks[]" id="question_type_marks">
                            <option value="" hidden="true">Select Question Category/Type</option>
                            <?php if (!empty($questionTypeMarkList)) { ?>
                                <?php foreach ($questionTypeMarkList as $typeMarks) { ?>
                                    <option value="<?php echo $typeMarks['question_type_mark_id_pk']; ?>">
                                        <?php echo $typeMarks['question_type_name']; ?>
                                        [<?php echo $typeMarks['question_mark']; ?>]
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled="true">Select Question Code First...</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="no_of_question_set_id">No of Questions to be Set <span class="text-danger">*<span></label>
                        <select class="form-control required no-of-questions-to-be-set" name="no_of_question_set_id[]">
                            <option value="" hidden="true">Select No of Questions to be Set</option>
                            <?php if (!empty($questionToBeSetList)) { ?>
                                <?php foreach ($questionToBeSetList as $questionToBeSet) { ?>
                                    <option value="<?php echo $questionToBeSet['no_of_question_set_id_pk'] ?>" <?php echo set_select('no_of_question_set_id', $questionToBeSet['no_of_question_set_id_pk']); ?>>
                                        <?php echo $questionToBeSet['no_of_question_to_be_set']; ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled="true">No data found...</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="">No of Questions to be Attempt <span class="text-danger">*<span></label>
                        <select class="form-control required no-of-questions-to-be-attempt" name="question_attampt_id[]">
                            <option value="" hidden="true">Select No of Questions to be Attempt</option>
                            <?php if (!empty($questionToBeAttamptList)) { ?>
                                <?php foreach ($questionToBeAttamptList as $questionToBeAttampt) { ?>
                                    <option value="<?php echo $questionToBeAttampt['question_attampt_id_pk'] ?>" <?php echo set_select('no_of_question_answrerd_id', $questionToBeAttampt['question_attampt_id_pk']); ?>>
                                        <?php echo $questionToBeAttampt['no_of_question_attamp']; ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled="true">No data found...</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="marks_of_each_question_id">Marks of Each Questions <span class="text-danger">*<span></label>
                        <select class="form-control required marks-of-each-questions" name="marks_of_each_question_id[]">
                            <option value="" hidden="true">Select Marks of Each Questions</option>
                            <?php if (!empty($marksOfEachQuestionList)) { ?>
                                <?php foreach ($marksOfEachQuestionList as $marksOfEachQuestion) { ?>
                                    <option value="<?php echo $marksOfEachQuestion['marks_of_each_question_id_pk'] ?>" <?php echo set_select('marks_of_each_question_id', $marksOfEachQuestion['marks_of_each_question_id_pk']); ?>>
                                        <?php echo $marksOfEachQuestion['marks_of_each_question']; ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled="true">No data found...</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

<?php } ?>