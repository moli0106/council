<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>welcome </title>

</head>

<body>


    <table width="100%" style="border: 1px solid;" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="middle" align="left" width="20%" style="padding:10px;">
                <img width="250" height="80" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/logo.png">
                <!-- <img width="90" height="90" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>"> -->
            </td>
            <td align="center" style="font-family:arial; font-size:16px;line-height:0px;">
                <strong>WEST BENGAL STATE COUNCIL OF TECHNICAL & VOCATIONAL EDUCATION
                    & SKILL DEVELOPMENT</strong>
                <p valign="top" align="center" style="font-family:arial; font-size:12px;line-height:25px;padding-bottom:0px; border-bottom:0px solid #000;">
                    (A Statutory Body under Government of West Bengal Act XXVI of 2013)<br>
                    Technical Education Division<br>[Erstwhile West Bengal State Council of Technical Education]
                </p>
        </tr>
    </table>


    <table width="100%" style="border: 1px solid;">
        <tr>
            <td align="center">
                ACKNOWLEDGEMENT RECEIPT FOR <strong><?php echo $user_details[0]['exam_type_name']; ?>&nbsp;<?php echo $user_details[0]['registration_year']; ?></strong>
                <p style="font-size: 12px;"> Admission to Diploma Institutes <?php echo $user_details[0]['exam_type_name']; ?> in West Bengal for the Academic Session <?php echo $user_details[0]['registration_year']; ?><?php echo date("Y") ?>-<?php echo date('Y', strtotime('+1 year'));?></p></strong>
            </td>
        </tr>
    </table>
    <table width="100%" style="border: 1px solid;">
        <tr>
            <td colspan="2">Application Form No :<strong><?php echo $user_details[0]['application_form_no']; ?></strong></td>
            <td rowspan="6" align="middle" width="10%">
                <img class="img-responsive" style="height:100px; width:80px;border:1px solid;margin: 2px;padding: 2px" src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details[0]['picture'] ?>" alt=""><br>
                <img style="height:30px; width:80px; border:1px solid;margin: 2px;padding: 2px" src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details[0]['sign'] ?>" alt="">
            </td>
        </tr>
        <tr>
            <td colspan="2">Name Of Applicant :<strong><?php echo $user_details[0]['candidate_name']; ?></strong></td>
        </tr>
        <tr>
            <td width="50%">Mobile no: <strong><?php echo $user_details[0]['mobile_number']; ?></strong></td>
            <td width="40%">Email Id: <strong><?php echo $user_details[0]['email']; ?></strong></td>

        </tr>
        <tr>
            <td width="50%">Guardian's name :<strong><?php echo $user_details[0]['guardian_name']; ?></strong></td>
            <td width="40%">Gender :<strong><?php echo $user_details[0]['gender_description']; ?></strong></td>
        </tr>

        <tr>
            <td width="50%">Kanyashree :<strong><?php echo $user_details[0]['kanyashree']; ?></strong></td>
            <td width="40%">Kanyashree Unique Id :<strong><?php echo $user_details[0]['kanyashree_unique_id']; ?></strong></td>
        </tr>
        <tr>
            <td width="50%">Registration No (correspondence Qualification) :</td>
            <td width="40%"><strong><?php echo $user_details[0]['last_reg_no']; ?></strong></td>
        </tr>

    </table>
    <?php 
    If($user_details[0]['exam_type_id_fk']==8 ||$user_details[0]['exam_type_id_fk']==9||$user_details[0]['exam_type_id_fk']==3){ ?>
    <table width="100%" style="border: 1px solid;">
        <!-- <tr>
            <td colspan="2">Registration No (correspondence Qualification) :<strong><?php // echo $user_details[0]['last_reg_no']; ?></strong></td>
        </tr> -->

        
        <tr>
            <td>Qualification for Elegibility: <strong><?php echo $user_details[0]['qualification_name']; ?></strong></td>
            <td>Full Marks :<strong> <?php echo $user_details[0]['fullmarks']; ?></strong></td>


        </tr>

        <tr>
            <td width="50%">Marks Obtained :<strong><?php echo $user_details[0]['marks_obtain']; ?></strong></td>
            <td width="50%">Percentage : <strong><?php echo $user_details[0]['percentage']; ?></strong></td>

        </tr>
        <tr>
            <td width="50%">Year of Passing :<strong><?php echo $user_details[0]['year_of_passing']; ?></strong></td>
            <td width="50%" >Percentage of Marks &nbsp; <?php echo $user_details[0]['marks_subject1_corr_qualification']; ?> : <strong><?php echo $user_details[0]['thirdyr_or_physics_or_math_result']; ?></strong></td>
        </tr>
        <tr>
            <td width="50%">Percentage of Marks &nbsp; <?php echo $user_details[0]['marks_subject2_corr_qualification']; ?> : <strong><?php echo $user_details[0]['secondyear_or_chemistry_or_physicalscience_or_science_result']; ?></strong></td>
        
            <td width="50%">Percentage of Marks &nbsp; <?php echo $user_details[0]['marks_subject3_corr_qualification']; ?>: <strong><?php echo $user_details[0]['firstyear_or_hs_english_or_lifescience_result']; ?></strong></td>
        </tr>
    </table>
    <?php } ?>
    <table width="100%" style="border: 1px solid;">
        <tr>
            <td colspan="2">Category :<strong><?php echo $user_details[0]['caste_name']; ?></strong></td>

        </tr>
        <tr>
            <td width="50%">Physically Challenged (Handicapped) : <strong><?php echo $user_details[0]['handicapped']; ?></strong></td>
            <td width="50%">Religion :<strong> <?php echo $user_details[0]['religion_name']; ?></strong></td>
        </tr>
        <tr>
            <td width="50%">Date Of Birth :<strong><?php echo date('d-m-Y', strtotime($user_details[0]['date_of_birth'])); ?></strong></td>
            <td width="50%">Aadhar No : <strong><?php echo $user_details[0]['aadhar_no']; ?></strong></td>
        </tr>
    </table>

    <table width="100%" style="border: 1px solid;">
        <tr>
            <td colspan="2">
                <center><u>Address Information</u></center>
            </td>

        </tr>
        <tr>
            <td width="50%">Address : <strong><?php echo $user_details[0]['address']; ?></strong></td>
            <td width="50%">Police Station : <strong><?php echo $user_details[0]['police_station_name']; ?></strong></td>

        </tr>
        <tr>
            <td width="50%">District : <strong><?php echo $user_details[0]['district_name']; ?></strong></td>
            <td width="50%">State of Origin :<strong><?php echo $user_details[0]['state_name']; ?></strong></td>
        </tr>
        <tr>
            <td width="50%">Pincode : <strong><?php echo $user_details[0]['pincode']; ?></strong></td>
            <td width="50%">Nationality :<strong><?php echo $user_details[0]['nationality_name']; ?></strong></td>

        </tr>
    </table>

    <br>
    <br><br>
    <?php 
    If($user_details[0]['exam_type_id_fk']==8 ||$user_details[0]['exam_type_id_fk']==9||$user_details[0]['exam_type_id_fk']==3){ ?>
    <table width="100%" style="border: 1px solid;">

        <tr>
            <td align="center">

                <strong>Instructions</strong>
            </td>
        </tr>

    </table>
   
    <table width="100%" style="border: 1px solid;">

        <tr>
            <td>
            <section style="font-size: 12px;">He/She is directed to report to the Principal of the allotted Institute with the following documents for verification and admission.<strong><i> The candidate must report to and take admission in the concerned Institute within --.--.---- or before the revised date to be notified later, failing which this allotment will stand cancelled automatically.</i></strong><br><br>
    <section style="font-size: 12px;"><ol><li> Two copies of this Final Allotment Letter.</li>
   <li>One copy of recent passport size photograph.</li>
   <li> Admit Card of Madhyamik or equivalent examination or Birth Registration Certificate.</li>
   <li> Mark sheet and/or Certificate of Higher Secondary / equivalent examination in original.</li>
   <li>Pharmacy Entrance Admit Card.</li>
   <li> SC/ST Certificate in original (required if allotted through SC/ST quota only) issued by competent authority of the Government of West Bengal.</li>
   <li> Physically Challenged (PC) Certificate in original (required if allotted through PC quota only) issued by competent authority.</li>
   <li> A Medical Fitness Certificate obtained from a Registered Medical Practitioner / Medical Officer stating therein that the candidate has no
   colour blindness, he/she is physically and mentally fit to pursue technical course. The certificate should possess Signature, Stamp and
   Registration Number of the Registered Medical Practitioner / Medical Officer.</li>
   <li> Filled-in Anti Ragging Affidavit in the prescribed format. In Annexure-I, the student has to sign in two places under 'Signature of
   Deponent' and in Annexure-II, the parent/guardian has to sign in two places under 'Signature of Deponent'. The signature of "Oath
   Commissioner" should remain blank in both the annexures. These two affidavits are to be submitted in A4 size paper.</li>
   <li> The  photo copy of all the documents(1 set).</li>
   <li> Admission Fees, as applicable to Government & Government Sponsored / Private Institutions.</li></ol></section>
            </td>
        </tr>

    </table>
    <?php 
    } ?>


