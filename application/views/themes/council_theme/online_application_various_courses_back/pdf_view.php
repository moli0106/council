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
                 <img width="80" height="80" src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>">
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
        
           <strong> APPLICATION FORM FOR <?php echo $user_details[0]['course_name']; ?>&nbsp;<?php echo $user_details[0]['registration_year']; ?> <p style="font-size: 12px;">Joint Entrance Examination for Admission to Diploma Institutes (Engineering & Technology, Architecture)in West Bengal for the Academic Session 2022-2023</p></strong>
        
        </td>
    </tr>
    </table>
    <table width="100%" style="border: 1px solid;">
        <tr>
            <td colspan="2">Application Form No :<strong><?php echo $user_details[0]['application_form_no']; ?></strong></td>
            <td rowspan="6" align="middle">
                <img class="img-responsive" style="max-height:150px; max-width: 130px; border:1px solid;margin: 5px;padding: 15px"  src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details[0]['picture'] ?>" alt="">
            </td>
        </tr>
        <tr>
            <td colspan="2">Name Of Applicant :<strong><?php echo $user_details[0]['candidate_name']; ?></strong></td>
           
        </tr>
        <tr>
            <td>Mobile no: <strong><?php echo $user_details[0]['mobile_number']; ?></strong></td>
            <td>Email Id: <strong><?php echo $user_details[0]['email']; ?></strong></td>
            
        </tr>
        <tr>
            <td>Guardian's name :<strong><?php echo $user_details[0]['guardian_name']; ?></strong></td>
            <td>Gender :<strong><?php echo $user_details[0]['gender_description']; ?></strong></td>
        </tr>
        <tr>
            <td>Kanyashree :<strong><?php echo $user_details[0]['kanyashree']; ?></strong></td>
            <td>Kanyashree Unique Id :<strong><?php echo $user_details[0]['kanyashree_unique_id']; ?></strong></td>
        </tr>
        <tr>
            <td>Nationality :<strong><?php echo $user_details[0]['nationality_name']; ?></strong></td>
            <td>State of Origin :<strong><?php echo $user_details[0]['state_name']; ?></strong></td>
        </tr>
    </table>
    <table width="100%" style="border: 1px solid;">
         <tr>
            <td colspan="2">Category :<strong><?php echo $user_details[0]['caste_name']; ?></strong></td>
            <td rowspan="3" align="middle">
                <img style="max-height:40px; max-width: 130px; border:1px solid;margin: 5px;padding: 15px"  src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details[0]['sign'] ?>"alt="">
            </td>
        </tr>
        <tr>
            <td>Physically Challenged (Handicapped) : <strong><?php echo $user_details[0]['handicapped']; ?></strong></td>
            <td>Religion :<strong> <?php echo $user_details[0]['religion_name']; ?></strong></td>
        </tr>
        <tr>
            <td>Date Of Birth :<strong><?php echo date('d-m-Y',strtotime($user_details[0]['date_of_birth'])); ?></strong></td>
            <td>Adhar No : <strong><?php echo $user_details[0]['aadhar_no']; ?></strong></td>
        </tr>
    </table>

    <br>
    <br><br>
    <table width="100%" style="border: 1px solid;">

        <tr>
            <td>
            <section style="font-size: 12px;">
            <ol>
                <li>Check the Website www.webscte.co.in for notification regarding e-admit card for <?php echo $user_details[0]['course_name']; ?> Examination.</li>
                <li>e-admit card needs to be downloaded and instructions followed for <?php echo $user_details[0]['course_name']; ?> Examination.</li>
                <li>Appear for the <?php echo $user_details[0]['course_name']; ?> Examination.</li>
                <li>Check the Website www.webscte.co.in for the results of the <?php echo $user_details[0]['course_name']; ?> Examination.</li>
                <li>After Publication of the result, Counselling shall be held.</li>
                <li>All details of the Counselling shall be notified in the website www.webscte.co.in from time to time.</li>
            </ol>
            </td>
        </tr> 
   
    </table>

    
        
    
</body>

</html>