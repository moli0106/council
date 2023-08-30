<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="fullmark">Full Marks <span class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("fullmark") ?>" name="fullmark" id="fullmark"
                class="form-control" placeholder="fullmarks">

            <?php echo form_error('fullmark'); ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("marks_obtain") ?>" name="marks_obtain" id="marks_obtain"
                class="form-control" placeholder="Marks Obtain">

            <?php echo form_error('marks_obtain'); ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="percentage">Percentage % <span class="text-danger">*</span></label>
            <input type="number" name="percentage" id="percentage" value="<?php echo set_value('percentage') ?>"
                class="form-control" placeholder="Percentage">

            <?php echo form_error('percentage'); ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="cgpa">C.G.P.A <span class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("c_g_p_a") ?>" name="c_g_p_a" id="c_g_p_a"
                class="form-control" placeholder="C G P A" step=".01">

            <?php echo form_error('c_g_p_a'); ?>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="fullmark">Percentage of Marks (3rd yr (Diploma) / Physics / Mathematics / English) <span
                    class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("p_o_m1") ?>" name="p_o_m1" id="p_o_m1"
                class="form-control"
                placeholder="Percentage of marks (3rd yr Diploma / Physics / Mathematics / English)" step=".01">

            <?php echo form_error('p_o_m1'); ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="fullmark">Percentage of Marks (2nd yr (Diploma) / Chemistry / Physics or Science) <span
                    class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("p_o_m2") ?>" name="p_o_m2" id="p_o_m2"
                class="form-control" placeholder="Percentage of marks (2nd yr / Chemistry / Physics / Science)"
                step=".01">

            <?php echo form_error('p_o_m2'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="percentage">Percentage of Marks (1st yr (Diploma) / English(H.S) / Life Science or Biology /
                Mathematics) <span class="text-danger">*</span></label>
            <input type="number" name="p_o_m3" id="p_o_m3" value="<?php echo set_value('p_o_m3') ?>"
                class="form-control"
                placeholder="Percentage of Marks (1st yr / English(H.S) / Life Science or Science / Mathematics)"
                step=".01">

            <?php echo form_error('p_o_m3'); ?>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            <label for="fullmark">Name of the Institute <span class="text-danger">*</span></label>
            <input type="text" value="<?php echo set_value("institute_name") ?>" name="institute_name"
                id="institute_name" class="form-control" placeholder="Institute Name">

            <?php echo form_error('institute_name'); ?>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="fullmark">Year of Passing <span class="text-danger">*</span></label>
            <input type="number" value="<?php echo set_value("passing_year") ?>" name="passing_year" id="passing_year"
                class="form-control" placeholder="Passing Year">

            <?php echo form_error('passing_year'); ?>
        </div>
    </div>
</div>