<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">District</h2>
                    <ol class="breadcrumb">
                       
                        <li class="breadcrumb-item active">District</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-5 pb-5">
    <div class="container">
	
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<select id="dist" class="form-control dist">
				  <option value="">-- Select District --</option>
				  
				  <?php foreach($dist_names as $dist_name){ ?>
				  <option value="<?php echo  $dist_name["district_id_pk"] ?>"><?php echo $dist_name["district_name"]; ?></option>
				  <?php } ?>
				</select>
			</div>
			<br/>
			<br/>
			<br/>
			
		</div>
        <?php if(count($dists)){?>
        <h3 class="text-center">Vocational Training Centres in <b><?php echo $dists[0]['district']; ?></b></h3>
		<div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Institute Name</th>
                    <th>Code</th>
                    <th>District</th>
                    <th>Institute Type</th>
                    <th>Address</th>
                    <th>Affiliated Year</th>
                    <th>VIII+</th>
                    <th>VIII+</th>
                    <th>VIII+</th>
                    <th>ADV VIII+</th>
                    <th>X+</th>
                    <th>X+2</th>
                    <th>X+2</th>
                    <th>VIII+ Count</th>
                    <th>ADV Count</th>
                    <th>X+ Count</th>
                    <th>X+2 Count</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($dists as $dist){ ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $dist['institute_name'] ?></td>
                    <td><?php echo $dist['vtc_code'] ?></td>
                    <td><?php echo $dist['district'] ?></td>
                    <td><?php echo $dist['institute_type'] ?></td>
                    <td><?php echo $dist['institute_address'] ?></td>
                    <td><?php echo $dist['eight_one'] ?></td>
                    <td><?php echo $dist['eight_two'] ?></td>
                    <td><?php echo $dist['eight_three'] ?></td>
                    <td><?php echo $dist['eight_advence'] ?></td>
                    <td><?php echo $dist['ten_one'] ?></td>
                    <td><?php echo $dist['twelve_one'] ?></td>
                    <td><?php echo $dist['twelve_two'] ?></td>
                    <td><?php echo $dist['twelve_three'] ?></td>
                    <td><?php echo $dist['viii_count'] ?></td>
                    <td><?php echo $dist['avd_count'] ?></td>
                    <td><?php echo $dist['x_count'] ?></td>
                    <td><?php echo $dist['x_2_count'] ?></td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
		</div>
        <?php } else { ?>
            
            <div class="alert alert-warning">
                No data found.
            </div>
            
        <?php } ?>
        
    </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>