<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stud_att_report_centre extends NIC_Controller
{

  function __construct()
  {
    parent::__construct();
    parent::check_privilege(153);
    $this->load->model('spot_council/stud_att_report_centre_model');
    $this->load->library('Zend');
    //$this->output->enable_profiler();
    $this->css_head = array(
      1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
      2 => $this->config->item('theme_uri') . "spot_council/student_pdf_report_data.js",
      3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
    );
  }


  public function index($offset = 0)
  {
    // echo "hhhh";exit;

    $data['offset']         = $offset;
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('pagination');

    $config['base_url']         = 'spot_council/stud_att_report_centre/index/';
    // $data["total_rows"] = $config['total_rows']       = $this->spot_council_studentlist_model->get_student_list_map_count()[0]['count'];
    $config['per_page']         = 50;
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

    $data['courses'] = $this->stud_att_report_centre_model->get_course();
    //echo '<pre>'; print_r($data['courses']) ; die;
    $data['centre'] = $this->stud_att_report_centre_model->get_centre();

    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('centre_name', '<b>Centre Name</b>', 'trim|required');
      $this->form_validation->set_rules('etype_name', '<b>Exam Type Name</b>', 'trim|required');
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      if ($this->form_validation->run() == FALSE) {
        // echo "hii";
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
        $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
      } else {

        $centre_id_fk = $this->input->post('centre_name');
        $exam_type_id_fk = $this->input->post('etype_name');

        // $data['student_id'] = $this->stud_att_report_centre_model->get_attandance_pdf_data($centre_id_fk, $exam_type_id_fk);
        
       
          $data['att_details']    = $this->stud_att_report_centre_model->getStudattaDetails($exam_type_id_fk, $centre_id_fk);
          // echo '<pre>'; print_r($data['att_details']); die;
             // echo '<pre>'; print_r($data['att_details']);die;

          if (!empty($data['att_details'])) {
             
          $data['exam_type_name'] = $data['att_details'][0]['exam_type_name'];
          $data['centre_name'] = $data['att_details'][0]['centre_name'];
          // echo '<pre>'; print_r($data['centre_name']); die;

          $data['centre_code'] = $data['att_details'][0]['centre_code'];
          // ************ modify //

          $data['student_details_array'] = array();
            foreach($data['att_details'] as $key => $value){

              $application_form_no = $value['application_form_no'];
              // echo '<pre>'; print_r($application_form_no); die;
              $photo = $value['picture'];
              $sign = $value['sign'];
              $data['picture'] = $this->db_image($photo);
               // echo '<pre>'; print_r($data['picture']); die;
              $data['sign'] = $this->db_image($sign);
              
              $data['barcode'] = $this->barcode($application_form_no);
              // echo '<pre>'; print_r($data['barcode']); die;
              $student_details =array(
                'student_details_id_pk' => $value['student_details_id_pk'],
                'application_form_no' => $value['application_form_no'],
                'index_number' => $value['index_number'],
                'candidate_name' => $value['candidate_name'],
                'picture' => $data['picture'],
                'sign' => $data['sign'],
                'barcode' =>$data['barcode']

              );
              array_push($data['student_details_array'],$student_details);
              }
              // echo '<pre>';print_r($data['student_details_array']); die;
          $html   = $this->load->view($this->config->item('theme') . 'spot_council/attadence_reportwps_view', $data, true);
            // echo $html;die;
          $pdfFilePath = 'Certificate-' . $data['att_details'][0]['exam_type_name'] . ".pdf";
          $this->load->library('m_pdf');
          $this->m_pdf->pdf->AddPage('P');
          $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
          $this->m_pdf->pdf->showWatermarkText = true;

          $this->m_pdf->pdf->WriteHTML($html);
          $this->m_pdf->pdf->setFooter('Page No {PAGENO}/{nb}');
          $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        } else {
          
          $this->session->set_flashdata('status', 'danger');
          $this->session->set_flashdata('alert_msg', 'oops! Data Not Found ,  Error.');
          $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
        }
      }
    } else {
      $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
    }
  }


  public function download_report2()
  {

    $data['courses'] = $this->stud_att_report_centre_model->get_course();
    //echo '<pre>'; print_r($data['courses']) ; die;
    $data['centre'] = $this->stud_att_report_centre_model->get_centre();

    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('centre_id', '<b>Centre Name</b>', 'trim|required');
      $this->form_validation->set_rules('etype_id', '<b>Exam Type Name</b>', 'trim|required');
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

      if ($this->form_validation->run() == FALSE) {
        // echo "hii";
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
        $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
      } else {

        $centre_id_fk = $this->input->post('centre_id');
        $exam_type_id_fk = $this->input->post('etype_id');

       // $data['student_id'] = $this->stud_att_report_centre_model->get_attandance_pdf_data($centre_id_fk, $exam_type_id_fk);
        // echo '<pre>'; print_r($data['student_id']); die;
       
          $data['descriptive_details']    = $this->stud_att_report_centre_model->getStudattaDetails($exam_type_id_fk, $centre_id_fk);
          // echo '<pre>'; print_r($data['descriptive_details']); die;
          if ( $data['descriptive_details']) {

          $data['centre_name'] = $data['descriptive_details'][0]['centre_name'];
          // echo '<pre>'; print_r($data['centre_name']); die;
          $data['centre_code'] = $data['descriptive_details'][0]['centre_code'];
          $data['exam_type_name'] = $data['descriptive_details'][0]['exam_type_name'];
          //
          // echo '<pre>'; print_r($data['barcod']); die;
          $html   = $this->load->view($this->config->item('theme') . 'spot_council/attadence_reportwops_view', $data, true);
          // echo $html;die;
          $pdfFilePath = 'Certificate-' . $data['descriptive_details'][0]['centre_code'] . ".pdf";
          $this->load->library('m_pdf');
          $this->m_pdf->pdf->AddPage('P');
          $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
          $this->m_pdf->pdf->showWatermarkText = true;

          $this->m_pdf->pdf->WriteHTML($html);
          $this->m_pdf->pdf->setFooter('Page No {PAGENO}/{nb}');
          $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        } else {
          $this->session->set_flashdata('status', 'danger');
          $this->session->set_flashdata('alert_msg', 'oops! Data Not Found ,  Error.');
          $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
        }
      }
    } else {
      $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
    }
  }


  public function download_report3()
  {

    $data['courses'] = $this->stud_att_report_centre_model->get_course();
    //echo '<pre>'; print_r($data['courses']) ; die;
    $data['centre'] = $this->stud_att_report_centre_model->get_centre();

    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('centre_id_fk', '<b>Centre Name</b>', 'trim|required');
      $this->form_validation->set_rules('etype_id_fk', '<b>Exam Type Name</b>', 'trim|required');
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

      if ($this->form_validation->run() == FALSE) {
        // echo "hii";
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
        $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
      } else {

        $centre_id_fk = $this->input->post('centre_id_fk');
        $exam_type_id_fk = $this->input->post('etype_id_fk');

        // $data['student_id'] = $this->stud_att_report_centre_model->get_attandance_pdf_data($centre_id_fk, $exam_type_id_fk);
         // echo '<pre>'; print_r($data['student_id']); die;
        
          $data['seat_details']    = $this->stud_att_report_centre_model->getStudattaDetailspdf3($exam_type_id_fk, $centre_id_fk);
           // echo '<pre>'; print_r($data['seat_details']); die;
           if ($data['seat_details']) {

          $data['centre_name'] = $data['seat_details'][0]['centre_name'];
          // echo '<pre>'; print_r($data['centre_name']); die;
          $data['centre_code'] = $data['seat_details'][0]['centre_code'];
          $data['exam_type_name'] = $data['seat_details'][0]['exam_type_name'];
          //
          // echo '<pre>'; print_r($data['barcod']); die;
          $html   = $this->load->view($this->config->item('theme') . 'spot_council/centre_seat_view', $data, true);
          // echo $html;die;
          $pdfFilePath = 'Certificate-' . $data['seat_details'][0]['centre_code'] . ".pdf";
          $this->load->library('m_pdf');
          $this->m_pdf->pdf->AddPage('P');
          $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
          $this->m_pdf->pdf->showWatermarkText = true;

          $this->m_pdf->pdf->WriteHTML($html);
          $this->m_pdf->pdf->setFooter('Page No {PAGENO}/{nb}');
          $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        } else {
          $this->session->set_flashdata('status', 'danger');
          $this->session->set_flashdata('alert_msg', 'oops! Data Not Found ,  Error.');
          $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
        }
      }
    } else {
      $this->load->view($this->config->item('theme') . 'spot_council/stud_att_report_centre_view', $data);
    }
  }


  public function barcode($application_form_no = null)
  {
    // echo $application_form_no ; die;

    $this->load->library('zend');
    //load in folder Zend
    $this->zend->load('Zend/Barcode');

    //generate barcode
    $barcode = Zend_Barcode::factory('code128', 'image', array('text' => $application_form_no, 'barHeight' => 20, 'factor' => 2), array('imageType' => 'png'));
    //set dir path for barcode image store
    //$path = './you/dir/path/'.$application_form_no.'.png';
    ob_start();
    imagepng($barcode->draw());
    $bhh = ob_get_contents();
    ob_end_clean();

    return base64_encode($bhh);
  }

  public function db_image($picture = NULL)
  {

      $data = base64_decode($picture);



      $im = imagecreatefromstring($data);
      if ($im !== false) {

      ob_start();
      imagejpeg($im);
      $bhh=ob_get_contents();
      ob_end_clean();
      // header('Content-Type: image/jpeg');
      // imagepng($im);
      imagedestroy($im);
      $data = base64_encode ( $bhh); 
      return $data ; 
      }
      else {
      return  'An error occurred.';
      }

  }


  public function ajax_centre($exam_type_id_fk = NULL)
  {
    
		if ($exam_type_id_fk != NULL && is_numeric($exam_type_id_fk)) {
			$centres = $this->stud_att_report_centre_model->get_centreajax($exam_type_id_fk);
			//print_r($states);
			echo '<option value="">-- Select Centre --</option>';
			foreach ($centres as $centre) { ?>
				<option value="<?php echo $centre['centre_id_pk']; ?>"><?php echo $centre['centre_name']; ?></option>
    <?php }
		} else {
			echo '<option value="">-- Select Centre --</option>';
		}
	}

  public function ajax_centre1($etype_id = NULL)
  {
    
		if ($etype_id != NULL && is_numeric($etype_id)) {
			$centre = $this->stud_att_report_centre_model->get_centreajax1($etype_id);
			//print_r($states);
			echo '<option value="">-- Select Centre --</option>';
			foreach ($centre as $value) { ?>
				<option value="<?php echo $value['centre_id_pk']; ?>"><?php echo $value['centre_name']; ?></option>
      <?php }
		} else {
			echo '<option value="">-- Select Centre --</option>';
		}
	}


  public function ajax_centre2($etype_id_fk = NULL)
  {
    
		if ($etype_id_fk != NULL && is_numeric($etype_id_fk)) {
			$centre = $this->stud_att_report_centre_model->get_centreajax2($etype_id_fk);
			//print_r($states);
			echo '<option value="">-- Select Centre --</option>';
			foreach ($centre as $values) { ?>
				<option value="<?php echo $values['centre_id_pk']; ?>"><?php echo $values['centre_name']; ?></option>
      <?php }
		} else {
			echo '<option value="">-- Select Centre --</option>';
		}
	}

}
