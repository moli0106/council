<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<input type="hidden" id="exam-end-time" value="<?php echo $exam_end_time; ?>">

<div class="content-wrapper">
    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Online Exam</strong></h3>
                <div class="box-tools pull-right">
                    <div class="timer-countdown" id="timer-countdown"></div>
                </div>
            </div>
            <div class="box-body exam-question-body">
                <hr class="hr-1">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <button class="btn btn-shadow btn-flat">01</button> <span>Not attempted question</span>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <button class="btn btn-shadow btn-flat btn-active">01</button> <span>Current question selected</span>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <button class="btn btn-shadow btn-flat bg-purple">01</button> <span>Attempted question</span>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <button class="btn btn-shadow btn-flat bg-orange">01</button> <span>Mark for reviewing later</span>
                    </div>
                </div>
                <hr class="hr-1">

                <?php echo form_open('admin/assessor_exam_corner/online_exam/nextQuestion', array('id' => 'questionForm')) ?>

                <label for="">
                    <h2>Question <?php echo $question_no; ?>.</h2>
                    <p><?php echo $row['question']; ?></p>
                    <input type="hidden" name="question_no" id="question_no" value="<?php echo $question_no; ?>">
                    <input type="hidden" name="batch_id_hash" id="batch_id_hash" value="<?php echo $batch_id_hash; ?>">
                    <input type="hidden" name="next_question" id="next_question" value="0">
                    <input type="hidden" name="mark_for_review" id="mark_for_review" value="0">
                </label>

                <section class="question-section">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="radio" id="control_01" class="control_radio" name="answer" value="A" <?php if ($user_answer == 'A') echo 'checked'; ?>>
                            <label for="control_01">
                                <h2>A</h2>
                                <p><?php echo $row['option1']; ?></p>
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="radio" id="control_02" class="control_radio" name="answer" value="B" <?php if ($user_answer == 'B') echo 'checked'; ?>>
                            <label for="control_02">
                                <h2>B</h2>
                                <p><?php echo $row['option2']; ?></p>
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="radio" id="control_03" class="control_radio" name="answer" value="C" <?php if ($user_answer == 'C') echo 'checked'; ?>>
                            <label for="control_03">
                                <h2>C</h2>
                                <p><?php echo $row['option3']; ?></p>
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="radio" id="control_04" class="control_radio" name="answer" value="D" <?php if ($user_answer == 'D') echo 'checked'; ?>>
                            <label for="control_04">
                                <h2>D</h2>
                                <p><?php echo $row['option4']; ?></p>
                            </label>
                        </div>
                    </div>
                </section>

                <div class="overlay loader" style="display: none;">
                    <div class="sp sp-wave"></div>
                </div>

                <?php echo form_close() ?>

                <hr class="hr-1">

                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php for ($i = 1; $i <= count($pagination); $i++) { ?>

                            <?php
                            if ($question_no == $i) {
                                echo '<button class="btn btn-flat btn-shadow question-no-link btn-active">';
                            } elseif ($pagination[$i - 1] == 1) {
                                echo '<button class="btn btn-flat btn-shadow question-no-link bg-orange">';
                            } elseif ($pagination[$i - 1] == NULL) {
                                echo '<button class="btn btn-flat btn-shadow question-no-link">';
                            } else {
                                echo '<button class="btn btn-flat btn-shadow question-no-link bg-purple">';
                            }
                            echo sprintf("%02d", $i) . '</button>';
                            ?>

                            <?php if ($i % 20 == 0) echo '<br><br>'; ?>

                        <?php } ?>
                    </div>
                    <div class="col-md-12 text-center">
                        <hr class="hr-1">
                        <button class="btn bg-orange btn-flat btn-shadow mark-for-review">
                            <i class="fa fa-star" aria-hidden="true"></i> Mark for Review
                        </button>
                        <button class="btn bg-olive btn-flat btn-shadow save-question">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                        </button>

                        <button id="save-and-exit" class="btn bg-navy btn-flat btn-shadow save-and-exit" style="<?php if ($question_no != count($pagination)) echo 'display: none;' ?>">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            &nbsp; Final Submit &nbsp;
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    // The data/time we want to countdown to
    var jstime = document.getElementById("exam-end-time").value;
    var countDownDate = new Date(jstime).getTime();

    // Run myfunc every second
    var myfunc = setInterval(function() {

        var now = new Date().getTime();
        var timeleft = countDownDate - now;

        // Calculating the days, hours, minutes and seconds left
        var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

        if (minutes <= 2) {
            var x = document.getElementById("save-and-exit");
            if (x.style.display === "none") {
                x.style.display = "inline";
            }
        }

        // Result is output to the specific element
        document.getElementById("timer-countdown").innerHTML = hours + ":" + minutes + ":" + seconds;

        // Display the message when countdown is over
        if (timeleft < 0) {
            clearInterval(myfunc);
            document.getElementById("timer-countdown").innerHTML = "TIME UP!!";
            $('.loader').show();

            $.ajax({
                    url: "assessor_exam_corner/online_exam/examTimeUp",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        batch_id_hash: $("#batch_id_hash").val()
                    },
                })
                .done(function(res) {
                    window.open(res, "_self");
                })
                .fail(function() {
                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                });
        }
    }, 1000);

    var timeSinceLastMove = 0;

    $(document).mousemove(function() {

        timeSinceLastMove = 0;
    });

    $(document).keyup(function() {

        timeSinceLastMove = 0;
    });

    checkTime();

    function checkTime() {

        timeSinceLastMove++;

        if (timeSinceLastMove > 120) {
            window.location = "login/logout";
        }

        setTimeout(checkTime, 1000);
    }
</script>