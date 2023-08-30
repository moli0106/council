<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice_and_circular_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getPublicationListCount()
    {
        $query = $this->db->select("count(publication_id_pk)")
            ->from("council_publication")
            ->where('active_status', 1)
            ->get();
        return $query->result_array();
    }

    public function getPublicationTypeList()
    {
        return $this->db->where('active_status', 1)
            ->order_by('publication_type')
            ->get('council_publication_type_master')->result_array();
    }

    public function getPublicationList($limit = NULL, $offset = NULL)
    {
        return $this->db->select('publication.*, type.publication_type')
            ->from('council_publication AS publication')
            ->join('council_publication_type_master AS type', 'publication.publication_type_id_fk = type.publication_type_id_pk', 'LEFT')
            ->where('publication.active_status', 1)
            ->order_by('publication.publication_id_pk', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function getPublicationDetails($id_hash = NULL)
    {
        return $this->db->select('publication.*, type.publication_type')
            ->from('council_publication AS publication')
            ->join('council_publication_type_master AS type', 'publication.publication_type_id_fk = type.publication_type_id_pk', 'LEFT')
            ->where(array(
                "publication.active_status" => 1,
                "MD5(CAST(publication.publication_id_pk as character varying)) =" => $id_hash
            ))
            ->get()->result_array();
    }

    public function insertPublications($array = NULL)
    {
        $this->db->insert('council_publication', $array);

        return $this->db->insert_id();
    }

    public function updatePublication($id_hash = NULL, $updateArray)
    {
        $this->db->where("MD5(CAST(publication_id_pk as character varying)) =", $id_hash);
        $this->db->update('council_publication', $updateArray);

        return $this->db->affected_rows();
    }
}
