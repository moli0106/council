<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<!-- jQuery library -->
<!-- jQuery UI library -->
<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->

<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-teal";
            break;
        case 2:
            echo "bg-fuchsia";
            break;
        case 3:
            echo "bg-maroon";
            break;
        case 4:
            echo "bg-aqua";
            break;
        case 5:
            echo "bg-navy";
            break;
        case 6:
            echo "bg-yellow";
            break;
        case 7:
            echo "bg-orange";
            break;
        case 8:
            echo "bg-aqua";
            break;
        case 9:
            echo "bg-green";
            break;
        case 10:
            echo "bg-red";
            break;
        case 11:
            echo "bg-olive";
            break;
        case 12:
            echo "bg-teal";
            break;
        default:
            echo NULL;
    }
}
?>
<style>
    .list-group-item {
        padding: 5px 8px !important;
    }

    .modal-lg {
        width: 80% !important;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Course Selection</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Assessment Course Selection </li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-warning">
            <?php //echo'<pre>'; print_r($groupDetails); die;?>
            <div class="box-body">
                <?php echo form_open('admin/master/affiliation_group/updateCourseId'); ?>
                <div class="row">
                <div class="col-md-4">
                        <div class="form_group">
                        <label><b>Group Name:</b></label>
                        <input type="hidden" class="form-control" name="group_id_pk"  value="<?php echo $groupDetails['group_id_pk']; ?>" readonly>
                        <input type="text" class="form-control" name="group_name"  value="<?php echo $groupDetails['group_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                        <label><b>Assessment Couse Name:</b></label>
                        <input type="text" class="form-control" name="course_name" id="course_name" value="" >
                        <input type='text' id='course_id' name="course_id" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                        <label><b>Sector Name:</b></label>
                            <input type="text" class="form-control" id="sector_name" name="sector_name" placeholder="Sector Name" value="" readonly>
                            <input type='text' id='sector_id' name="sector_id" value=""/>
                        </div>
                    </div>
                    </div>

                   
                       <label for="captcha">&nbsp;</label><br>
                           <button type="submit" class="btn btn-warning pull-right">Submit</button>
            
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
     

       
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>    

<script>
    $("#course_name").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "master/affiliation_group/getCourseList",
                type : "GET",
                dataType: "json",
                data: {
                    sub : request.term
                },
                success: function (data) {
                    //console.log(data);
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
            alert($(this).val());
            var getdatastring = $(this).val();
            var ifsc_code = getdatastring.split('|');
            alert(ifsc_code);
            $(this).val(ifsc_code[0]);
            $('#course_id').val(ifsc_code[1]);
            $('#sector_name').val(ifsc_code[3]);
            $('#sector_id').val(ifsc_code[2]);
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            $('.ui-helper-hidden-accessible').hide();
        }
    });


</script>