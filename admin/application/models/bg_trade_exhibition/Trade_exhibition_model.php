<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trade_exhibition_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertData($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function insertMultipleData($table, $array = NULL)
    {
        $this->db->insert_batch($table, $array);

        return true;
    }

    public function getExhibitionProductList($limit = NULL, $offset = NULL)
    {

        $query =  $this->db->select('product.product_id_pk,product.product_name, product.product_desc, product.mentor_name, product.mentor_designation,')
            ->from("council_bgte_product_details as product")
			->where(array(
                "product.active_status" => 1
            ))
            ->limit($limit, $offset)
            ->order_by("product.product_id_pk", "ASC")
            ->get()->result_array();
        foreach ($query as $key => $value) {
            $product_id_pk = $value['product_id_pk'];

            $images = $this->db->select("product_image.*")
                ->from("council_bgte_product_image as product_image")
                ->where("product_image.product_id_fk", $product_id_pk)
                ->get()->result_array();

            if ($images) {
                $array = [];
                for ($i = 0; $i < count($images); $i++) {
                    array_push($array, $images[$i]['product_image']);
                }

                $query[$key]['prd_image'] = $array;
            } else {
                $query[$key]['prd_image'] = '';
            }
        }

        // echo "<pre>";print_r($query);exit;
        return $query;
    }

    public function get_productCount()
    {
        $query = $this->db->select("count(product_id_pk)")
            ->from("council_bgte_product_details")
            ->get();
        return $query->result_array();
    }

    public function getProductDetails($id_hash = NULL)
    {
        $this->db->select('product_id_pk, product_name, product_desc, product_video, mentor_name, mentor_designation, mentor_photo, mentor_instute_name, mentor_email, mentor_mobile');
        $this->db->from('council_bgte_product_details');
        $this->db->where(
            array(
                "MD5(CAST(product_id_pk as character varying)) =" => $id_hash
            )
        );
        $product = $this->db->get()->result_array();

        $this->db->select('product_image_id_pk, product_id_fk, product_image');
        $this->db->from('council_bgte_product_image');
        $this->db->where(
            array(
                "MD5(CAST(product_id_fk as character varying)) =" => $id_hash
            )
        );
        $image = $this->db->get()->result_array();

        $this->db->select('student_id_pk, product_id_fk, student_name, student_discipline, student_photo, student_instute');
        $this->db->from('council_bgte_product_created_student_details');
        $this->db->where(
            array(
                "MD5(CAST(product_id_fk as character varying)) =" => $id_hash
            )
        );
        $student = $this->db->get()->result_array();

        return array('product' => $product, 'image' => $image, 'student' => $student);
    }
}
