<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}

.question-box {
    background-color: #fff;
    border: 4px solid #43A047;
    border-radius: 10px;
    border-top: none;
    border-bottom: none;
    padding: 5px 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
}

.question-box:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
</style>

<div class="question-box">
    <div class="row question-box-row">
        <div class="col-md-12">
            <div class="card border-dark mb-3">
                <div class="card-header">
                    <h4>Size of each class room in sq ft</h4>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        <?php for ($i = 0; $i < $no_of_room; $i++) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Size of class room <?php echo $i+1;?><span
                                            class="text-danger"> (in Sq. Ft.)*</span></label>
                                    <input name="class_room_size[]" class="form-control" id="class_room_size" type="number"
                                        value="<?php if(!empty($classRoomData['room_size'])){echo $classRoomData['room_size'][$i]; }?>" step=".01">
                                        
                                        <?php echo form_error('class_room_size[]'); ?>
                                </div>
                            </div>

                        
                        <?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>