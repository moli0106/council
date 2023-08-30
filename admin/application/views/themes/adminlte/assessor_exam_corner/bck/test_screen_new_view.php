<html>
<head>

	<base href="<?php echo base_url(); ?>admin/" />
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <title><?php echo $this->title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Extra CSS -->
  <!-- jQuery 3 -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
  <?php foreach($this->css_head as $hcss){ ?>
  <link rel="stylesheet" href="<?php echo $hcss; ?>">
  <?php } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/skins/_all-skins.css">
  
  <!-- For right click disable -->
    
    <script>
      window.oncontextmenu = function () {
        console.log("Right Click Disabled");
        return false;
      }
    </script>
    <!-- For right click disable -->

    <style>
      body {
        margin: 0;
        background: #e2e1e0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .header {
        padding: 10px 16px;
        background: #555;
        color: #f1f1f1;
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        margin-bottom: 10px;
      }

      .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 10px 16px;
        background-color: #555;
        color: #f1f1f1;
      }

      .question-body {
        border-radius: 5px;
        margin-top: 20px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      }
    </style>
  </head>

  <body onLoad="greetings();">
  
	<div class="footer">
      <div class="panel-body">
        <div class="row" style="font-weight:bold;">
          <div class="col-sm-3" style="font-family:calibri; font-size: 15px;">
            <button type="button" class="btn btn-primary btn-md" style="cursor:default;">01</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Questions not attempted yet.
          </div>
          <div class="col-sm-3" style="font-family:calibri; font-size: 15px;">
            <button type="button" class="btn btn-primary btn-md" style="cursor:default; background-color:#1A9545; border-color:#1A9545;">01</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attempted questions.
          </div>
          <div class="col-sm-3" style="font-family:calibri; font-size: 15px;">
            <button type="button" class="btn btn-primary btn-md" style="cursor:default; background-color: #f39c12; border-color:#f39c12;">01</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current question selected.
          </div>
          <div class="col-sm-3" style="font-family:calibri; font-size: 15px;">
            <button type="button" class="btn btn-primary btn-md" style="cursor:default; background-color: #605ca8; border-color:#605ca8;">01</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Question marked for reviewing later.
          </div>                    
        </div>
      </div>
    </div>
	
	<div class="header" id="myHeader">
      <div class="row">
        <div class="col-md-4">
          <h3>Council @ Assessor Assessment</h3>
        </div>
        <div class="col-md-4 text-center">
          <h3>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            Date : <?php echo date('d-m-Y',strtotime($examDetails[0]['end_date']));?>
          </h3>
        </div>
        <div class="col-md-4 text-right">
          <h3><i class="fa fa-clock-o" aria-hidden="true"></i> Time Left : <span id="timer_space"></span></h3>
        </div>
      </div>
    </div>

    <div class="container-fluid" id="wrap">
      
      <div class="panel question-body">
       
       
       <!-- question and options display space begins here... -->
       	
        <div class="panel-body">
            <table class="table table-borderless table-condensed table-hover">
              <tbody>
                    <tr>
                    	<td>
                        	<b>
                                <span id="serial_space"></span>&nbsp;.&nbsp;
                                <span id="question_space"></span>
                            </b>
                        </td>
					</tr>
                    
                    <tr>
                        <td style="border-style: none;">
                        <input type="radio"  class="options" id="option_1">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="option_1_"></span>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-style: none;">
                        <input type="radio"  class="options" id="option_2">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="option_2_"></span>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-style: none;">
                        <input type="radio"  class="options" id="option_3">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="option_3_"></span>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-style: none;">
                        <input type="radio"  class="options" id="option_4">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="option_4_"></span>
                        </td>
                    </tr>
            </tbody>
            </table>
            
          </div>
                     
        </div>
		
		<div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-default btn-sm" id="btn_previous_question" name="btn_previous_question" title="Previous Question" ><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;&nbsp;Previous Question</button>
          </div>

          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-default btn-sm" id="btn_next_question" name="btn_next_question" title="Next Question" >Next Question&nbsp;&nbsp;<i class="fa fa-forward" aria-hidden="true"></i></button>
          </div>

          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-default btn-sm" id="btn_review_question" name="btn_review_question" title="Review Question Later">Mark for Review.&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></button>
          </div>

          <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-danger btn-sm" id="btn_end_test" name="btn_end_test" title="Submit your exam">Save & End Test&nbsp;&nbsp;<i class="fa fa-hourglass-end" aria-hidden="true"></i></button>
          </div>
        </div>
        
        <div class="panel-heading">
			<table class="table">
            	<tbody>
                	<?php 
                            if(isset($row))
                            {
                                $index=0;
                                $_SESSION['pattern_key']=$random_keys;
                                $question_set = array();
                                $total_question = count($random_keys);
                                $questions_per_row = 25;
				$rows = ceil($total_question / $questions_per_row);
                            }
                            else
                            {
                               echo "Something went wrong"; exit(1);
                            }
                            
                            $counter = 1;
                            $index = 0;
                            for($i = 0; $i<round($rows); $i++)
                            {
                        ?>
                            <tr>
                        <?php 
                            for($j = 0;$j < $questions_per_row; $j++)
                            {
			?>
                                <td class="bg-default text-center">
                                    <button name="btn_<?php echo $counter; ?>" 
                                    class="btn btn-primary btn-md question" 
                                    id="<?php echo $counter.':'
                                    .$row[$random_keys[$index]]['question'].':'
                                    .$row[$random_keys[$index]]['option1'].':'
                                    .$row[$random_keys[$index]]['option2'].':'
                                    .$row[$random_keys[$index]]['option3'].':'
                                    .$row[$random_keys[$index]]['option4'].':'
                                    .$row[$random_keys[$index]]['question_id_pk'];?>">
                                    <?php echo str_pad($counter++,2,'0',STR_PAD_LEFT); ?>	
                                    </button>
                                </td>
                        <?php 
                            array_push($question_set,$row[$random_keys[$index]]['question_id_pk']);    // storing question unique number
                            $index++;
                            $total_question--;
										
                            if($total_question == 0)
                            {
                                    break;
                            }
                        }
                        ?>
                            </tr>
                    <?php
                    }
                        // assigning question number to arrays...
                        $_SESSION['question_set'] = $question_set;
                    ?>
                	</tbody>
            	</table>
            </div>
            
            <br><br>
            
            
        </div>
       
       <!-- question and options display space ends here... -->  
      </div>
    </div>
  </body>
  