<?php 
  // If($user_details[0]['exam_type_id_fk']==1||$user_details[0]['exam_type_id_fk']==2||$user_details[0]['exam_type_id_fk']==4 ||$user_details[0]['exam_type_id_fk']==5||$user_details[0]['exam_type_id_fk']==6 ||$user_details[0]['exam_type_id_fk']==7){ ?>
   
   
    <!--<table width="100%" style="border: 1px solid;">

        <tr>
            <td>
            <section style="font-size: 12px;">You have successfully applied for <strong>JEXPO/VOCLET</strong> examination for admission in Polytechnics for the session 2023-2024.The Examination will be held on 6th May,2023.Admit card will be sent online 7 days before Examination.</section>
            </td>
        </tr>

    </table> -->
    <?php 
 //   } ?>
 <?php 
    If($user_details[0]['exam_type_id_fk']==1||$user_details[0]['exam_type_id_fk']==2||$user_details[0]['exam_type_id_fk']==4 ||$user_details[0]['exam_type_id_fk']==5||$user_details[0]['exam_type_id_fk']==6 ||$user_details[0]['exam_type_id_fk']==7){ ?>
 
   
    <table width="100%" style="border: 1px solid;">

        <tr>
            <td>
            <section style="font-size: 13px;">You have successfully applied for <strong>JEXPO/VOCLET</strong> examination for admission in Polytechnics for the session 2023-2024.<br>The Examination will be held on 6th May,2023.<br>Admit card will be sent online 7 days before Examination.</section>
            </td>
        </tr>

    </table>
    <?php 
    } ?>




</body>

</html>