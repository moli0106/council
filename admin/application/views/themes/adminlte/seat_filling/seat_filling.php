<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style type="text/css">
    input{
       background: rgba(255,255,255,0.4)!important;
       border: none!important;
       box-shadow: none!important;
    }
    .bg-white{
    	background-color:white;
    }
    .ov{
    	height: 500px;
    	overflow: scroll;
    }
    .margin-top{
    	margin-top:15px;
    }
  </style>
<div class="container-fluid">
 <div class="content-wrapper">
    <section class="content-header">
        <h1>Student Choice Filling</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Choice Filling</li>
        </ol>
    </section>

  <div class="row mt-4 margin-top">


    <?php if ($this->session->flashdata('status')) { ?>
          <div class="alert alert-<?php echo $this->session->flashdata('message') == TRUE ? 'success' : 'danger'; ?>">
              <strong>Success!</strong> <?php echo $this->session->flashdata('message') ?>
          </div>
    <?php } ?>

                
    <div class="col-sm-6 shadow ov"> 
	      <table class="table table-striped bg-white mt-2" id="tbl_posts">
	        <thead>
	          <tr class="bg-info"> 
	            <th>SL</th>
	            <th>Institute Name</th>
	            <th>Course</th>
	            <th>Type</th>
	            <th>Choice</th>
	          </tr>
	        </thead>
	        <tbody id="sample_table">
	          <?php
              $i=1;
	          foreach($institute as $row){
	            ?>
	          <tr id='rec-<?php echo $row['vtc_id_pk'] ?>'>
	            <td><span class="sn"><?php echo $i++ ?></span>.</td>
	            <td><?php echo $row['vtc_name'] ?></td>
	            <td><?php echo $row['discipline_name'] ?></td>
	            <td><?php echo $row['category_name'] ?></td>
	            <td><a class="btn btn-xs add-record btn btn-success" data-id='<?php echo $row['vtc_id_pk'] ?>' data-institute='<?php echo $row['vtc_name'] ?>' data-course='<?php echo $row['discipline_name'] ?>' data-type='<?php echo $row['category_name'] ?>'>Add</a></td>
	          </tr>
	          <?php
	           }
	          ?>
	        </tbody>
	      </table>
    </div>
		<?php echo form_open_multipart("admin/seat_filling/std_seat_filling/save_filling_data", array('id' => 'choice-filling-form')); ?>
		  <div class="col-sm-6 ov">
            <h4><strong>Student Selected Institute</strong></h4>
		    <table class="table table-striped res bg-white" id="res">
		      <thead>
		          <tr class="bg-info">
		            <th>Priority</th>
		            <th>Institute Name</th>
		            <th>Course</th>
		            <th>Type</th>
		            <th>Choice</th>
		          </tr>
		        </thead>
		         <tbody id="tbl_posts_body">
		        </tbody>
		      </table>
		    </div>
		    <center>
        <?php if($save_status['final_submit'] == 0){ ?>
            <button type="submit" name="save" class="btn btn-info margin-top" value="Save">Save</button>&nbsp&nbsp

            
            <button type="button" name="save" class="btn btn-danger margin-top final_save_btn" value="Final Submit">Final Submit</button>
          <?php }?>
        </center>
		     <?php echo form_close() ?> 


        <?php //if($val['payment_status'] == 'Pending') {?>
          <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                
            <input type="hidden" value="<?php echo $student_id; ?>" name="insStdId">
            <input type="hidden" value="8" name="payment_type">
            <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
          <?php echo form_close() ?>
        <?php //}else{?>
          <!-- <a href=<?php echo base_url('admin/sbiepay/proceed_to_pay/download_payment_receipt'); ?>  class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download Receipt">Download Receipt</a> -->
        <?php //}?>

         <?php if($save_status['final_submit'] == 1){ ?>
            <a class="btn btn-primary" href="seat_filling/std_seat_filling/print_choice_data">Print</a>
          <?php }?>
      </div>
    </div> 
  </div>