<div class="modal fade in fade-flip" id="modal-endTest" style="display: none; padding-right: 16px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
            
			<div class="modal-body">
				<p style="text-align: center; font-family: calibri; font-size: 17px; font-weight: 500;">
                	<br>
                	You have chosen to end your test. Are you sure, you want to end your test ?
                </p>
                
               	<p style="text-align: center; font-family: calibri; font-size: 17px; font-weight: 500; color: red;" id="timer_space_modal"></p>
			</div>
            
			<div class="modal-footer">
            	   
            <?php 
                $attributes = array("name"=>"test_screen","id"=>"test_screen","autocomplete"=> "off"); // setting attributes of form
          	echo form_open('admin/assessor_exam_corner/online_exam/endTest/',$attributes);
            ?>
            
                
                
            	<button type="submit" class="btn btn-danger btn-md" id="btn_end_test" name="btn_end_test" title="Submit your test">
               	Yes, End my Test&nbsp;&nbsp;<i class="fa fa-hourglass-end" aria-hidden="true"></i></button>
                
                <button type="button" class="btn btn-default btn-sm pull-left" id="btn_no" name="btn_no" data-dismiss="modal">Cancel&nbsp;&nbsp;<i class="fa fa-ban" aria-hidden="true"></i></button>
                <input type="hidden" name ="total_question" id="total_question" value="<?php echo count($random_keys); ?>">              
                <input type="hidden" name ="response_marked" id="response_marked">
                <input type="hidden" name ="question_nos" id="question_nos">
				<input type="hidden" name ="batch_ems_id_pk" value="<?php echo md5($examDetails[0]['batch_ems_id_pk']); ?>">
                
            <?php 
                    echo form_close();
            ?>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<!-- modal for confirmation -->

