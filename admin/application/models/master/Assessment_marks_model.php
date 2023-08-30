<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_marks_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllMarksGroupByCourse()
    {
        $dataArray = array();

        $courseList = $this->db->select('course_id_fk')
            ->where('active_status', 1)
            ->group_by('course_id_fk')
            ->get('council_assessment_nos_course_marks_master')->result_array();

        if (!empty($courseList)) {
            foreach ($courseList as $key => $course) {

                $this->db->select('marks.*, course.course_name, course.course_code, sector.sector_name, sector.sector_code, pass_marks.total_marks, pass_marks.total_pass_marks')
                    ->from('council_assessment_nos_course_marks_master AS marks')
                    ->join("council_sector_master AS sector", "sector.sector_id_pk = marks.sector_id_fk", "LEFT")
                    ->join("council_course_master AS course", "course.course_id_pk = marks.course_id_fk", "LEFT")
                    ->join("council_assessment_course_pass_marks AS pass_marks", "pass_marks.course_id_fk = course.course_id_pk", "LEFT")
                    ->where('marks.course_id_fk', $course['course_id_fk'])
					->where('marks.active_status', 1);

                $result = $this->db->get()->result_array();

                $dataArray[] = array(
                    'sector_id_fk'       => $result[0]['sector_id_fk'],
                    'course_id_fk'       => $result[0]['course_id_fk'],
                    'course_name'        => $result[0]['course_name'],
                    'course_code'        => $result[0]['course_code'],
                    'sector_name'        => $result[0]['sector_name'],
                    'sector_code'        => $result[0]['sector_code'],
                    'total_marks'        => $result[0]['total_marks'],
                    'total_pass_marks'   => $result[0]['total_pass_marks'],
                    'nos_list'           => $result
                );
            }
        }

        return $dataArray;
    }

    public function getAllMarks()
    {
        $result = $this->db->select('marks.*, course.course_name, course.course_code, sector.sector_name, sector.sector_code')
            ->from('council_assessment_nos_course_marks_master AS marks')
            ->join("council_sector_master AS sector", "sector.sector_id_pk = marks.sector_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_id_pk = marks.course_id_fk", "LEFT")
            ->where(
                array(
                    'marks.active_status' => 1
                )
            );

        $result = $this->db->get();

        return $result->result_array();
    }

    public function getAllSector()
    {
        $this->db->where(
            array(
                'active_status' => 1
            )
        );

        $this->db->order_by('sector_name', 'ASC');

        $result = $this->db->get('council_sector_master');

        return $result->result_array();
    }

    public function getCourseBySectorId($sector_id = NULL)
    {
        $this->db->where(
            array(
                'active_status'  => 1,
                'sector_id_fk'   => $sector_id
            )
        );

        $this->db->order_by('course_name', 'ASC');

        $result = $this->db->get('council_course_master');

        return $result->result_array();
    }

    public function insertNosMarks($nosMarksArray = NULL, $passMarksArray = NULL)
    {
        $result = $this->db->insert('council_assessment_nos_course_marks_master', $nosMarksArray);
        $nos_id = $this->db->insert_id();

        if ($nos_id) {

            $this->db->where('course_id_fk', $passMarksArray['course_id_fk']);
            $data =  $this->db->get('council_assessment_course_pass_marks')->result_array();

            if (!empty($data)) {

                $course_id_fk = $passMarksArray['course_id_fk'];

                unset($passMarksArray['course_id_fk']);

                $this->db->where("course_id_fk", $course_id_fk)->update('council_assessment_course_pass_marks', $passMarksArray);

                return $this->db->affected_rows();
            } else {

                $this->db->insert('council_assessment_course_pass_marks', $passMarksArray);

                return $this->db->insert_id();
            }
        }
    }

    public function getMarksByCourseId($course_id)
    {
        $this->db->where('course_id_fk', $course_id);
        $this->db->where("active_status", 1);

        return $this->db->get('council_assessment_nos_course_marks_master')->result_array();
    }

    public function getAllNosType()
    {
        $this->db->where('active_status', 1);
        $this->db->order_by('nos_name');
        return $this->db->get('council_nos_master')->result_array();
    }

    public function getSectorJobRoleDetails($course_id = NULL)
    {
        $this->db->select('
            course.course_id_pk, 
            course.sector_id_fk, 
            course.course_name, 
            course.course_code, 
            sector.sector_name, 
            sector.sector_code,
            cpm.total_marks,
            cpm.total_pass_marks,
            cpm.pass_in_every_nos
        ')
            ->from('council_course_master AS course')
            ->join("council_sector_master AS sector", "sector.sector_id_pk = course.sector_id_fk", "LEFT")
            ->join("council_assessment_course_pass_marks AS cpm", "cpm.course_id_fk = course.course_id_pk", "LEFT")
            ->where('course_id_pk', $course_id);

        return $this->db->get()->result_array();
    }

    public function getMarksByCourseIdHash($course_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(course_id_fk as character varying)) =", $course_id_hash);
        $this->db->where("active_status", 1);

        return $this->db->get('council_assessment_nos_course_marks_master')->result_array();
    }

    public function getSectorJobRoleDetailsHash($course_id_hash = NULL)
    {
        $this->db->select('
            course.course_id_pk, 
            course.sector_id_fk, 
            course.course_name, 
            course.course_code, 
            sector.sector_name, 
            sector.sector_code,
            cpm.total_marks,
            cpm.total_pass_marks,
            cpm.pass_in_every_nos
        ')
            ->from('council_course_master AS course')
            ->join("council_sector_master AS sector", "sector.sector_id_pk = course.sector_id_fk", "LEFT")
            ->join("council_assessment_course_pass_marks AS cpm", "cpm.course_id_fk = course.course_id_pk", "LEFT")
            ->where("MD5(CAST(course_id_pk as character varying)) =", $course_id_hash);

        return $this->db->get()->result_array();
    }

    public function getNosDetailsByIdHash($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(course_marks_id_pk as character varying)) =", $id_hash);
        return $this->db->get('council_assessment_nos_course_marks_master')->result_array();
    }

    public function updateCoursePassMarks($course_id, $updateArray)
    {
        $this->db->where("course_id_fk", $course_id);
        $this->db->update('council_assessment_course_pass_marks', $updateArray);

        return true;
    }

    public function updateNosMarks($id, $updateArray)
    {
        $this->db->where("course_marks_id_pk", $id);
        $this->db->update('council_assessment_nos_course_marks_master', $updateArray);

        return true;
    }

    public function updateNosMarksByidHash($idHash, $updateArray)
    {
        $this->db->where("MD5(CAST(course_marks_id_pk as character varying)) =", $idHash);
        $this->db->update('council_assessment_nos_course_marks_master', $updateArray);

        return true;
    }

    public function deleteCourseNos($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(course_marks_id_pk as character varying)) =", $id_hash);
        $this->db->delete('council_assessment_nos_course_marks_master');
    }

    public function deleteCoursePassMarks($course_id = NULL)
    {
        $this->db->where("course_id_fk", $course_id);
        $this->db->delete('council_assessment_course_pass_marks');
    }

    public function getNosDetailsToUpdate($id_hash = NULL)
    {
        $this->db->select('nos.*, pass_marks.total_marks, pass_marks.total_pass_marks, pass_marks.pass_in_every_nos')
            ->from('council_assessment_nos_course_marks_master AS nos')
            ->join('council_assessment_course_pass_marks AS pass_marks', 'pass_marks.course_id_fk = nos.course_id_fk', 'left')
            ->where("MD5(CAST(nos.course_marks_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->result_array();
    }
}

/* End of file Map_district_model.php */
