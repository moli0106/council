<?php for ($i = 0; $i < $numberOfVtc; $i++) { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-dark mb-3">
                <div class="card-header">Nearby Existing Active VTC Details</div>
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name of Nearby Existing Active VTC <span class="text-danger">*</span></label>
                                <select name="nearbyExistingActiveVtc[]" class="form-control select2">
                                    <option value="" hidden="true">Select Nearby VTC</option>
                                    <?php foreach ($vtcMasterList as $key => $value) { ?>
                                        <option value="<?php echo $value['vtc_id_pk']; ?>">
                                            <?php echo $value['vtc_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Distance of The Nearby Active VTC <span class="text-danger">*</span></label>
                                <input id="" name="distancebyExistingActiveVtc[]" class="form-control" type="text" data-validation="required">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Course Running in VTC</label>
                                <select name="hsVocCourses[]" class="form-control vocationalCoursesbyExistingActiveVtc">
                                    <option value="" hidden="true">Select Running Courses</option>
                                    <option value="1">HS-Voc</option>
                                    <!-- <option value="2">VIII + NQR</option> -->
                                    <!-- <option value="4">VIII + Others</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Group/Trade Code Running in VTC</label>
                                <select name="hsVocCoursesGroupCode[<?php echo $i; ?>][]" class="form-control select2 groupCodebyExistingActiveVtc" multiple="true">
                                    <option value="" disabled="true">Select course first.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Course Running in VTC</label>
                                <select name="viiiNqrCourses[]" class="form-control vocationalCoursesbyExistingActiveVtc">
                                    <option value="" hidden="true">Select Running Courses</option>
                                    <!-- <option value="1">HS-Voc</option> -->
                                    <option value="2">VIII + NQR</option>
                                    <!-- <option value="4">VIII + Others</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Group/Trade Code Running in VTC</label>
                                <select name="viiiNqrCoursesGroupCode[<?php echo $i; ?>][]" class="form-control select2 groupCodebyExistingActiveVtc" multiple="true">
                                    <option value="" disabled="true">Select course first.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Course Running in VTC</label>
                                <select name="viiiOthersCourses[]" class="form-control vocationalCoursesbyExistingActiveVtc">
                                    <option value="" hidden="true">Select Running Courses</option>
                                    <!-- <option value="1">HS-Voc</option> -->
                                    <!-- <option value="2">VIII + NQR</option> -->
                                    <option value="4">VIII + Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Group/Trade Code Running in VTC</label>
                                <select name="viiiOthersCoursesGroupCode[<?php echo $i; ?>][]" class="form-control select2 groupCodebyExistingActiveVtc" multiple="true">
                                    <option value="" disabled="true">Select course first.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>