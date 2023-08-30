

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<style>
    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
    .ui-autocomplete {
        z-index:2147483647;
    }
</style>

<div class="row">
   

    <div class="box-body">
        <?php echo form_open('admin/master/affiliation_subject/add_full_subject') ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="">Full Subject Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="full_sub_name" id="full_sub_name" value="<?php echo set_value('full_sub_name');?>">
                    <?php echo form_error('full_sub_name'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="">Full Subject Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="full_sub_code" id="full_sub_code" value="<?php echo set_value('full_sub_code');?>">
                    <?php echo form_error('full_sub_code'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Subject1<span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="subject1" id="subject1" value="<?php echo set_value('subject1');?>">
                    <input type='hidden' name="subject1_code" id='subject1_code' value=""/>
                    <?php echo form_error('subject1'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Subject2<span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="subject2" id="subject2" value="<?php echo set_value('subject2');?>">
                    <input type='hidden' name="subject2_code" id='subject2_code' value=""/>
                    <?php echo form_error('subject2'); ?>
                </div>
            </div>

            
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-block btn-flat" id = "add_full_sub_btn">
                Create Full Subject
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>


<script>

    $("#subject1").autocomplete({
        source: function (request, response) {
            // alert("hi");
            $.ajax({
                url: "master/affiliation_subject/getsublist",
                type: "GET",
                dataType: "json",
                data: {
                    sub: request.term
                },
                success: function (data) {
                    console.log(data);
                    response(data);
                    //response(data.id);
                }
            });
        },
        minLength: 3,
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            $('.ui-helper-hidden-accessible').hide();
        },
        close: function () {
            
            // alert($(this).val());
            var sub_code = $(this).val().split(',');
            $(this).val(sub_code[0]);
            $('#subject1_code').val(sub_code[1]);
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            $('.ui-helper-hidden-accessible').hide();
        }
    });

    $("#subject2").autocomplete({
        source: function (request, response) {
            // alert("hi");
            $.ajax({
                url: "master/affiliation_subject/getsublist",
                type: "GET",
                dataType: "json",
                data: {
                    sub: request.term
                },
                success: function (data) {
                    console.log(data);
                    response(data);
                    //response(data.id);
                }
            });
        },
        minLength: 3,
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            $('.ui-helper-hidden-accessible').hide();
        },
        close: function () {
            // alert($(this).val());
            var sub_code = $(this).val().split(',');
            $(this).val(sub_code[0]);
            $('#subject2_code').val(sub_code[1]);
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            $('.ui-helper-hidden-accessible').hide();
        }
    });
</script>