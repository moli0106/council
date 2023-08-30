<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessor_batch_model extends CI_Model
{

    public function getAllSector()
    {
        $query = $this->db->select("sector_id_pk, sector_code, sector_name")
            ->from("council_sector_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5
                )
            )
            ->order_by("sector_name", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getJobRole($sector_id)
    {
        $query = $this->db->select("course_id_pk, course_name, course_code")
            ->from("council_course_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5,
                    "sector_id_fk"      => $sector_id,
                )
            )
            ->order_by("course_name", "ASC")
            ->get();

        return $query->result_array();
    }

    public function getVenue($venue_id = NULL)
    {
        $query = $this->db->select("venue_id_pk, institute_name")
            ->from("council_exame_venue_details");

        if ($venue_id != NULL) {
            $query = $query->where(
                array(
                    "venue_id_pk"      => $venue_id,
                )
            );
        }

        $query = $query->order_by("institute_name", "ASC")->get();

        return $query->result_array();
    }

    public function getBatchType()
    {
        $query = $this->db->select("*")
            ->from("council_question_type_master")
            ->where(
                array(
                    "active_status"     => 1,
                )
            )
            ->get();

        return $query->result_array();
    }

    public function getAssessmentMode()
    {
        $query = $this->db->select("*")
            ->from("council_assessment_mode_details")
            ->where(
                array(
                    "active_status"     => 1,
                )
            )
            ->get();

        return $query->result_array();
    }

    public function getTrainerByJobRole($sector_id, $job_role_id)
    {
        $query = $this->db->select("trainer.master_trainer_id_pk, trainer.f_name, trainer.m_name, trainer.l_name, trainer.mobile, trainer.email")
            ->from("council_master_trainer AS trainer");


        if (!empty($job_role_id) && !empty($sector_id)) {

            $query = $query->join("council_trainer_course_map AS ctcm", "trainer.master_trainer_id_pk = ctcm.master_trainer_id_fk", "left")
                ->where(
                    array(
                        "trainer.active_status" => 1,
                        "ctcm.sector_id_fk"     => $sector_id,
                        "ctcm.course_id_fk"     => $job_role_id,
                        "ctcm.active_status"    => 1,
                    )
                );
        } else {
            $query = $query->where(
                array(
                    "trainer.active_status" => 1,
                )
            );
        }

        $query = $query->order_by("trainer.f_name", "ASC")->get();

        return $query->result_array();
    }

    public function getAssessorByJobRole($job_role_id)
    {
        $query = $this->db->select("distinct(card.assessor_registration_details_pk), card.fname, card.lname, card.email_id, card.mobile_no, csm.sector_name,card.pan")
            ->from("council_assessor_registration_application_nubmer as appno");

        $query = $query->join("council_assessor_registration_details AS card", "appno.assessor_registration_details_fk = card.assessor_registration_details_pk", "left");

        //$query = $query->join("council_assessor_registration_jobrole_sector_map AS carjsm", "carjsm.assessor_registration_details_fk = card.assessor_registration_details_pk", "left");

        $query = $query->join("council_assessor_registration_jobrole_sector_map AS carjsm", "carjsm.assessor_registration_details_fk = card.assessor_registration_details_pk AND appno.assessor_registration_application_no = carjsm.assessor_registration_application_no", "left");

        $query = $query->join("council_course_master AS ccm", "carjsm.course_id_fk = ccm.course_id_pk", "left");
        $query = $query->join("council_sector_master AS csm", "ccm.sector_id_fk = csm.sector_id_pk", "left");

        //Added by Waseem on 01-11-2021
        // $query = $query->join("council_assessor_ssc_wbsctvesd_certified_map as ssc_certi_map","ssc_certi_map.assessor_registration_application_nubmer_id_fk=appno.assessor_registration_application_nubmer_id_pk and ssc_certi_map.course_id_fk=$job_role_id","LEFT");
        //Added by Waseem on 01-11-2021

        if (!empty($job_role_id)) {

            $query = $query->where(
                array(
                    //"appno.approve_status"        => 1,
                    "appno.process_status_id_fk"  => 5,
                    "carjsm.process_status_id_fk" => 5,
                    "carjsm.active_status"        => 1,
                    "carjsm.course_id_fk"         => $job_role_id,
                )
            );

            //Added by Waseem on 01-11-2021
            /* $query = $query->group_start();
            $query = $query->or_where("ssc_certi_map.process_status_id_fk", 6);
            $query = $query->or_where("ssc_certi_map.process_status_id_fk", NULL);
            $query = $query->group_end(); */
            //Added by Waseem on 01-11-2021

            //$query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_batch_assessor_map AS cbam LEFT JOIN council_batch_ems AS cbems ON cbems.batch_ems_id_pk = cbam.batch_ems_id_fk WHERE cbems.course_id = '.$job_role_id.')', NULL, FALSE);

            $query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_batch_assessor_map AS cbam LEFT JOIN council_batch_ems AS cbems ON cbems.batch_ems_id_pk = cbam.batch_ems_id_fk WHERE cbems.course_id = ' . $job_role_id . ')', NULL, FALSE);

            $query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_assessor_empanelled_map WHERE course_id_fk = ' . $job_role_id . ' AND active_status = 1)', NULL, FALSE);    //Without empanelled assessor

            $query = $query->order_by("card.fname", "ASC");
        } else {
            $query = $query->where(
                array(
                    //"appno.approve_status"        => 1,
                    "appno.process_status_id_fk"  => 5,
                    "carjsm.process_status_id_fk" => 5,
                    "carjsm.active_status"        => 1,
                )
            );

            //Added by Waseem on 01-11-2021
            /* $query = $query->group_start();
            $query = $query->or_where("ssc_certi_map.process_status_id_fk", 6);
            $query = $query->or_where("ssc_certi_map.process_status_id_fk", NULL);
            $query = $query->group_end(); */
            //Added by Waseem on 01-11-2021

            //$query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_batch_assessor_map )', NULL, FALSE);

            $query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_batch_assessor_map AS cbam LEFT JOIN council_batch_ems AS cbems ON cbems.batch_ems_id_pk = cbam.batch_ems_id_fk WHERE cbems.batch_type = 2)', NULL, FALSE);

            $query = $query->where('card.assessor_registration_details_pk NOT IN (SELECT assessor_id_fk FROM council_assessor_empanelled_map WHERE active_status = 1)', NULL, FALSE);
            $query = $query->order_by("csm.sector_name", "ASC");
            $query = $query->order_by("card.fname", "ASC");
        }

        //$query = $query->where('card.ssc_wbsctvesd_status IS NULL', NULL,FALSE);

        //$query = $query->order_by("card.fname", "ASC")->get();
        $query = $query->get();

        return $query->result_array();
    }

    public function createBatch($array)
    {
        $this->db->insert('council_batch_ems', $array);

        return $this->db->insert_id();
    }

    public function addAssessorInBatch($mapArray)
    {
        // return $this->db->insert_batch('council_batch_assessor_map', $mapArray); 
        $this->db->insert('council_batch_assessor_map', $mapArray);

        return $this->db->insert_id();
    }


    public function getBatchAssessorList_old($id_hash)
    {
        $query = $this->db->select("
            assessor.fname, 
            assessor.lname, 
            assessor.mobile_no, 
            assessor.email_id,
            cbam.exam_status,
            cbam.assessor_id_fk,
            cbam.batch_ems_id_fk,

            result.marks,
            result.total_question,
            result.question_attempt,
            result.correct_answer,
            result.percentage,
            result.con_eval_marks,
        ")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")

            ->join("council_assessor_exam_result_details as result", "result.batch_id_fk = cbam.batch_ems_id_fk AND result.assessor_id_fk = cbam.assessor_id_fk", "left")

            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash,
                    "result.active_status"   => 1
                )
            )
            ->order_by('assessor.fname')
            ->order_by('assessor.lname')
            ->get();
        return $query->result_array();
    }

    public function getBatchAssessorList($id_hash)
    {
        $assessorList = $this->db->select("
            assessor.fname,
			assessor.mname,			
            assessor.lname, 
            assessor.mobile_no, 
            assessor.email_id,
            cbam.exam_status,
            cbam.assessor_id_fk,
            cbam.batch_ems_id_fk
        ")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
            ->where("MD5(CAST(cbam.batch_ems_id_fk as character varying)) = ", $id_hash)
            ->order_by('assessor.fname')->order_by('assessor.lname')
            ->get()->result_array();

        foreach ($assessorList as $key => $assessor) {

            $resultList = $this->db->select("
                result.marks,
                result.total_question,
                result.question_attempt,
                result.correct_answer,
                result.percentage,
                result.con_eval_marks
            ")
                ->from("council_assessor_exam_result_details as result")
                ->where('result.batch_id_fk', $assessor['batch_ems_id_fk'])
                ->where('result.assessor_id_fk', $assessor['assessor_id_fk'])
                ->where("result.active_status", 1)
                ->get()->result_array();

            if (!empty($resultList)) {
                $assessorList[$key]['marks']            = $resultList[0]['marks'];
                $assessorList[$key]['total_question']   = $resultList[0]['total_question'];
                $assessorList[$key]['question_attempt'] = $resultList[0]['question_attempt'];
                $assessorList[$key]['correct_answer']   = $resultList[0]['correct_answer'];
                $assessorList[$key]['percentage']       = $resultList[0]['percentage'];
                $assessorList[$key]['con_eval_marks']   = $resultList[0]['con_eval_marks'];
            } else {

                $assessorList[$key]['marks']            = NULL;
                $assessorList[$key]['total_question']   = NULL;
                $assessorList[$key]['question_attempt'] = NULL;
                $assessorList[$key]['correct_answer']   = NULL;
                $assessorList[$key]['percentage']       = NULL;
                $assessorList[$key]['con_eval_marks']   = NULL;
            }
        }
        return $assessorList;
    }


    public function getBatchDetails($id_hash)
    {
        $query = $this->db->select("cbems.*, sector.sector_name, course.course_name,trainer.f_name,trainer.l_name")
            ->from("council_batch_ems as cbems")
            ->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
            ->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
            ->join("council_master_trainer as trainer", "trainer.master_trainer_id_pk = cbems.trainer_id", "left")
            ->where(
                array(
                    "MD5(CAST(cbems.batch_ems_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function updateBatch($id, $array)
    {
        $this->db->where(
            array(
                'batch_ems_id_pk' => $id
            )
        )
            ->update('council_batch_ems', $array);
        return $this->db->affected_rows();
    }

    public function getAllBatch($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("cbe.*, sector.sector_name, course.course_name, trainer.f_name,trainer.m_name, trainer.l_name")
            ->from("council_batch_ems AS cbe")
            ->join("council_sector_master as sector", "cbe.sector_id = sector.sector_id_pk", "left")
            ->join("council_course_master as course", "cbe.course_id = course.course_id_pk", "left")
            ->join("council_master_trainer as trainer", "cbe.trainer_id = trainer.master_trainer_id_pk", "left")
            ->limit($limit, $offset)
            ->order_by("cbe.start_date", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getBatchCount()
    {
        $query = $this->db->select("count(batch_ems_id_pk)")
            ->from("council_batch_ems")
            ->get();
        return $query->result_array();
    }

    public function getAssessorWhereIn($assessor_ids)
    {
        $query = $this->db->select("fname, lname, email_id, mobile_no")
            ->from("council_assessor_registration_details")
            ->where_in('assessor_registration_details_pk', $assessor_ids)
            ->get();
        return $query->result_array();
    }

    public function getTrainerDetails($trainer_id)
    {
        $query = $this->db->select("*")
            ->from("council_master_trainer")
            ->where('master_trainer_id_pk', $trainer_id)
            ->get();
        return $query->result_array();
    }

    public function getCourseDetails($course_id)
    {
        $query = $this->db->select("*")
            ->from("council_course_master")
            ->where('course_id_pk', $course_id)
            ->get();
        return $query->result_array();
    }

    public function getAssessorDetails($assessor_id)
    {
        $query = $this->db->select("*")
            ->from("council_assessor_registration_details")
            ->where('assessor_registration_details_pk', $assessor_id)
            ->get();
        return $query->result_array();
    }

    public function getSectorDetails($sector_id)
    {
        $query = $this->db->where('sector_id_pk', $sector_id)->get('council_sector_master');
        return $query->result_array();
    }



    public function getAbnormallyExistAssessorList($id_hash = NULL)
    {
        return $this->db->select("cbam.batch_ems_id_fk, cbam.assessor_id_fk, cbam.exam_start_time, batch.batch_type, batch.batch_exam_date")
            ->from("council_batch_assessor_map AS cbam")
            ->join("council_assessor_exam_result_details AS result", "result.batch_id_fk = cbam.batch_ems_id_fk AND result.assessor_id_fk = cbam.assessor_id_fk", "LEFT")
            ->join("council_batch_ems AS batch", "batch.batch_ems_id_pk = cbam.batch_ems_id_fk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash,
                    "cbam.exam_status" => 1,
                    "result.marks" => NULL
                )
            )
            ->get()->result_array();
    }

    public function get_batch_questions($batch_id_hash = null)
    {
        $query = $this->db->select("*")
            ->from("council_batch_question_map as cbqm")
            ->where(
                array(
                    'MD5(CAST(cbqm.batch_id_fk AS character varying)) =' => $batch_id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAssessorAnswerSheet($batch_id_hash, $assessor_id_fk)
    {
        $this->db->where(array(
            'MD5(CAST(batch_ems_id_fk AS character varying)) =' => $batch_id_hash,
            'assessor_id_fk'  => $assessor_id_fk,
        ));
        return $this->db->get('council_assessor_answer_sheet')->result_array();
    }

    public function result_submit($data)
    {
        $this->db->trans_start();
        $this->db->insert('council_assessor_exam_result_details', $data);

        //echo $this->db->last_query(); die;

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    //Added by Waseem on 23-08-2021
    public function batch_wise_assessor_details($id_hash)
    {
        $query = $this->db->select("cbam.batch_assessor_map_id_pk, cbam.batch_ems_id_fk, cbam.eligibility, assessor.fname, assessor.lname, assessor.mobile_no, assessor.email_id")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash
                )
            )
            ->order_by("assessor.fname", "ASC")
            ->get();
        return $query->result_array();
    }

    //Added by Waseem on 23-08-2021
    public function update_exam_date_time($array = NULL, $id_hash = NULL)
    {
        $this->db->where('md5(cast(batch_ems_id_pk as character varying)) =', $id_hash);
        return $this->db->update('council_batch_ems', $array);
    }

    public function getAssessorLoginDetails($assessor_id)
    {
        return $this->db->where('stake_id_fk', 3)->where('stake_details_id_fk', $assessor_id)->get('council_stake_holder_login')->result_array();
    }
}
/* End of file Assessor_batch_model.php */
