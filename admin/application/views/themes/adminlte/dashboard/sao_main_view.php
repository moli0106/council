<div class="row">
  <div class="col-md-12">    
    <div id="horizontalTab">
      
      <ul class="resp-tabs-list">
        <li>Assessor</li>
        <li>Sector & Course</li>
      </ul>

      <div class="resp-tabs-container">
        <div class="tab-box">
          
          <div class="counter-box box box-border">
            <div class="col-md-12">
              <h2>Assessor</h2>
              <div class="owl-carousel owlthumb">

                <div class="item">
                  <a href="javascript:void(0)">
                    <div class="tab-box-content bg-blue">
                      <h2><?=$assessor['pre_registration']?></h2>
                      <h4>No. of Pre-Registration</h4>
                    </div>
                  </a>
                </div>

                <div class="item">
                  <a href="javascript:void(0)">
                    <div class="tab-box-content bg-red">
                      <h2><?=$assessor['final_application']?></h2>
                      <h4>No. of Final Application</h4>
                    </div>
                  </a>
                </div>

                <div class="item">
                  <a href="javascript:void(0)">
                    <div class="tab-box-content bg-green">
                      <h2><?=$assessor['aproved_application']?></h2>
                      <h4>No. of Aproved Application</h4>
                    </div>
                  </a>
                </div>

                <div class="item">
                  <a href="#">
                    <div class="tab-box-content bg-navy">
                      <h2><?=$assessor['rejected_application']?></h2>
                      <h4>No. of Rejected Application</h4>
                    </div>
                  </a>
                </div>

              </div> 
            </div>
            <div class="clearfix"></div>
          </div>

        </div>
        <div class="tab-box">
          
          <div class="counter-box box box-border">
            <div class="col-md-12">
              <h2>Sector & Course</h2>
              <div class="owl-carousel owlthumb">

                <div class="item">
                  <a href="javascript:void(0)">
                    <div class="tab-box-content bg-blue">
                      <h2><?=$sector_course['sector_count']?></h2>
                      <h4>No. of Sectors</h4>
                    </div>
                  </a>
                </div>

                <div class="item">
                  <a href="javascript:void(0)">
                    <div class="tab-box-content bg-red">
                    <h2><?=$sector_course['course_count']?></h2>
                      <h4>No. of Courses</h4>
                    </div>
                  </a>
                </div>

              </div> 
            </div>
            <div class="clearfix"></div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>