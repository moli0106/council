<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">&nbp;</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Notices and Circulars</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5 graybg">
    <div class="container">
        <h3 class="page-title"><strong>Publication</strong></h3>
        <div class="card border-secondary mb-3">
            <div class="card-header">Notices and Circulars List</div>
            <div class="card-body text-secondary">

                <?php echo form_open_multipart('notices_and_circulars/search', 'autocomplete="off"'); ?>
                <!-- <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="publication_type">
                                <option value="" hidden="true">Select Type</option>
                                <option value="All">All</option>
                                <?php foreach ($publication_type as $type) { ?>
                                    <option value="<?php echo $type['publication_type_id_pk']; ?>" <?php echo set_select('publication_type', $type['publication_type_id_pk']); ?>><?php echo $type['publication_type']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="keywords" placeholder="Title / Document No." value="<?php echo set_value('keywords'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="form-control pull-left calender_date" type="text" id="datepicker-13" name="published_date" value="<?php echo set_value('published_date'); ?>" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </div>
                    </div>
                </div> -->
                <?php echo form_close(); ?>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <!-- <th>Title</th> -->
                                    <!-- <th>Date</th> -->
                                    <th>Subject / Description</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0;
                                foreach ($publication_list as $key => $publication) { ?>
                                    <tr>
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $publication['publication_type']; ?></td>
                                        <!-- <td><?php echo $publication['publication_title']; ?></td> -->
                                        <!-- <td><?php echo date('d/m/Y', strtotime($publication['published_date'])); ?></td> -->
                                        <td style="width: 500px; text-align: justify; ">
                                            <?php echo $publication['publication_description']; ?>
                                        </td>
                                        <td class="text-center">
                                            <a target="_blank" href="notices_and_circulars/download/<?php echo md5($publication['publication_id_pk']); ?>">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>