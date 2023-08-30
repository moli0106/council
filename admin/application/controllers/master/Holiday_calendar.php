<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holiday_calendar extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(76);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/holiday_calendar_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'holiday_calendar/fullcalendar.css',
            // 2 => $this->config->item('theme_uri') . 'holiday_calendar/holiday_calendar.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "holiday_calendar/fullcalendar.js",
            // 3 => $this->config->item('theme_uri') . "holiday_calendar/holiday_calendar.js",
        );
    }

    // ! View holiday calendar
    public function index()
    {
        $holidayList = array();

        $holidays = $this->holiday_calendar_model->getAllHoliday();

        foreach ($holidays as $key => $holiday) {

            $startDate = explode('-', $holiday['start_date']);
            $endDate   = explode('-', $holiday['end_date']);

            $holiday =  "
                {
                    title: '$holiday[title]', 
                    start: new Date($startDate[0], ($startDate[1] - 1), $startDate[2]), 
                    end: new Date($endDate[0], ($endDate[1] - 1), $endDate[2])
                }
            ";

            array_push($holidayList, $holiday);
        }

        $data = array(
            'holidayList' => implode(', ', $holidayList)
        );

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'master/holiday/holiday_calendar_view', $data);
    }

    // ! Add holiday to calendar
    public function add_holiday()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $title = $this->input->get('title');
            $start = $this->input->get('start');
            $end   = $this->input->get('end');

            if (!empty($title) && !empty($start) && !empty($end)) {

                $start = explode(' ', $start);
                $end   = explode(' ', $end);

                $startDate = date_format(date_create("$start[1]-$start[2]-$start[3]"), "Y-m-d");
                $endDate   = date_format(date_create("$end[1]-$end[2]-$end[3]"), "Y-m-d");

                $holidayArray = array(
                    'title'                => $title,
                    'start_date'           => $startDate,
                    'end_date'             => $endDate,
                    'entry_by_login_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip'             => $this->input->ip_address(),
                    'active_status'        => 1,
                );

                $result = $this->holiday_calendar_model->createHoliday($holidayArray);

                if ($result) {

                    echo json_encode($result);
                }
            }
        }
    }
}
