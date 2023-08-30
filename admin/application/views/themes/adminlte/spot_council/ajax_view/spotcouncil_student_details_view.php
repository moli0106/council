<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PDF Details</title>
    <style type="text/css">
        #example2 {
            border: 1px solid;
            padding: 10px;
            box-shadow: 5px 5px #888888;
        }
    </style>

</head>


<body>
    <div>
    <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
            <?php echo $this->session->flashdata('validation_errors_list') ?>
        <?php } ?>
        
        <div id="example2" style="border: 1px solid;">
            <table width="100%" border="1" cellspacing="3px" style="font-size: 15px;">
                <?php // echo $search['student_details_id_pk']; 
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td rowspan="12" align="middle">
                        <img style="max-height:70px; max-width: 50px;" src="data:image/jpeg;charset=utf-8;base64,<?php echo $search['picture'] ?>"  alt="" ><br><br>
                        <img style="max-height:20px; max-width: 80px;" src="data:image/jpeg;charset=utf-8;base64,<?php echo $search['sign'] ?>"  alt="" >
                    </td>
                </tr>
                <tr>
                    <td>Application Form No:</td>
                    <td><?php echo $search['application_form_no']; ?></td>
                </tr>
                <tr>
                    <td>Name of the Candidate :</td>
                    <td><?php echo $search['candidate_name']; ?></td>
                </tr>
                <tr>
                    <td>Date of Birth: </td>
                    <td><?php echo  date('d-m-Y', strtotime($search['date_of_birth'])); ?></td>
                </tr>
                <tr>
                    <td>Guardian's Name:</td>
                    <td><?php echo $search['guardian_name']; ?></td>
                </tr>
                <tr>
                    <td>Mobile Number:</td>
                    <td><?php echo $search['mobile_number']; ?></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><?php echo $search['caste_name']; ?></td>
                </tr>
                <tr>
                    <td>Physically Challenged:</td>
                    <td><?php echo $search['handicapped']; ?></td>
                </tr>
                
               
            </table>
            <br />
            <div class="form-group" align="right">

                <?php //echo $college_id_hash;
                ?>
                <a href="<?php echo base_url('/admin/spot_council/vacent_college_list/student_details_pdf/' . md5($search['student_details_id_pk']) . '/' . $college_id_hash.'/'.$college_map_id); ?>"><button class="btn btn-info btn-sm" type="button"> Confirm</button></a>
            </div>
        </div>

    </div>



</body>

</html>