<!-- <div class="panel panel-default">
    <div class="panel-body text-center"><h3><?php echo $partner[0]['training_partner_organization_name'];?></h3></div>
  </div> -->
<table class="table table-hover table-bordered">
<div class="row">
	<div class="col-md-12">
    <ul class="list-group">
        <li class="list-group-item"><p class="mbotm20"><b>Question :</b> <?php echo $question[0]['question']; ?> </p>
        <?php if($question[0]['question_pattern']==2){?>
            <div class="imgcard">
                <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question[0]['question_pic']); ?>">
            </div>
        <?php }?>
        </li>
        <?php if($question[0]['option_pattern']==2) {?>
            <li class="list-group-item"><p class="mbotm20"><b>Option A :</b></p> <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question[0]['option1_pic']); ?>"></li>
            <li class="list-group-item"><p class="mbotm20"><b>Option B :</b></p> <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question[0]['option2_pic']); ?>"></li>
            <li class="list-group-item"><p class="mbotm20"><b>Option C :</b></p> <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question[0]['option3_pic']); ?>"></li>
            <li class="list-group-item"><p class="mbotm20"><b>Option D :</b></p> <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question[0]['option4_pic']); ?>"></li>
                
        <?php } else{?>
            <li class="list-group-item"><b>Option A :</b> <?php echo $question[0]['option1']; ?></li>
            <li class="list-group-item"><b>Option B :</b> <?php echo $question[0]['option2']; ?></li>
            <li class="list-group-item"><b>Option C :</b> <?php echo $question[0]['option3']; ?></li>
            <li class="list-group-item"><b>Option D :</b> <?php echo $question[0]['option4']; ?></li>
        <?php }?>
        <li class="list-group-item"><b>Correct Answer :</b> <?php echo $question[0]['right_answer']; ?></li>
    </ul>
	</div>

</div>