<div class="modal fade in" id="modal-confirmation" style="display: none; padding-right: 16px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
            
			<div class="modal-body">
            <br><br>
            		<p align="center">
                    	<i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true" style="color: #E10000;"></i>
                    </p>
                    <br>
                    <dl style="text-align: justify; color:#E10000; font-family: calibri; font-size: 17px; text-transform:uppercase;">
                    <dt>Warning&nbsp;:</dt>
					<br>
                    <dd>1.	DO NOT press any key of your keyboard from now onwards until you end your test.</dd>

                    <dd>2.	The only use of the mouse is permissible in the test screen.</dd>

                    <dd>3.	The accidental or intentional key press will lead to abnormal termination of your exam.</dd>
                    </dl>
            	<br>
				<p style="text-align: center; font-family: Calibri; font-size: 16px; font-weight: 400;">
                	Start your test by clicking on the button <i>"Start Test"</i>.
                </p>
			</div>
            
			<div class="modal-footer">
            <p align="center">
            	<button type="button" class="btn btn-primary btn-md" id="btn_start_test" name="btn_start_test">Start Test&nbsp;&nbsp;<i class="fa fa-hourglass-start" aria-hidden="true"></i></button>
            </p>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>





<div class="modal fade in" id="modal-info_end_test" style="display: none; padding-right: 16px;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
            
			<div class="modal-body">
            <br>
            		<p style="text-align: center; color:#E10000; font-family: calibri; font-size: 18px; text-transform:uppercase;">
                    	<i class="fa fa-hand-paper-o fa-3x" aria-hidden="true" style="color: #E10000;"></i><br>STOP<br>
                        Your allotted time for the test is over. You test will end automatically  in<br>
                        <span id="timer_space_submit_test" style="color:#000; font-size: 18px;"></span> seconds.
                    </p>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
 <script src="<?php echo $this->config->item('theme_uri');?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Extra JS -->
<?php foreach ($this->js_foot as $jsf) {?>
<script src="<?php echo $jsf ?>"></script>
<?php } ?>
<!-- FastClick -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item('theme_uri');?>dist/js/adminlte.min.js"></script>



<script>

	var question_response = [];
	var question_nos = [];
	var mark_review = [];
	var track_current_question=null;
	
	// initializing elements of the array

	for(var i = 0; i<=$("#total_question").val(); i++)
	{
		question_response[i] = '0';
		question_nos[i] = '0';
		mark_review[i] = '0';
	}
	
	
	$(".question").click(function(e) {
		
		if(track_current_question == null)
		{
			track_current_question = $(this).attr("name");
			
			$(this).css("background-color","#f39c12");
			$(this).css("border-color","#f39c12");
		}
		else if(track_current_question != null)
		{
			var previous = track_current_question;
			
			track_current_question = $(this).attr("name"); 
			
			/*
				if previous question is attempted or not... or marked for review
			*/
			
			if(question_response[previous.substring(4)] != '0')
			{
				$("button[name='"+previous+"']").css("background-color",'#1A9545');
				$("button[name='"+previous+"']").css("border-color",'#1A9545');			
			}
			else if(mark_review[previous.substring(4)] != '0')
			{
				$("button[name='"+previous+"']").css("background-color",'#605ca8');
				$("button[name='"+previous+"']").css("border-color",'#605ca8');			
			}
			else
			{
				$("button[name='"+previous+"']").css("background-color",'');
				$("button[name='"+previous+"']").css("border-color",'');
			}	

			
			$(this).css("background-color","#f39c12");
			$(this).css("border-color","#f39c12");
			
			
		}
      
		$("input[type='radio']").prop('checked',false);
	
	
		var val = $(this).attr("id");
		var data = val.split(":");
	
		/*
		placing serial question and options in their respective place
		*/
		
		$("#serial_space").html(data[0]);
		$("#question_space").html(data[1]);
		$("#option_1_").html(data[2]);
		$("#option_2_").html(data[3]);
		$("#option_3_").html(data[4]);
		$("#option_4_").html(data[5]);
	
		$("input[type='radio']").attr("name",data[6]);
		
		question_nos[data[0]] = data[6]; // storing unique question no.
		
		
		
		//console.log(question_nos);
		
		var index = track_current_question.substr(4);

		if(question_response[index] != '0')
		{
			var value = question_response[index];		
			$("#"+value+"").prop('checked',true);
			
		}	   
    });
	
		/*
		code for moving forward in question queue...
	*/
	
	$("#btn_next_question").click(function(e) {
        
		// fetch the current question...
		var currentQ = track_current_question.substring(4);
		var nextQ = parseInt(currentQ) + 1;
		
		
		if(nextQ > $("#total_question").val())
		{
			nextQ = 1;
		}
		
		traverseQuestion("btn_"+nextQ);
    });
	
	
	$("#btn_previous_question").click(function(e) {

		var currentQ = track_current_question.substring(4);
		var prevQ = 0;

		if(parseInt(currentQ) == 1)
		{
			prevQ = parseInt($("#total_question").val());
		}
		else
		{
			prevQ = parseInt(currentQ) - 1;
                }
		traverseQuestion("btn_"+prevQ);
    });
		

	
