<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notices_and_circulars_model extends CI_Model
{

    /* public function get_publication($type = NULL)
    {
        $query = $this->db->select("publication_id_pk, publication_title, publication_description")
            ->from("council_publication")
            ->where(
                array(
                    "active_status"  => 1,
                    "approve_status" => 1
                )
            );

        if ($type != NULL) {

            $query = $this->db->where("publication_type_id_fk", $type);
        }

        $query = $this->db->order_by("published_date", "DESC")->get();

        return $query->result_array();
    } */

    public function getPublicationListCount()
    {
        $query = $this->db->select("count(publication_id_pk)")
            ->from("council_publication")
            ->where(
                array(
                    'active_status'  => 1,
                    'approve_status' => 1
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_publication_type()
    {
        return $this->db->where('active_status', 1)
            ->order_by('publication_type')
            ->get('council_publication_type_master')->result_array();
    }

    public function get_publication($limit = NULL, $offset = NULL)
    {
        return $this->db->select('publication.*, type.publication_type')
            ->from('council_publication AS publication')
            ->join('council_publication_type_master AS type', 'publication.publication_type_id_fk = type.publication_type_id_pk', 'LEFT')
            ->where(
                array(
                    "publication.active_status"  => 1,
                    "publication.approve_status" => 1
                )
            )
            ->order_by('publication.publication_id_pk', 'DESC')
            ->limit($limit, $offset)
            ->get()->result_array();
    }

    public function search_publication($publication_type = NULL, $keywords = NULL, $published_date = NULL)
    {
        $query = $this->db->select('publication.*, type.publication_type')
            ->from('council_publication AS publication')
            ->join('council_publication_type_master AS type', 'publication.publication_type_id_fk = type.publication_type_id_pk', 'LEFT')
            ->where(
                array(
                    "publication.active_status"  => 1,
                    "publication.approve_status" => 1
                )
            );

        if (($publication_type != NULL) && ($publication_type != 'All')) {

            $query = $this->db->where("publication.publication_type_id_fk", $publication_type);
        }

        if ($keywords != NULL) {


            $query = $query->group_start()
                ->like('LOWER(publication.publication_title)', strtolower($keywords), 'both')
                ->or_like('LOWER(publication.document_no)', strtolower($keywords), 'both')
                ->group_end();
        }

        if ($published_date != NULL) {

            $query = $this->db->where("publication.published_date", $published_date);
        }

        $query = $this->db->order_by('published_date', 'DESC')->get()->result_array();

        return $query;
    }

    public function get_publication_details($id_hash = NULL)
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
}
