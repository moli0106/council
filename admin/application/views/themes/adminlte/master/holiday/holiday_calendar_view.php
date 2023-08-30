<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<script>
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#external-events div.external-event').each(function() {

            var eventObject = {
                title: $.trim($(this).text())
            };

            $(this).data('eventObject', eventObject);
        });

        var holidayList = $('#holidayList').val();

        /* initialize the calendar */
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'prev,next',
            },
            editable: true,
            firstDay: 1,
            selectable: true,
            defaultView: 'month',
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {

                var startDate = start.getDate() + '-' + (start.getMonth() + 1) + '-' + start.getFullYear();
                var endDate = end.getDate() + '-' + (end.getMonth() + 1) + '-' + end.getFullYear();

                Swal.fire({
                    title: 'Enter Holiday Title',
                    input: 'text',
                    showCancelButton: true,
                    inputLabel: 'Holiday : ' + startDate + 'to' + endDate,
                    inputPlaceholder: 'Enter Holiday Name',
                    inputValidator: (title) => {
                        if (!title) {
                            return 'You need to write something!'
                        } else {
                            Swal.fire({
                                title: 'Are you sure, Save holiday?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, save it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                            url: "master/holiday_calendar/add_holiday",
                                            type: 'GET',
                                            dataType: "json",
                                            data: {
                                                "title": title,
                                                "start": start,
                                                "end": end,
                                            },
                                        })
                                        .done(function(response) {
                                            console.log(response);

                                            calendar.fullCalendar('renderEvent', {
                                                title: title,
                                                start: start,
                                                end: end,
                                                allDay: allDay
                                            }, true);
                                            calendar.fullCalendar('unselect');

                                            Swal.fire('Saved!', 'Holiday has been saved.', 'success');
                                        })
                                        .fail(function(res) {
                                            Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                        });
                                }
                            });

                        }
                    }
                });
            },
            droppable: false,

            events: [<?php echo $holidayList; ?>],
        });

        /* $(document).on('click', '.fc-event', funcyion() {
            alert('lll');
        }); */
    });
</script>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Holiday Calendar</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Holiday Calendar</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <!-- <input type="hidden" value="<?php echo $holidayList; ?>" id="holidayList"> -->

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Add Holiday</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">

                <div id='wrap'>
                    <div id='calendar'></div>

                    <div style='clear:both'></div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>