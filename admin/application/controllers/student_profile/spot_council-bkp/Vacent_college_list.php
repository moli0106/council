<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vacent_college_list extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(153);
        $this->load->model('spot_council/spot_council_collegelist_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri') . "spot_council/vacent_college_list.js",
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
        );
    }
    public function index($offset = 0)
    {
       $count = count($this->spot_council_collegelist_model->get_college_list_map_count());
      

        $data['offset']         = $offset;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $config['base_url']         = 'spot_council/vacent_college_list/index/';
        $data["total_rows"] = $config['total_rows']       = $count;
        $config['per_page']         = 20;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['page_links']     = $this->pagination->create_links();


        $data['disciplines'] = $this->spot_council_collegelist_model->get_discipline();
        // $data['colleges'] = $this->spot_council_collegelist_model->get_college();
        // $data['vacent_colleges'] = $this->spot_council_collegelist_model->get_vacent_college_list();
        //    echo '<pre>'; print_r($data['vacent_colleges']); die;
        $data['college_list'] = $this->spot_council_collegelist_model->get_collegearray_list($config['per_page'], $offset);

         //echo '<pre>'; print_r($data['college_list']); die;

        //  $data['college_map_details'] = $this->spot_council_collegelist_model->get_college_map_details($data);

        // print_r($data['college_map_details']);

        $this->load->view($this->config->item('theme') . 'spot_council/vacent_college_list_view', $data);
    }


    // search by discipline caste //  
    public function search_discipline_college_map()
    {
        $discipline = $this->input->post('search_discipline');
        $college      = $this->input->post('search_college');
        // echo $discipline; 
        // echo $college;
        // die;
        // $this->session->set_flashdata('search_discipline', $discipline);
        // $this->session->set_flashdata('search_caste', $caste);

        if ($discipline || $college) {
            $data['offset'] = 0;
            $data['page_links'] = '';

            $data['disciplines'] = $this->spot_council_collegelist_model->get_discipline();
            $data['colleges'] = $this->spot_council_collegelist_model->get_college();
            $data['college_list'] = $this->spot_council_collegelist_model->search_vacent_college_list($discipline, $college);
            // echo "<pre>"; print_r($data['college_list']); die;
            $this->load->view($this->config->item('theme') . 'spot_council/vacent_college_list_view', $data);
        } else {
            redirect('admin/spot_council/vacent_college_list');
        }
    }

    public function get_spotcouncil_student($college_id_hash = null, $caste_id = null, $discipline_id_fk = null)
    {
        $data['college_id'] = $college_id_hash;
        $data['caste_id'] = $caste_id;
        $data['displine_id'] = $discipline_id_fk;
        $data['map_details_data'] = $this->spot_council_collegelist_model->college_map_details($college_id_hash, $caste_id, $discipline_id_fk);
        $data['college_map_id'] = $map_details_data['college_map_id_pk'];

        //   $college_map_id = print_r($data['mapcollege_details']); 


        // print_r($data['mapcollege_details']); die;
        $this->load->view($this->config->item('theme') . 'spot_council/spotcouncil_student_list_view', $data);
    }

    public function get_application_no()
    {
        $application_id_hash = $this->input->get('application_id_hash');
        $application_id = $application_id_hash;

        $data['search'] = $this->spot_council_collegelist_model->search_student_records($application_id);
        // echo '<pre>'; print_r($data); die;
        $data['college_id_hash'] = $this->input->get('college_id_hash');
        $data['college_map_id'] = $this->input->get('college_map_id');
        // echo '<pre>'; print_r($data); die;
        if ($data['search'] != '') {
            $html = $this->load->view($this->config->item('theme') . 'spot_council/ajax_view/spotcouncil_student_details_view', $data);
            echo json_encode($html);
        } else {

            echo 'fail';
            //   $message ='No data found for that searching enrollment';
            //   $html = $this->load->view($this->config->item('theme') . 'spot_council/ajax_view/spotcouncil_student_details_view', $data);
            //   echo json_encode($html);
        }
    }

    

    public function student_details_pdf($student_id_hash = NULL, $college_id_hash = NULL, $college_map_id = Null)

    {
        // echo $college_map_id . "<br>";exit;
        $data['get_college_details'] = $this->spot_council_collegelist_model->get_collge_details($college_id_hash, $college_map_id);
        // echo '<pre>';
        // print_r($data['get_college_details']);
        // die;
        $caste_id = $data['get_college_details']['caste_id_fk'];
        $clg_discipline_id_fk = $data['get_college_details']['discipline_id_fk'];

        
        $getPCVacancy = $this->spot_council_collegelist_model->get_collge_pCVacancy($college_id_hash, $clg_discipline_id_fk)['no_vacent_place'];
        //  echo $caste_id; die;
        $data['user_details'] = $this->spot_council_collegelist_model->generatePdf($student_id_hash)[0];

        //  echo '<pre>'; print_r($data['user_details']); die;
        $assign_student_caste = $data['user_details']['caste_id_fk'];
        // echo $assign_student_caste; die;

        $data['get_booking'] = $this->spot_council_collegelist_model->get_booking_details($student_id_hash);
        if (!empty($data['get_booking'])) {
            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! This Student allready assigned in another College, Please Choose another Student.');
            redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);

        } else {

            
            //gen pc check
            if (($caste_id == 6) && ($data['user_details']['pc_rank'] != NULL)) {
                //    echo "Booked PC";
                //     die;
                $student_pc_rank = $data['user_details']['pc_rank'];
                // echo '<pre>'; print_r($student_pc_rank); die;
                $pc_rank_array = $this->spot_council_collegelist_model->get_pc_rank_array();
                if ($student_pc_rank <= min($pc_rank_array)) {
                    // echo "hide";exit;
                    $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                } else {

                    $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                   
                }
                // echo '<pre>'; print_r($pc_rank_array); die;
                
            } else if (($caste_id == 1) && ($assign_student_caste == 1 || $assign_student_caste == 2 || $assign_student_caste == 3) && ($data['user_details']['pc_rank'] != NULL)) {  //check gen-pc

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! this PC student can not be admitted on genaral sheet.');
                redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
            }
            //only gen st sc admission on general sheet
            else if (($caste_id == 1) && ($assign_student_caste == 1 || $assign_student_caste == 2 || $assign_student_caste == 3) && ($data['user_details']['pc_rank'] == NULL)) {
                // echo "Booked General";

                // check general rank
                $student_general_rank = $data['user_details']['general_rank'];
                $general_rank_array = $this->spot_council_collegelist_model->get_general_rank_array();

                if ($student_general_rank <= min($general_rank_array)) {

                    $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                } else {

                    $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                }
            } else if ($caste_id != 1 && $assign_student_caste == 1) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! this general student can not be admitted on other than genaral sheet.');
                redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
          
            } else if ($caste_id == 2) {

                $sc_rank_array = $this->spot_council_collegelist_model->get_sc_rank_array();
                //  echo '<pre>'; print_r($sc_rank_array); die;

                if (($assign_student_caste == 2  && ($data['user_details']['pc_rank'] == NULL))) {
                    // sc check
                    // echo "Book sc"; die;
                    $student_sc_rank = $data['user_details']['sc_rank'];

                    if ($student_sc_rank <= min($sc_rank_array)) {

                        $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                    }
                    
                    else {
                       $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                    }
                }else if(($assign_student_caste == 2) && ($data['user_details']['pc_rank'] != NULL)){
                    if($getPCVacancy == 0){

                        $student_sc_rank = $data['user_details']['sc_rank'];
                        if ($student_sc_rank <= min($sc_rank_array)) {
    
                            $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                        }
                        else {
                            $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                        }

                    }else{

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! PC sheets still now available.');
                        redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
              
                    }

                }
                 else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! this other than SC student can not be admitted on Sc sheet.');
                    redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
          
                }
            } else if ($caste_id == 3) {
                $st_rank_array = $this->spot_council_collegelist_model->get_st_rank_array();

                if (($assign_student_caste == 3 )  && ($data['user_details']['pc_rank'] == NULL)) {
                    // st check
                    // echo "Book st"; die;
                    $student_st_rank = $data['user_details']['st_rank'];

                    
                    //  echo '<pre>'; print_r($sc_rank_array); die;

                    if ($student_st_rank <= min($st_rank_array)) {

                        $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                    } else {
                        $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                    }
                } 

                else if(($assign_student_caste == 3) && ($data['user_details']['pc_rank'] != NULL)){
                    if($getPCVacancy == 0){

                        $student_st_rank = $data['user_details']['st_rank'];
                        if ($student_st_rank <= min($st_rank_array)) {

                            $this->get_student_allotment_letter($data, $student_id_hash, $college_id_hash, $college_map_id, $caste_id);
                        } else {
                            $this->responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk);
                        }

                    }else{

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! PC sheets still now available.');
                        redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
              
                    }

                }
                else {
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! this other than ST student can not be admitted on ST sheet.');
                    redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
          
                }
            }else{

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! citeria not fullfil.');
                redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
          
            }
        }
    }

    public  function responseForPreviousRank($college_id_hash,$assign_student_caste,$clg_discipline_id_fk){
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('alert_msg', 'Oops! Please wait for previous Rank student.');
        // redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash);
        redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);


    }

    public function get_student_allotment_letter($data, $student_id_hash = NULL, $college_id_hash = NULL, $college_map_id = Null, $caste_id)
    {
        // echo "ii";
        // echo $college_map_id . "<br>";
        // echo $student_id_hash . "<br>";
        // exit;
        $get_colg_vacancy_details = $this->spot_council_collegelist_model->get_collge_details($college_id_hash, $college_map_id);
        $clg_discipline_id_fk = $data['get_college_details']['discipline_id_fk'];
        $data['user_details'] = $this->spot_council_collegelist_model->generatePdf($student_id_hash)[0];
        $assign_student_caste = $data['user_details']['caste_id_fk'];

        if($get_colg_vacancy_details['no_vacent_place'] == 0){
            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! Sheets are not available.');
            redirect('admin/spot_council/vacent_college_list/get_spotcouncil_student/' . $college_id_hash .'/'. $assign_student_caste.'/'.$clg_discipline_id_fk);
        }else{

        $this->db->trans_start();  # Starting Transaction

        $data['college_student_map'] = array(

            'student_details_id_fk' => $data['user_details']['student_details_id_pk'],
            'college_id_fk'         => $data['get_college_details']['college_id_fk'],
            'active_status'         => 1,
            'entry_time'            => date('Y-m-d H:i:s'),
            'inserted_by'           => $this->session->stake_holder_login_id_pk,
            'entry_ip'         => $this->input->ip_address(),
        );

        // echo '<pre>'; print_r($data['college_student_map']); die;

        $insert_student_college = $this->spot_council_collegelist_model->insert_college_student_map($data['college_student_map']);

        // decrement no of vacent place //
        $update_vacent_place = $data['get_college_details']['no_vacent_place'] - '1';
        //  echo $update_vacent_place; die;
        $data['no_vacent_place'] = $update_vacent_place;

        // echo '<pre>'; print_r($data['no_vacent_place']) ; die;

        $update_data = $this->spot_council_collegelist_model->update_no_vacent_data($data['no_vacent_place'], $college_map_id);
        //  echo $update_data ; die;

        $update_booking_status = $this->spot_council_collegelist_model->update_preadmission_booking_status($student_id_hash);

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback(); # Something went wrong.
        } else {

            $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

            $data['user_details'] = $this->spot_council_collegelist_model->generatePdf($student_id_hash)[0];
            // end code //
            $html = $this->load->view($this->config->item('theme') . 'spot_council/final_allotment_pdf_view', $data, true);
            $pdfFilePath = 'My_pdf_file-' . date('d-m-Y:h-i-s') . ".pdf";

            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('Directorate of Industrial Training.');
            $this->m_pdf->pdf->showWatermarkText = true;
            $this->m_pdf->pdf->setFooter;
            $this->m_pdf->pdf->WriteHTML($html);
            $this->m_pdf->pdf->Output($pdfFilePath, 'D');
        }
    }
    }
}
