<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>

<!-- jQuery library -->
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<div class="container">
	<div class="row">
		<h2>Create your snippet's HTML, CSS and Javascript in the editor tabs</h2>
	</div>
</div>
<section class="section">

    <!--Section heading-->
    <h2 class="section-heading h1 pt-4">Contact us</h2>
    <!--Section description-->
    <p class="section-description">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-8 col-xl-9">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form">
                            <input type="text" id="subject1" name="subject1" value="" class="form-control">
                            <input type='text' id='selectuser_ids' value=""/>
                            <label for="subject1" class="">Subject1</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form">
                            <input type="text" id="subject2" name="subject2" class="form-control">
                            <label for="subject2" class="">Subject2</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </form>

            <div class="center-on-small-only">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
            </div>
            <div class="status"></div>
        </div>
    </div>

</section>
<!--Section: Contact v.2-->
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
 
<script>
    $("#subject1").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "autocomplete/getsublist",
                type : "GET",
                dataType: "json",
                data: {
                    sub : request.term
                },
                success: function (data) {console.log(data);
                    response(data);
                  //response(data.id);
                }
            });
        },
        minLength: 3,        
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            $('.ui-helper-hidden-accessible').hide();
        },
        close: function () {
            // alert($(this).val());
            var ifsc_code = $(this).val().split(',');
            alert(ifsc_code);
            $(this).val(ifsc_code[0]);
            $('#selectuser_ids').val(ifsc_code[1]);
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            $('.ui-helper-hidden-accessible').hide();
        }
    });


</script>