</script>
<script>
  function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
      setInterval(function () {
          minutes = parseInt(timer / 60, 10);
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = minutes + ":" + seconds;

          if(timer == 0)
          {
			  $("#modal-endTest").modal('hide');
			  
			  $("#modal-info_end_test").modal({
			  		backdrop : "static",
					keyboard: false
			  });
			  var tenSeconds = 1 * 10;
    		  display = document.querySelector('#timer_space_submit_test');
			  startTimerTestSubmit(tenSeconds, display);
			  return;
		  }
          if (--timer < 0) 
          {
            clearInterval(timer);
          }
      }, 1000);
}


function startTimerTestSubmit(duration, display) {
    var timer = duration, minutes, seconds;
      setInterval(function () {
          minutes = parseInt(timer / 60, 10);
          seconds = parseInt(timer % 60, 10);

          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          display.textContent = minutes + ":" + seconds;

          if(timer == 0)
          {
			  $("#test_screen").submit();
			  return;
		  }
          if (--timer < 0) 
          {
            clearInterval(timer);
          }
      }, 1000);
}

function traverseQuestion(question_number)
{
		if(track_current_question == null)
		{
			track_current_question = question_number;
			
			$("button[name='"+question_number+"'").css("background-color","#f39c12");
			$("button[name='"+question_number+"'").css("border-color","#f39c12");
		}
		else if(track_current_question != null)
		{
			var previous = track_current_question;
			
			track_current_question = question_number; // change #1 
			
			/*
				if previous question is attempted or not... or marked for review
			*/
			
			if(question_response[previous.substring(4)] != '0')
			{
				$("button[name='"+previous+"']").css("background-color",'#1A9545');
				$("button[name='"+previous+"']").css("border-color",'#1A9545');			
			}
			else if(mark_review[previous.substring(4)] != '0')
			{
				$("button[name='"+previous+"']").css("background-color",'#605ca8');
				$("button[name='"+previous+"']").css("border-color",'#605ca8');			
			}
			else
			{
				$("button[name='"+previous+"']").css("background-color",'');
				$("button[name='"+previous+"']").css("border-color",'');
			}	
			/*
				setting color for the current button selected...
			*/
	
			$("button[name='"+question_number+"'").css("background-color","#f39c12");
			$("button[name='"+question_number+"'").css("border-color","#f39c12");

		}
      
		$("input[type='radio']").prop('checked',false);
	
	
		var val = $("button[name='"+question_number+"'").attr("id");
		var data = val.split(":");
	
		/*
		placing serial question and options in their respective place
		*/
		
		$("#serial_space").html(data[0]);
		$("#question_space").html(data[1]);
		$("#option_1_").html(data[2]);
		$("#option_2_").html(data[3]);
		$("#option_3_").html(data[4]);
		$("#option_4_").html(data[5]);
	
		$("input[type='radio']").attr("name",data[6]);
		
		question_nos[data[0]] = data[6]; // storing unique question no.
		
		//console.log(question_nos);
		
		var index = track_current_question.substr(4);
		
		if(question_response[index] != '0')
		{
			var value = question_response[index];
			
			$("#"+value+"").prop('checked',true);
		}	
}

