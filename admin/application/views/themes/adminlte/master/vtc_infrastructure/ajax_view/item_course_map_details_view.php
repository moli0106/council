<div class="row">
    <div class="col-md-12">
           
        <div class="box-body">
            <?php echo form_open('admin/master/infrastructure') ?>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="course_name_id">Course Name<span class="text-danger">*<span></label>
                        <select class="form-control" style="width: 100%;" name="course_name_id" id="course_name_id">
                            <option value="" hidden="true">Select Course Name</option>
                            <option value="1" <?php if($map_details['course_name_id_fk'] == 1){echo 'selected';} ?>>HS-Voc</option>
                            <option value="4"  <?php if($map_details['course_name_id_fk'] == 2){echo 'selected';} ?>>VIII+ STC</option>
                        </select>
                        <?php echo form_error('course_name_id'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Discipline <span class="text-danger">*<span></label>
                        <select class="form-control" style="width: 100%;" name="discipline_id" id="discipline_list">
                            <option value="" hidden="true">Select Discipline</option>
                            <?php foreach ($disciplineList as $value) {?>
                            <option value="<?php echo $value['discipline_id_pk']?>"
                            <?php if($map_details['discipline_id_fk'] == $value['discipline_id_pk']){echo 'selected';} ?><?php echo set_select('discipline_id' , $value['discipline_id_pk']); ?>>
                                <?php echo $value['discipline_name']?></option>
                            <?php }?>


                        </select>
                        <?php echo form_error('discipline_id'); ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Group/Trade <span class="text-danger">*<span></label>
                        <select class="form-control select2" style="width: 100%;" name="course_id" id="group_list">
                            <option value="">-- Select Group/Trade --</option>

                        </select>
                        <?php echo form_error('course_id'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="" for="">Infrastructure Item <span class="text-danger">*<span></label>
                    <select class="form-control select2" style="width: 100%;" multiple="multiple" name="item_id[]"
                        id="item_id">
                        <option value="">-- Select Infrastructure Item --</option>

                        <?php foreach ($infrastructureItem as $key => $item) { ?>
                        <option value="<?php echo $item['infrastructure_item_id_pk']; ?>"
                            <?php echo set_select('item_id[]', $item['infrastructure_item_id_pk']); ?>>
                            <?php echo $item['item_name']; ?>
                        </option>
                        <?php } ?>

                    </select>
                    <?php echo form_error('item_id[]'); ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="submit" class="btn btn-warning btn-block btn-flat"
                        name="mapInfrastructureWithCourse" value="2">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                        Map Infrastructure with Course
                    </button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
        
    </div>
</div>