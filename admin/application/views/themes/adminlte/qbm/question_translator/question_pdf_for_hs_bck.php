<?php //echo "<pre>";print_r($questionList);?>
<table width="100%">
    
    <tr>
        <td>
            
            <p style="color: #1A237E;">
                <center>
                    <b style="font-size: 20px; font-weight: 700;">Course :</b> <span><?php echo $subject_name['course_name'];?></span><br>
                    <b style="font-size: 20px; font-weight: 700;">Subject : </b><span ><?php echo $subject_name['subject_name'];?> (<?php echo $subject_name['subject_code'];?>)</span>
                    
                </center>
            </p>
        </td>
    </tr>
</table><br>

<table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
    <tr style="background: #E1F5FE;">
        <th>#</th>
        <th>Semester</th>
        <th>Question Type</th>
        <th>Question</th>
        <th>Question Clue</th>
        <th>Bengali Question</th>
        <th>Bengali Question Clue</th>
        
    </tr>
    <?php
    $count = 0;
    foreach ($questionList as $key => $list) {
        ++$count;
        if ($count % 2 == 0) $css = "#EEE";
        else $css = "#FFF";
    ?>
    <?php foreach ($list['question_details'] as $details) {?>
        <tr style="background: <?php echo $css; ?>;">
            <td align="center"><?php echo $count; ?>.</td>
            <td style="font-size: 18px;"><?php echo $list['semester_name']; ?></td>
            <td style="font-size: 18px;"><?php echo $list['question_type_name']; ?></td>
            
            <td style="font-size: 18px;"><?php echo htmlentities($details['question']); ?><br>
                <?php if(!empty($details['question_pic'])){?>
                        <img src="data:image/jpg;base64,<?php echo $details['question_pic']; ?>" style="width:300px;" />
                <?php } ?>
            </td>
            <td style="font-size: 18px;"><?php echo htmlentities($details['question_clue']); ?></td>

            <td style="font-family:nikosh; font-size: 18px;"><?php echo htmlentities($details['beng_question']); ?><br>
                <?php if(!empty($details['beng_question_pic'])){?>
                        <img src="data:image/jpg;base64,<?php echo $details['beng_question_pic']; ?>" style="width:300px;" />
                <?php } ?>
            </td>
            <td style="font-family:nikosh; font-size: 18px;"><?php echo htmlentities($details['beng_question_clue']); ?></td>
            
            
        </tr>
    <?php }} ?>
</table>