window.onload = function () 
{
	
	document.addEventListener('contextmenu', event => event.preventDefault());
};
</script>



<script>

$("#modal-confirmation").modal({
		backdrop : "static",
		keyboard: false
});

$("#btn_start_test").click(function(e) {
        
		$("#modal-confirmation").modal('hide');
		launchIntoFullscreen(document.documentElement);
		setDefaultQuestion();
	    //var sixtyMinutes = 60 * 60;
    	var ninetyMinutes = 1*60;
    	display = document.querySelector('#timer_space');
		display1 = document.querySelector('#timer_space_modal');
	    startTimer(ninetyMinutes, display);
		startTimer(ninetyMinutes, display1);

    });
	
$(document).ready(function(e) {
	
	
	

	$(".options").change(function(e) {
		
		var value = $(this).attr("id");
		var name = track_current_question.substr(4);
		
		question_response[name] = value;
		
		$("button[name='"+track_current_question+"'").css("background-color","#1A9545");
		$("button[name='"+track_current_question+"'").css("border-color","#1A9545");

	});
	
	
	/*
		code to implpement mark for review later...
	*/
	
	$("#btn_review_question").click(function(e) {
		
		var name = track_current_question.substring(4);
		
		// inserting corresponding button at corresponding index
		
		
		if(question_response[name] != '0')
		{
			question_response[name] = '0';
		}
		mark_review[name] = track_current_question;
		
		$("button[name='"+track_current_question+"'").css("background-color","#605ca8");
		$("button[name='"+track_current_question+"'").css("border-color","#605ca8");
		
		//console.log(mark_review);
		
		
    });

});

$("#btn_end_test").click(function(e) {

	$("#response_marked").val(JSON.stringify(question_response));
	$("#question_nos").val(JSON.stringify(question_nos));
		
});


$("#btn_end_test_cnfrm").click(function(e) {

	$("#modal-endTest").modal({
		backdrop : "static",
		keyboard: false
	});
});




$(document).bind( "keyup keydown", function(e) {
	$("#test_screen").submit();
});

</script>


<script>

function setDefaultQuestion()
{

    var defaultQuestion = [];

    //console.log($("button[name='btn_1']").attr("id"));

    defaultQuestion = $("button[name='btn_1']").attr("id").split(":");
    //console.log(defaultQuestion);
    
    $("#serial_space").html(defaultQuestion[0]);
    $("#question_space").html(defaultQuestion[1]);
    $("#option_1_").html(defaultQuestion[2]);
    $("#option_2_").html(defaultQuestion[3]);
    $("#option_3_").html(defaultQuestion[4]);
    $("#option_4_").html(defaultQuestion[5]);
    $("input[type='radio']").attr("name",defaultQuestion[6]);
    
    question_nos[1] = defaultQuestion[6]; // storing unique question no.
    //console.log(question_nos);
    track_current_question = "btn_1";
    $("button[name='btn_1']").css("background-color","#f39c12");
    $("button[name='btn_1']").css("border-color","#f39c12");
}
</script>


<script>
function launchIntoFullscreen(element) {
	
  if(element.requestFullscreen) 
  {
    element.requestFullscreen();
  }
  else if(element.mozRequestFullScreen) 
  {
    element.mozRequestFullScreen();
  } 
  else if(element.webkitRequestFullscreen) 
  {
    element.webkitRequestFullscreen();
  } 
  else if(element.msRequestFullscreen) 
  {
    element.msRequestFullscreen();
  }
}

document.addEventListener('fullscreenchange', (event) => {
  if (document.fullscreenElement) {
	
  } else {
	$("#test_screen").submit();
  }
});
</script>