<script type="text/javascript">
  $(document).ready(function(){
     jQuery(document).delegate('a.add-record', 'click', function(e) {
     e.preventDefault();    
     debugger;
       var count;
       var table = $('.res')[0];
       var rowCount = table.rows.length;
       var id=$(this).data('id');
       var institute=$(this).data('institute');
       var course=$(this).data('course');
       var type=$(this).data('type');
       var uniqueValues = [];
        var hasDuplicates = false;

        $('#tbl_posts_body tr').each(function() {
          var value = $(this).find('.p').attr('data-id');
         uniqueValues.push(value);
        });

        if ($.inArray(id.toString(), uniqueValues) !== -1 ) {
		  Swal.fire(
		  'Alert!',
		  'Opps! Institute already added',
		  'warning'
		  )
        }else{
       if(rowCount==1){
        count=1;
       }else{
        count=rowCount;
       }
       var rowHtml='<tr><td><input type="hidden" class="form-control p" data-id='+id+' name="priority[]" value="'+count+'" readonly><span class="sn">'+count+'<span></td>'
            +'<td>'+institute+'<input type="hidden" class="form-control" name="institute_id[]" value="'+id+'" readonly><input type="hidden" class="form-control" name="institute[]" value="'+institute+'" readonly></td>'
            +'<td>'+course+'<input type="hidden" class="form-control" name="course[]" value="'+course+'" readonly></td>'
            +'<td>'+type+'<input type="hidden" class="form-control" name="type[]" value="'+type+'"  readonly></td>'
            +'<td><a href="javascript:void(0)" type="button" value="Delete" onclick="deleteRow(this)" class="btn btn-xs btn btn-danger">Remove</a></td></tr>';


     $(rowHtml).appendTo("#tbl_posts_body");
    }

   });
  
  });

  /* This method will delete a row */
    function deleteRow(ele){
        var table = $('.res')[0];
        var rowCount = table.rows.length;
        if(rowCount <= 1){
            alert("There is no row available to delete!");
            return;
        }
        if(ele){
            //delete specific row
            $(ele).parent().parent().remove();
        }
        else{
            //delete last row
            table.deleteRow(rowCount-1);
        }
         //regnerate index number on table
    $('#tbl_posts_body tr').each(function(index){
    $(this).find('span.sn').html(index+1);
    });
    }

    //Onload
    jQuery(window).on("load", function(){
      $.ajax({
        url:"seat_filling/std_seat_filling/institute_fetch",
        type: "GET",
        success:function(data){
          result=JSON.parse(data);
          if(result.status=='success'){
            
          $.each(result.data, function(index, value){
            $("#tbl_posts_body").append('<tr><td><input type="hidden" class="form-control p" data-id='+value.institute_id+' name="priority[]" value="'+value.priority+'" readonly><span class="sn">'+value.priority+'<span></td>'
            +'<td>'+value.institute_name+'<input type="hidden" class="form-control" name="institute_id[]" value="'+value.institute_id+'" readonly><input type="hidden" class="form-control" name="institute[]" value="'+value.institute_name+'" readonly></td>'
            +'<td>'+value.course_name+'<input type="hidden" class="form-control" name="course[]" value="'+value.course_name+'" readonly></td>'
            +'<td>'+value.type+'<input type="hidden" class="form-control" name="type[]" value="'+value.type+'" readonly></td>'
            +'<td><a href="javascript:void(0)" type="button" value="Delete" onclick="deleteRow(this)" class="btn btn-xs btn btn-danger">Remove</a></td></tr>').slideDown();
        });

          }else if(result.status=='error'){
            alert('Opps Fetch');
          }
        },
        error:function(data) {
          alert('someting worng');
        }
      })
   });

   $(document).ready( function () {
    $('#tbl_posts').DataTable();
} );


</script>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>