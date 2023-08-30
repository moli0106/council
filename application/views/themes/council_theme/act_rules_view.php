<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>

<section class="inner-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="breadcrumb-box">
          <h2 class="breadcrumb-title">Acts & Rules</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Acts & Rules</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-title">Acts & Rules</h3>
        <div class="panel-white mtop40">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
	<tbody>
		<tr>
			<td style="width: 100px;">
			<strong>Sl No.</strong>
			</td>
			<td >
			<strong>Tital</strong>
			</td>
			<td >
			<strong><i class="text-center fa fa-download"></i></strong>
			</td>
			
		</tr>
		<tr>
			<td >
			1.
			</td>
			<td >
			Acts
			</td>
			<td >
			<a target="_blank" href="files/public/GOVT_ACTS.pdf" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></a>
			</td>
			
		</tr>
		<tr>
			<td >
			2.
			</td>
			<td >
			Rules
			</td>
			<td>
			<a target="_blank" href="files/public/GOVT_RULES.pdf" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></a>
			</td>
			
		</tr>
		
	</tbody>
</table>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>