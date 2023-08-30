<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_data_list extends NIC_Controller
{
  function __construct()
  {
    parent::__construct();
    parent::check_privilege(153);
    $this->load->model('spot_council/spot_council_studentlist_model');
    //$this->output->enable_profiler();
    $this->css_head = array(
      1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
      // 2 => $this->config->item('theme_uri') . "spot_council/vacent_college_list.js",
      2 => $this->config->item('theme_uri') . "spot_council/student_data_list.js",
      3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',

    );
  }
  public function index($offset = 0)
  {

    $data['districtlist'] = $this->spot_council_studentlist_model->get_district_data();
    $data['courses'] = $this->spot_council_studentlist_model->get_course();

    $data['offset']         = $offset;
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('pagination');

    $config['base_url']         = 'spot_council/student_data_list/index/';
    $data["total_rows"] = $config['total_rows']       = $this->spot_council_studentlist_model->get_student_list_map_count()[0]['count'];
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



    $data['student_data_list'] = $this->spot_council_studentlist_model->get_student_data_list($config['per_page'],$offset);
    //  echo '<pre>'; print_r($data) ; die;

    $this->load->view($this->config->item('theme') . 'spot_council/student_data_list_view', $data);
  }

  public function get_preview_student_data($student_details_id_pk = Null)
  {

    $data['student_data_preview'] = $this->spot_council_studentlist_model->get_student_preview_data_list($student_details_id_pk);

    //  echo '<pre>'; print_r($data) ; die;

    $this->load->view($this->config->item('theme') . 'spot_council/student_preview_data_view', $data);
  }


  public function excel_download()
  {
    $this->load->library('excel');
    $fileName = 'student_details_report_' . date('Yms') . '.xls';
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    //$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
    //$objPHPExcel->getSecurity()->setLockWindows(true);
    //$objPHPExcel->getSecurity()->setLockStructure(true);
    //$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');

    $objPHPExcel->getProperties()->setCreator("Council")
      ->setTitle("Student Registration Report")
      ->setSubject("Student Registration Report")
      ->setDescription("Student Registration Report")
      ->setKeywords("Council")
      ->setCategory("Council");
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
      ->SetCellValue('B1', 'Application Form No')
      ->SetCellValue('C1', 'Candidate Name/Student Name')
      ->SetCellValue('D1', 'Course')
      ->SetCellValue('E1', 'Mobile No')
      ->SetCellValue('F1', 'Email Id')
      ->SetCellValue('G1', 'Guardian Name')
      ->SetCellValue('H1', 'Gender')
      ->SetCellValue('I1', 'Kanyashree')
      ->SetCellValue('J1', 'Kanyashree Unique Id')
      ->SetCellValue('K1', 'Nationality')
      ->SetCellValue('L1', 'Category')
      ->SetCellValue('M1', 'Physically Challenged')
      ->SetCellValue('N1', 'Date of Birth')
      ->SetCellValue('O1', 'Religion')
      ->SetCellValue('P1', 'Aadhar No')
      ->SetCellValue('Q1', 'Qualification For Elegibility')
      ->SetCellValue('R1', 'Registration No (Correspondance Qualification)')
      ->SetCellValue('S1', 'Full Marks')
      ->SetCellValue('T1', 'Marks Obtained')
      ->SetCellValue('U1', 'Percentage')
      ->SetCellValue('V1', 'CGPA')
      ->SetCellValue('W1', 'Percentage of Marks (3rd yr Diploma / Physics / Mathematics / English)')
      ->SetCellValue('X1', 'Percentage of Marks (2nd yr Diploma / Chemistry / Physics / Science)')
      ->SetCellValue('Y1', 'Percentage of Marks (1st yr Diploma / English(H.S) / Life Science or science/ Mathematics)')
      ->SetCellValue('Z1', 'Institution Name')
      ->SetCellValue('AA1', 'Year of passing')
      ->SetCellValue('AB1', 'Address')
      ->SetCellValue('AC1', 'State')
      ->SetCellValue('AD1', 'District')
      ->SetCellValue('AE1', 'Sub-division')
      ->SetCellValue('AF1', 'Police Station')
      ->SetCellValue('AG1', 'Pincode');

    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);


    /*================================== Excel style array starts ==================================*/
    $styleArray = array(
      'borders' => array(
        'inside'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        ),
        'outline'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        )
      ),
      'font' => array(
        'bold' => true,
        'name'  => 'Cambria'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'F0FFF0')
      )

    );
    $styleCellArray = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      ),
      'borders' => array(
        'inside'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        ),
        'outline'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        )
      ),
      'font' => array(
        'name'  => 'Cambria'
      ),
    );

    $styleArrayFooter = array(
      'borders' => array(
        'inside'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        ),
        'outline'     => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array(
            'argb' => '000000'
          )
        )
      ),
      'font' => array(
        'bold' => true,
        'name'  => 'Cambria'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFF0F5')
      )

    );
    /*=============================== Excel style array ends ===============================*/
    $objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->applyFromArray($styleArray);
    $row = 2;

    $excel_data    = $this->spot_council_studentlist_model->get_student_data_list();

    foreach ($excel_data as $stud) {
      /* if($assessor['creator_moderator_type']==19){
				$creator_moderator_type = 'Question Creator';
			}else{
				$creator_moderator_type = 'Question Moderator';
			}*/
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $stud['application_form_no']);
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $stud['candidate_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $stud['course_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $stud['mobile_number']);
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $stud['email']);
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $stud['guardian_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $stud['gender_description']);
      $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $stud['kanyashree']);
      $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $stud['kanyashree_unique_id']);
      $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $stud['nationality_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, $stud['caste_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $stud['handicapped']);
      $objPHPExcel->getActiveSheet()->SetCellValue('N' . $row, date('d-m-Y', strtotime($stud['date_of_birth'])));
      $objPHPExcel->getActiveSheet()->SetCellValue('O' . $row, $stud['religion_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('P' . $row, $stud['aadhar_no']);
      $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $row, $stud['qualification_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('R' . $row, $stud['last_reg_no']);
      $objPHPExcel->getActiveSheet()->SetCellValue('S' . $row, $stud['fullmarks']);
      $objPHPExcel->getActiveSheet()->SetCellValue('T' . $row, $stud['marks_obtain']);
      $objPHPExcel->getActiveSheet()->SetCellValue('U' . $row, $stud['percentage']);
      $objPHPExcel->getActiveSheet()->SetCellValue('V' . $row, $stud['cgpa']);
      $objPHPExcel->getActiveSheet()->SetCellValue('W' . $row, $stud['thirdyr_or_physics_or_math_result']);
      $objPHPExcel->getActiveSheet()->SetCellValue('X' . $row, $stud['secondyear_or_chemistry_or_physicalscience_or_science_result']);
      $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $row, $stud['firstyear_or_hs_english_or_lifescience_result']);
      $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $row, $stud['institute_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $row, $stud['year_of_passing']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $row, $stud['address']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $row, $stud['state_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $row, $stud['district_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $row, $stud['subdiv_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $row, $stud['police_station_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $row, $stud['pincode']);


      $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AG' . $row)->applyFromArray($styleCellArray);
      $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AG' . $row)->getAlignment()->setWrapText(true);
      $row++;
    }
    $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':AG' . $row);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AG' . $row)->applyFromArray($styleArrayFooter);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));
    //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    //$objWriter->save($fileName);
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="' . $fileName . '"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cach

    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
  }

  // sudeshna start 10/12/2022

  public function merit_list_pdf()
  {

    $data['student_details'] = $this->spot_council_studentlist_model->get_studentpdf_data_list();
    // echo "<pre>";
    // print_r($data['student_details']);
    //  die;
    $html = $this->load->view($this->config->item('theme') . 'spot_council/merit_list_view', $data, true);
    $pdfFilePath = 'My_pdf_file-' . date('d-m-Y:h-i-s') . ".pdf";

    $this->load->library('m_pdf');
    $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
    $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
    $this->m_pdf->pdf->setFooter('Page No {PAGENO}/{nb}');
    $this->m_pdf->pdf->WriteHTML($html);
    $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    // redirect('download/thassos_wonder_brochure', 'refresh'); 
  }

 // sudeshna end 10/12/2022


  public function zone_centre_wise_seat_allocation($zone = NULL,$course = NULL)
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    } else {

      $centre = $this->spot_council_studentlist_model->get_centre_list($zone,$course);
      //echo '<pre>'; print_r($centre); die;
      if (!empty($centre)) {

        // $centre_all_details = array();

        foreach ($centre as $key => $value) {

          $centre_details = $this->spot_council_studentlist_model->get_centre_details($value['centre_id_pk'],$course);

          //echo '<pre>'; print_r($centre_details); die;
          $centre_id_pk = $centre_details[0]['centre_id_pk'];
          $centre_code = $centre_details[0]['centre_code'];
          $this->db->trans_start();
          $update_array =  array(
            'exam_centre_id_fk' => $centre_id_pk,
            'centre_code'       => $centre_code,
            'seating_done_status' => 1

          );

          $alloted_seat = $centre_details[0]['no_of_alloted_seat'];
          // echo $alloted_seat ; die;
          $zone_wise_student_count_list = $this->spot_council_studentlist_model->get_student_id_list($zone, $alloted_seat,$course);
          //echo '<pre>'; print_r($zone_wise_student_count_list); die;

          $std_count = count($zone_wise_student_count_list);

          if($std_count != 0){

          

            $available_seat =  $alloted_seat - $std_count;



            $seat_allocate = $this->spot_council_studentlist_model->update_allocat_seat($zone_wise_student_count_list, $update_array);

            if ($seat_allocate > 0) {

              $this->spot_council_studentlist_model->update_available_seat($available_seat, $centre_id_pk);
              
              if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback(); # Something went wrong.


              } else {

              
                $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.


              }
              // echo json_encode($data);
              // }
            }
          }
        }
        $ajaxResponse = array(
          'ok'  => 1,
          'msg' => 'Success! Centre Updated successfully.'
        );
      } else {
        $ajaxResponse = array(
          'ok'     => 2,
          'msg'    => 'Oops! Data not found..',
        );
      }
      // echo $ajaxResponse;die;
      echo json_encode($ajaxResponse);
    }
  }


  public function genarate_index(){
    
    //$center_code=array("cooa"=>4,"coob"=>5,"cooc"=>6,"booa"=>7,"boob"=>10);

    $total_student=array("cooa"=>100,"booa"=>6,"coob"=>12);


    //$student_seatno="cooa"




    foreach($total_student as $key => $val){

      for($i=1;$i<=$val;$i++){
      print "-------";
      print $key."-".str_pad($i, 5, '0', STR_PAD_LEFT);;

      //if

      }

    }
  }


 


}