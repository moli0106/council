<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .card {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }

    .btn-div {
        display: flex;
        flex-wrap: wrap;
        justify-content: right;
        /* justify-content: space-around; */
        /* align-items: center; */
        /* align-content: center; */
    }

    .my-btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: transparent;
        border: 2px solid #e74c3c;
        border-radius: 0.6em;
        color: #e74c3c;
        cursor: pointer;
        display: flex;
        align-self: center;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1;
        margin: 20px;
        padding: 1.2em 2.8em;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: "Montserrat", sans-serif;
        font-weight: 700;
    }

    .btn-login {
        border-color: #0074e4;
        border-radius: 0;
        color: #0074e4;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: color 150ms ease-in-out;
    }

    .btn-login:after {
        content: "";
        position: absolute;
        display: block;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 100%;
        background: #0074e4;
        z-index: -1;
        transition: width 150ms ease-in-out;
    }

    .btn-login:hover {
        color: #fff;
    }

    .btn-login:hover:after {
        width: 110%;
    }

    .btn-reg {
        border-color: #f4822e;
        border-radius: 0;
        color: #f4822e;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: color 150ms ease-in-out;
    }

    .btn-reg:after {
        content: "";
        position: absolute;
        display: block;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 100%;
        background: #f4822e;
        z-index: -1;
        transition: width 150ms ease-in-out;
    }

    .btn-reg:hover {
        color: #fff;
    }

    .btn-reg:hover:after {
        width: 110%;
    }
</style>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Institute LOGIN</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Institute</a></li>
                        <li class="breadcrumb-item active">Affiliation Apply / Renewal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5">
    <div class="container">

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <h1 style="color: #fd7e14;">
                    <strong>
                        Vocational Training Centre
                    </strong>
                </h1>
                <hr>
                <div class="btn-div">
                    <a href="<?php echo base_url('admin'); ?>" target="_blank" class="my-btn btn-login">Institute Login</a>
                    <a href="<?php echo base_url('online_app/inst/vtc/affiliation/registration'); ?>" class="my-btn btn-reg">Institute Registration</a>
                </div>
                <i class="text-danger pull-right" style="margin-top: 35px;">* If you are already registered, Click Institute Login</i>
            </div>
        </div>
        <div style="height: 96px;"></div>

    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>