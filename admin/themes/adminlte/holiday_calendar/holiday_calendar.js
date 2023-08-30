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
            right: 'prev,next'
        },
        editable: true,
        firstDay: 1,
        selectable: true,
        defaultView: 'month',

        axisFormat: 'h:mm',
        columnFormat: {
            month: 'ddd',
            week: 'ddd d',
            day: 'dddd M/d',
            agendaDay: 'dddd d'
        },
        titleFormat: {
            month: 'MMMM yyyy',
            week: "MMMM yyyy",
            day: 'MMMM yyyy'
        },
        allDaySlot: false,
        selectHelper: true,
        select: function(start, end, allDay) {
            Swal.fire({
                title: 'Enter Holiday Name / Title',
                input: 'text',
                showCancelButton: true,
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

        events: [holidayList],
    });
});