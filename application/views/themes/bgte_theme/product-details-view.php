<?php $this->load->view('themes/bgte_theme/layout/header'); ?>

<!--Course Details Area Start-->
<div class="course-details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="course-details-content">
                    <div class="single-course-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="overlay-effect img-product-details">
                                    <a href="#"><img src="data:image/jpeg;base64,<?php echo $product_details['image'][0]['product_image']; ?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-item-text">
                                    <h4><?php echo $product_details['product'][0]['product_name']; ?></h4>
                                    <div class="single-item-text-info">
                                        <span>By: <span><?php echo $product_details['product'][0]['mentor_name']; ?></span></span>
                                        <!-- <span>Date: <span>20.5.15</span></span> -->
                                    </div>
                                    <div class="course-text-content">
                                        <p><?php echo $product_details['product'][0]['product_desc']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Course Details Area-->

<!--Gallery Area Start-->
<div class="gallery-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>Product Image</h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <?php foreach ($product_details['image'] as $key => $image) { ?>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="gallery-img">
                    <div class="product-image">
                        <img src="data:image/jpeg;base64, <?php echo $image['product_image']; ?>" alt="">
                    </div>
                    <div class="hover-effect">
                        <div class="zoom-icon product-image-zoom">
                            <a class="popup-image" href="data:image/jpeg;base64, <?php echo $image['product_image'];?>"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        </div>
    </div>
</div>
<!--End of Gallery Area-->

<!--Gallery Area Start-->
<?php if($product_details['product'][0]['product_video']!= NULL) {?>
	<div class="gallery-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<video width="100%" height="500" controls>
					<source type="video/mp4" src="data:video/mp4;base64,<?php echo pg_unescape_bytea($product_details['product'][0]['product_video']); ?>">
					</video>
				</div>
			</div>
		</div>
	</div>
<?php }?>
<!--End of Gallery Area-->


<div class="course-details-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>Students</h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <?php foreach ($product_details['student'] as $key => $student) { ?>
            <div class="col-lg-3 col-md-12 col-12">
                <div class="sidebar-widget">
                    <div class="single-sidebar-widget">
                        <div class="tution-wrapper">
                        <div class="tution-fee">
                                <!-- <h1>$100</h1> -->
                            </div>
                            <div class="tutor-image">
                                <img src="data:image/jpeg;base64, <?php echo $student['student_photo']; ?>" alt="">
                            </div>
                            <div class="single-teacher-text">
                                <h3><a href="#"><?php echo $student['student_name']; ?></a></h3>
                                <h4>Student</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

           
        </div>
    </div>
</div>

<?php $this->load->view('themes/bgte_theme/layout/footer'); ?>