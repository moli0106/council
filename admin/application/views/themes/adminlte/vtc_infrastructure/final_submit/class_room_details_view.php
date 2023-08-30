<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Class Room Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <div class="row">

        <?php if (!empty($classRoomData)) { ?>
            <div class="col-md-10 col-md-offset-1">
                <strong><i class="fa fa-book margin-r-5"></i>Vocational courses</strong><br>

                <p class="text-muted">No of Class Room :  <strong><?php echo $classRoomData['no_of_room'];?></strong></p> 
                <?php if($classRoomData['room_size']!=''){?>
                    <h4>Size of each class room in sq ft</h4><hr>
                    <div class="row">
                        <?php for ($i = 0; $i < $classRoomData['no_of_room']; $i++) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Size of class room <?php echo $i+1;?></label>
                                    <input  class="form-control" id="class_room_size" type="text"
                                            value="<?php echo $classRoomData['room_size'][$i]; ?>" step=".01" readonly>
                                        
                                </div>
                            </div>
                        <?php }?>

                    </div>
                <?php }?>
                <hr>
                <strong><i class="fa fa-book margin-r-5"></i>Short Term Courses</strong><br>

                <p class="text-muted">No of lab / workshop :  <strong><?php echo $labSizeData['no_of_lab'];?></strong></p> 
                <?php if($labSizeData['lab_size']!=''){?>
                    <h4>Size of each Lab/Workshop in sq ft</h4><hr>
                    <div class="row">
                        <?php for ($i = 0; $i < $labSizeData['no_of_lab']; $i++) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Size of lab <?php echo $i+1;?></label>
                                    <input  class="form-control"  type="text"
                                            value="<?php echo $labSizeData['lab_size'][$i]; ?>" step=".01" readonly>
                                        
                                </div>
                            </div>
                        <?php }?>

                    </div>
                <?php }?>
            </div>

        <?php } else { ?>
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your class room details is not added  
                    <!-- for academic year<span
                        class="label label-success"><?php echo $academic_year; ?></span> -->
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>