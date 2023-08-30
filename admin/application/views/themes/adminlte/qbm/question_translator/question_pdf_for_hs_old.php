<?php //echo "<pre>";print_r($questionList);?>
<!-- <table width="100%">
    
    <tr>
        <td>
            
            <p style="color: #1A237E;">
                <center>
                    <b style="font-size: 20px; font-weight: 700;">Course :</b> <span><?php echo $subject_name['course_name'];?></span><br>
                    <b style="font-size: 20px; font-weight: 700;">Subject : </b><span ><?php echo $subject_name['subject_name'];?> (<?php echo $subject_name['subject_code'];?>)</span><br>
                    <b style="font-size: 20px; font-weight: 700;">Semester :</b> <span><?php echo $semester_details['semester_name'];?></span><br>
                </center>
            </p>
        </td>
    </tr>
</table><br> -->
<div>
    <center>
        <b style="color: #1A237E;font-size: 20px; font-weight: 700;">Course     :</b><span> <?php echo $subject_name['course_name'];?></span><br>
        <b style="color: #1A237E;font-size: 20px; font-weight: 700;">Semester :</b> <span><?php echo $semester_details['semester_name'];?></span><br>
        <b style="color: #1A237E;font-size: 20px; font-weight: 700;">Subject    : </b><span ><?php echo $subject_name['subject_name'];?> (<?php echo $subject_name['subject_code'];?>)</span><br>
    </center>
</div><br><br>

<table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
    <tr style="background: #E1F5FE;">
        <th>#</th>
        <th>Question Type</th>
        <th>Details</th>
    </tr>
    <?php
    $count = 0;
    foreach ($questionList as $key => $list) {
        ++$count;
        if ($count % 2 == 0) $css = "#EEE";
        else $css = "#FFF";
    ?>
        <tr style="background: <?php echo $css; ?>;">
            <td align="center" style="width:5%"><?php echo $count; ?>.</td>
            <td style="width:20%">
                <!-- <strong>Semester : </strong><?php echo $list['semester_name']; ?> <br><br> -->
                <strong>Question Type : </strong><?php echo $list['question_type_name']; ?> <br><br>
            </td>
            <td>
                <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px; page-break-inside:avoid;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Questions Details</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($list['question_details'] as $details) { ?>
                            <tr>
                                <td align="center" style="width:5%"><?php echo ++$i; ?>.</td>
                                <td style="font-family:nikosh;">
                                    <b>Question:</b>
                                    <?php echo htmlentities($details['question']); ?><br>
                                    <?php if(!empty($details['question_pic'])){?>
                                         <img src="data:image/jpg;base64,<?php echo $details['question_pic']; ?>" style="width:300px;" />
                                    <?php } ?><br><br>
                                    <b>Question Clue: </b>
                                    <?php echo htmlentities($details['question_clue']); ?><br><br>
                                    <!-- Eng Answer/clue clue Image -->
                                    <?php if(!empty($details['answer_pic'])){?>
                                         <img src="data:image/jpg;base64,<?php echo $details['answer_pic']; ?>" style="width:300px;" />
                                    <?php } ?><br><br>
                                    <b>Bengali Question: </b>
                                    <?php echo htmlentities($details['beng_question']); ?><br><br>
                                    <?php if(!empty($details['beng_question_pic'])){?>
                                        <img src="data:image/jpg;base64,<?php echo $details['beng_question_pic']; ?>" style="width:300px;" />
                                    <?php } ?><br>
                                    <b>Bengali Question Clue: </b>
                                    <?php echo htmlentities($details['beng_question_clue']); ?><br><br>

                                    <!-- Beng Answer/clue Image -->
                                    <?php if(!empty($details['beng_answer_pic'])){?>
                                         <img src="data:image/jpg;base64,<?php echo $details['beng_answer_pic']; ?>" style="width:300px;" />
                                    <?php } ?><br><br>
                                    
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
</table>
