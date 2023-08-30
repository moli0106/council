<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
     .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Zone wise Student Count</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Zone wise Student Count MIS</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Zone wise Student Count MIS <a href="<?php echo base_url('admin/spot_council/zone_student_count/std_count_report'); ?>"> <button type="button" class="btn btn-success" style="margin-left:1000px;">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        </button></a> </h3>
            </div>
            <div class="box-body">

          
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>District/Zone Name </th>
                            <th>No of Student in Prefered Zone 1</th>
                            <th>No of Student in Prefered Zone 2 </th>
                            
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1;
                            foreach ($pref_zone as $zone) {
                               
                            ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $zone['district_name'] ?></td>
                            <td><?php echo $zone['count1'] ?></td>
                            <td><?php echo $zone['count2'] ?></td>
                            
                           
                            <?php $i++;} ?>
                        </tr>
                        
                    </tbody>
                </table>
              
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


