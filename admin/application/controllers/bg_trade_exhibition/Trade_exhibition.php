<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trade_exhibition extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(118);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('bg_trade_exhibition/trade_exhibition_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/select2/dist/css/select2.min.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bg_trade_exhibition/trade_exhibition.js",
            2 => $this->config->item('theme_uri') . 'bower_components/select2/dist/js/select2.full.min.js',
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
        );
    }

    public function index($offset = 0)
    {

        $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'admin/bg_trade_exhibition/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->trade_exhibition_model->get_productCount()[0]['count'];
        $config['per_page']         = 25;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
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

        $data['page_links']  = $this->pagination->create_links();
        $data['product_list'] = $this->trade_exhibition_model->getExhibitionProductList($config['per_page'], $offset);

        $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_list_view', $data);
    }

    public function add()
    {

        if ($this->input->server("REQUEST_METHOD") == "POST") {


            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            if ($this->input->post('std_name') != '' && count($this->input->post('std_name')) > 0) {


                $config = array(
                    array(
                        'field' => 'prd_name',
                        'label' => 'Product Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'prd_description',
                        'label' => 'Product Description',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'mentor_name',
                        'label' => 'Mentor Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'mentor_designation',
                        'label' => 'Mentor Designation',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'mentor_institue',
                        'label' => 'Institute Name',
                        'rules' => 'trim|required'
                    )
                );

                $this->form_validation->set_rules(
                    'mentor_mobile',
                    '<b>Mobile No.</b>',
                    'trim|required|exact_length[10]',
                    array('integer' => "The %s field must contain only numbers.")
                );
                $this->form_validation->set_rules('mentor_email', '<b>email ID</b>', 'trim|required|max_length[50]|valid_email');

                $this->form_validation->set_rules($config);


                // $this->form_validation->set_rules('prd_image[]', 'Product image', 'trim|callback_file_validation[prd_image|image/jpeg|100|required]');
                $this->form_validation->set_rules('mentor_image', 'Mentor image', 'trim|callback_file_validation[mentor_image|image/jpeg|1024|required]');


                // ------- Video Validation ----------------

                $file_validation_type = "video/mp4";
                $file_validation_size = 5120; //5 MB In KB

                $this->form_validation->set_rules('prd_video', '<b>Product Video</b>', 'trim|callback_file_validation[prd_video|' . $file_validation_type . '|' . $file_validation_size . '|]');

                // ------- Video Validation ----------------


                if ($_FILES['prd_video']['name'] != '') {
                    $product_video = base64_encode(file_get_contents($_FILES['prd_video']['tmp_name']));
                } else {
                    $product_video = NULL;
                }

                if ($_FILES['mentor_image']['name'] != '') {
                    $mentor_photo = base64_encode(file_get_contents($_FILES['mentor_image']['tmp_name']));
                } else {
                    $mentor_photo = NULL;
                }

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_add_view');
                } else {

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    $insert_array = array(

                        'product_name'          => $this->input->post('prd_name'),
                        'product_desc'          => $this->input->post('prd_description'),
                        'product_video'          => $product_video,
                        'mentor_name'       => $this->input->post('mentor_name'),
                        'mentor_email'      => $this->input->post('mentor_email'),
                        'mentor_mobile'      => $this->input->post('mentor_mobile'),
                        'mentor_designation'      => $this->input->post('mentor_designation'),
                        'mentor_photo'         => $mentor_photo,
                        'entry_time'         => 'now()',
                        'mentor_instute_name'  => $this->input->post('mentor_institue'),
                        'entry_by'  => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'         => $this->input->ip_address(),
                        'active_status'    => 1,

                    );



                    $last_id = $this->trade_exhibition_model->insertData('council_bgte_product_details', $insert_array);

                    if ($last_id) {


                        // Validation Multiple Product Image
                        $file_validation_err = 0;
                        $max_size = 1000000; // 1MB Size

                        $prd_image_count = count($_FILES['prd_image']['name']);

                        if ($prd_image_count > 0) {

                            $productImageArray = array();
                            for ($i = 0; $i < $prd_image_count; $i++) {

                                $prd_image = NULL;

                                if ($_FILES['prd_image']['name'][$i] != '') {

                                    $file_name = $_FILES['prd_image']['name'][$i];
                                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                                    //print_r($_FILES['prd_image']['size'][$i]); die;
                                    if ($_FILES['prd_image']['size'][$i] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                                        $file_validation_err = 1;
                                        $data['file_error'] = "Max 1 MB and product image format should be JPG/JPEG";
                                    } else {
                                        $imageArray = array(

                                            'product_id_fk'   => $last_id,
                                            'product_image'   => base64_encode(file_get_contents($_FILES['prd_image']['tmp_name'][$i])),
                                            'active_status'   => 1,
                                        );

                                        array_push($productImageArray, $imageArray);
                                    }
                                }
                            }
                        }


                        //  validation of created By section

                        $createdByDataArray = array();

                        foreach ($this->input->post('std_name') as $key => $value) {

                            $this->form_validation->set_rules('std_name[' . $key . ']', 'Student name', 'required');
                            $this->form_validation->set_rules('institute_name[' . $key . ']', 'Student name', 'required');
                            $this->form_validation->set_rules('discipline[' . $key . ']', 'Student name', 'required');

                            $std_image = NULL;

                            if ($_FILES['std_image']['name'][$key] != '') {

                                $file_name = $_FILES['std_image']['name'][$key];
                                $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                                if ($_FILES['std_image']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                                    $file_validation_err = 1;
                                    $data['file_error'] = "Max 1 MB and student image format should be JPG/JPEG";
                                } else {

                                    $std_image = base64_encode(file_get_contents($_FILES['std_image']['tmp_name'][$key]));

                                    $created_array = array(
                                        'product_id_fk'   => $last_id,
                                        'student_name'    => $this->input->post('std_name')[$key],
                                        'student_discipline'  => $this->input->post('discipline')[$key],
                                        'student_photo'     =>  $std_image,
                                        'student_instute'  => $this->input->post('institute_name')[$key],
                                        'active_status'  => 1,
                                    );

                                    array_push($createdByDataArray, $created_array);
                                }
                            }
                        }



                        if ($file_validation_err == 0) {

                            // Insert Multiple Product Image
                            $this->trade_exhibition_model->insertMultipleData('council_bgte_product_image', $productImageArray);

                            // Insert Created Data
                            $this->trade_exhibition_model->insertMultipleData('council_bgte_product_created_student_details', $createdByDataArray);

                            if ($this->db->trans_status() === FALSE) {
                                # Something went wrong.
                                $this->db->trans_rollback();

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Unable to add product, Please try after sometime.');
                            } else {
                                # Everything is Perfect. Committing data to the database.
                                $this->db->trans_commit();

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Product has been added successfully.');
                            }
                        } else {
                            $this->db->trans_rollback();

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', $data['file_error']);
                        }
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                    // redirect('admin/bg_trade_exhibition/trade_exhibition/add');
                    $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_add_view');
                }
            } else {

                $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_add_view');
            }
        } else {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_add_view');
        }
    }

    public function details($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $data["product_details"] = $this->trade_exhibition_model->getProductDetails($id_hash);
            if (!empty($data["product_details"])) {

                $this->load->view($this->config->item('theme') . 'bg_trade_exhibision/trade_exhibition_details_view', $data);
            } else {
                redirect(base_url('admin/bg_trade_exhibition/trade_exhibition'), 'refresh');
            }
        } else {
            redirect(base_url('admin/bg_trade_exhibition/trade_exhibition'), 'refresh');
        }
    }

    // ! File validation function
    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);
        if ($file_array[1] == "video/mp4") {
            $ext = "mp4";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }

        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];

            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }
}
