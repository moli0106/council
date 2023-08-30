<!-- Small boxes (Stat box) -->
<div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo count($total_available_test); ?></h3>
              <p>Total Available Test</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_no_question[0]['count']; ?></h3>
              <p>Total no of questions uploaded</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bulb"></i>
            </div>
         </div>
        </div>
        <!-- ./col -->
        <!-- <div class="col-lg-4 col-xs-6">
          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if($highest_marks[0]['max'] == ''){echo 0;}else{echo $highest_marks[0]['max'];}?>
              </h3>
              <p>Highest Marks Secured</p>
            </div>
            <div class="icon">
              
            </div>
          </div>
        </div> -->
        <!-- ./col -->
 </div>
      
      
