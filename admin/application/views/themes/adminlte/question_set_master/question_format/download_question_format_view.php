<?php
function convert_number($number)
{
    if (($number < 0) || ($number > 99)) {
        throw new Exception("Number is out of range");
    }

    $result = "";
    $n = $number % 10;
    $deca = floor($number / 10);

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

    if ($deca || $n) {
        if (!empty($result)) {
            $result .= " and ";
        }
        if ($deca < 2) {
            $result .= $ones[$deca * 10 + $n];
        } else {
            $result .= $tens[$deca];
            if ($n) {
                $result .= "-" . $ones[$n];
            }
        }
    }
    if (empty($result)) {
        $result = "zero";
    }
    return $result;
}

function ConverToRoman($num)
{
    $n = intval($num);
    $res = '';

    $romanNumber_Array = array(
        'xl' => 40,
        'x'  => 10,
        'ix' => 9,
        'v'  => 5,
        'iv' => 4,
        'i'  => 1
    );

    foreach ($romanNumber_Array as $roman => $number) {
        $matches = intval($n / $number);
        $res .= str_repeat($roman, $matches);
        $n = $n % $number;
    }
    return $res;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td align="right"><?php echo $question_set['question_code']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td align="center"><?php echo $question_set['full_month_year']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td align="center">
                            <h3><strong><?php echo $question_set['subject_name']; ?></strong></h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>Time Allowed: <?php echo $question_set['time_allowed']; ?> Hours</td>
                        <td align="right">Full Marks: <?php echo $question_set['full_marks']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td align="center"><strong>Answer the following questions as directed.</strong></td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php $i = 0; ?>
        <?php foreach ($question_category_list as $key => $question_category) { ?>
            <tr>
                <td style="height: 20px;"></td>
            </tr>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="20px"><?php echo ++$i; ?>.</td>
                            <td>
                                <?php echo trim($question_category['question_heading']); ?>
                                <i>(Any <?php echo convert_number($question_category['no_of_question_attamp']); ?>)</i>
                            </td>
                            <td align="right" width="70px">
                                <?php echo $question_category['marks_of_each_question']; ?>
                                x
                                <?php echo $question_category['no_of_question_attamp']; ?>
                            </td>
                        </tr>

                        <!-- 11022022 START -->

                        <?php $k = 0; ?>
                        <?php foreach ($question_category['question_list'] as $key => $value) { ?>
                            <tr>
                                <td width="20px">&nbsp;</td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td width="20px" style="vertical-align:top;"><?php echo ConverToRoman(++$k); ?>)</td>

                                            <?php if(!isset($value['eng_lang_question'])) { ?>

                                                <td style="text-align: justify;">

                                                    <?php $j = 97; ?>
                                                    <?php foreach ($value as $key2 => $value2) { ?>

                                                        <table width="100%">
                                                            <tr>
                                                                <td width="20px" style="vertical-align:top;"><?php echo chr($j++); ?>)</td>

                                                                <td style="text-align: justify;">

                                                                    <?php echo htmlentities($value2['eng_lang_question']); ?>

                                                                    
                                                                    <?php if(!empty($value2['eng_lang_pics'])) { ?>
                                                                        <br>
                                                                        <img src="data:image/jpg;base64,<?php echo $value2['eng_lang_pics']; ?>" style="width:700px;" />
                                                                    <?php } ?>

                                                                </td>
                                                            </tr>
                                                        </table>

                                                    <?php } ?>
                                                
                                                </td>

                                            <?php } else { ?>
                                            
                                                <td style="text-align: justify;">
                                                    <?php echo htmlentities($value['eng_lang_question']); ?>
                                                    
                                                    
                                                    <?php if(!empty($value['eng_lang_pics'])) { ?>
                                                        <br>
                                                        <img src="data:image/jpg;base64,<?php echo $value2['eng_lang_pics']; ?>" style="width:700px;" />
                                                    <?php } ?>
                                                </td>
                                            
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </td>
                                <td width="70px">&nbsp;</td>
                            </tr>
                        <?php } ?>

                        <!-- 11022022 END -->
                    </table>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>