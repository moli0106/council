<?php defined('BASEPATH') or exit('No direct script access allowed');

class Council_cssvse_assessment_response
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('cssvse/council_assessment_response_model');
    }

    public function set_batch_response_council_assessment($response_array = NULL)
    {
        if (isset($response_array['responseMsg']['code']) && ($response_array['verticalId'] == 'CSSVSE')) {

            $response_code = $response_array['responseMsg']['code'];

            $response_msg_type = $this->get_response_type_id($response_code);

            return $this->set_council_response($response_msg_type, $response_array);
        } else {
            return FALSE;
        }
    }

    public function get_response_type_id($response_code = NULL)
    {
        $response_type = $this->ci->council_assessment_response_model->get_council_response_type($response_code);

        if (count($response_type) > 0) {
            return $response_type[0]['council_response_message_id_pk'];
        } else {
            return 0;
        }
    }

    public function set_council_response($response_type = NULL, $response_array = NULL)
    {
        if ($response_type == 3) {
            return $this->get_assessor_assigned_batch_response($response_type, $response_array);
        } else if ($response_type == 4) {
            return $this->get_assessor_approval_inability_batch_response($response_type, $response_array);
        } else if ($response_type == 5) {
            return $this->get_assessment_completed_batch_response($response_type, $response_array);  // Assessment Completed Response
        } else {
            return NULL;
        }
    }

    public function date_format_us($date_uk = NULL)
    {
        return date('Y-m-d', strtotime($date_uk));
    }

    public function set_raw_json_file($response_array = NULL, $batch_code = NULL, $response_type = NULL)
    {
        $council_assessment_json_data = array(
            'batch_code'                            => $batch_code,
            'json_data_type_id_fk'                    => 2,
            'response_message_id_fk'        => $response_type,
            'assessment_json_file'            => json_encode($response_array, TRUE),
            'entry_ip'                                => $this->ci->input->ip_address(),
            'entry_by_login_id_fk'                    => $this->ci->session->userdata('stake_holder_login_id_pk'),
            'entry_by_stake_id_fk'                    => $this->ci->session->userdata('stake_id_fk'),
            'active_status'                            => 1
        );

        return $this->ci->council_assessment_response_model->set_council_assessment_json_data($council_assessment_json_data);
    }

    public function get_assessor_assigned_batch_response($response_type = NULL, $response_array = NULL)
    {
        $rtn_array = array();
        $this->ci->db->trans_begin();

        $batch_code = $response_array['data']['councilBatchDetails']['userBatchId'];
        $rtn_array['raw_json'] = $this->set_raw_json_file($response_array, $batch_code, $response_type);

        $check_previous_response = $this->ci->council_assessment_response_model->get_previous_received_response($batch_code);
        if ($check_previous_response == 1) {

            $batch_update_array = array(
                'council_response_message_id_fk'            => $response_type,
                'flag_assessor_assigned'                        => 1,
                'assessor_assigned_council_json_data_id_fk'        => $rtn_array['raw_json'],
                'council_batch_status'                            => $response_array['data']['councilBatchDetails']['councilBatchStatus']
            );
            $rtn_array['batch'] = $this->ci->council_assessment_response_model->update_batch_response($batch_code, $batch_update_array);
        } else {

            $batch_dtls = array(
                'vertical_code'                                    => $response_array['verticalId'],
                'assessment_scheme_id'                            => $response_array['data']['assessmentSchemeId'],
                'assessment_scheme_name'                        => $response_array['data']['assessmentSchemeName'],
                'user_batch_code'                                => $response_array['data']['councilBatchDetails']['userBatchId'],
                'council_batch_id'                                => $response_array['data']['councilBatchDetails']['councilBatchId'],
                'council_batch_status'                            => $response_array['data']['councilBatchDetails']['councilBatchStatus'],

                'council_response_message_id_fk'                => $response_type,
                'flag_assessor_assigned'                        => 1,
                'assessor_assigned_council_json_data_id_fk'        => $rtn_array['raw_json'],

                'entry_ip'                                        => $this->ci->input->ip_address(),
                'entry_by_login_id_fk'                            => $this->ci->session->userdata('stake_holder_login_id_pk'),
                'entry_by_stake_id_fk'                            => $this->ci->session->userdata('stake_id_fk'),
                'active_status'                                     => 1
            );

            $set_batch_assessment = $this->ci->council_assessment_response_model->set_council_assessment_batch_response($batch_dtls);
            $rtn_array['batch'] = $set_batch_assessment;

            $i = 0;
            foreach ($response_array['data']['councilBatchDetails']['candidates'] as $list) {
                $candidate = array(
                    'council_trainee_id'                    => $list['councilTraineeId'],
                    'user_trainee_code'                        => $list['traineeId'],
                    'user_trainee_name'                        => $list['traineeName'],
                    'user_batch_code'                        => $response_array['data']['councilBatchDetails']['userBatchId'],
                    'council_batch_id'                        => $response_array['data']['councilBatchDetails']['councilBatchId'],
                    'council_ass_batch_response_id_fk'        => $set_batch_assessment,
                    'entry_ip'                                => $this->ci->input->ip_address(),
                    'entry_by_login_id_fk'                    => $this->ci->session->userdata('stake_holder_login_id_pk'),
                    'entry_by_stake_id_fk'                    => $this->ci->session->userdata('stake_id_fk'),
                    'process_status_id_fk'                    => 1,
                    'active_status'                            => 1
                );

                $trainee_response = $this->ci->council_assessment_response_model->set_council_assessment_trainee_response($candidate);
                $rtn_array['candidate'][$i++] = $trainee_response;
            }
        }

        $this->ci->council_assessment_response_model->update_cssvse_batch_details($batch_code, array('process_id_fk' => 8));

        if ($this->ci->db->trans_status() === FALSE) {
            $this->ci->db->trans_rollback();
            $rtn_array['code'] = '0';
        } else {
            $this->ci->db->trans_commit();
            $rtn_array['code'] = '1';
        }

        return $rtn_array;
    }

    public function get_assessor_approval_inability_batch_response($response_type = NULL, $response_array = NULL)
    {
        $this->ci->db->trans_begin();
        $rtn_array = array();

        $batch_code = $response_array['data']['councilBatchDetails']['userBatchId'];
        $rtn_array['raw_json'] = $this->set_raw_json_file($response_array, $batch_code, $response_type);

        $check_previous_response = $this->ci->council_assessment_response_model->get_previous_received_response($batch_code);
        if ($check_previous_response == 1) {
            $batch_update_array = array(
                'council_response_message_id_fk'                => $response_type,
                'proposed_assessment_date'                        => $response_array['data']['councilBatchDetails']['dateTimes']['proposedAssessmentDate'],
                'flag_assessor_accepted_inability'                => 1,
                'assessor_accepted_council_json_data_id_fk'        => $rtn_array['raw_json'],
                'council_batch_status'                            => $response_array['data']['councilBatchDetails']['councilBatchStatus']
            );
            $set_batch = $this->ci->council_assessment_response_model->update_batch_response($batch_code, $batch_update_array);

            /* Assessor Details Array */
            $inactive_assessor_array = array(
                'active_status'                => 0,
                'update_time'                => "now()",
                'update_ip'                    => $this->ci->input->ip_address(),
            );
            $inactive_assessor = $this->ci->council_assessment_response_model->update_assessor_inactive($batch_code, $inactive_assessor_array);

            $assessor_array = array(
                'user_batch_code'                        => $batch_code,
                'assessor_name'                            => $response_array['data']['councilBatchDetails']['assessorDetails']['assessorName'],
                'assessor_id'                            => $response_array['data']['councilBatchDetails']['assessorDetails']['assessorId'],
                'assessor_email'                        => $response_array['data']['councilBatchDetails']['assessorDetails']['email'],
                'assessor_mobile_no'                    => $response_array['data']['councilBatchDetails']['assessorDetails']['mobile'],
                'assessor_assignment_status_id'            => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusId'],
                'assessor_assignment_status_name'        => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusName'],
                'assessor_assigned_date'                => $response_array['data']['councilBatchDetails']['dateTimes']['assessorAssignDate'],
                'assessor_action_date'                    => $response_array['data']['councilBatchDetails']['dateTimes']['assessorActionDate'],
                'proposed_assessment_date'                => $response_array['data']['councilBatchDetails']['dateTimes']['proposedAssessmentDate'],
                // 'assessor_approve_inability_comments'    => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['actionComments'],
                'entry_ip'                                => $this->ci->input->ip_address(),
                'process_status_id_fk'                    => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusId'],
                'active_status'                            => 1,
            );
            $assessor_response = $this->ci->council_assessment_response_model->set_council_assessor_assigned_response($assessor_array);

            $rtn_array['assessor_assigned'] = $assessor_response;
            /* Assessor Details Array */
            $rtn_array['batch'] = $set_batch;
        } else {

            $batch_dtls = array(
                'vertical_code'                                    => $response_array['verticalId'],
                'assessment_scheme_id'                            => $response_array['data']['assessmentSchemeId'],
                'assessment_scheme_name'                        => $response_array['data']['assessmentSchemeName'],
                'user_batch_code'                                => $response_array['data']['councilBatchDetails']['userBatchId'],
                'council_batch_id'                                => $response_array['data']['councilBatchDetails']['councilBatchId'],
                'council_batch_status'                            => $response_array['data']['councilBatchDetails']['councilBatchStatus'],
                //'council_batch_creation_date'					=> $this->date_format_us($response_array['data']['councilBatchDetails']['dateTimes']['councilBatchCreatedDate']),
                //'council_ssc_assigned_date'						=> $this->date_format_us($response_array['data']['councilBatchDetails']['dateTimes']['sscAssignDate']),
                'proposed_assessment_date'                        => $response_array['data']['councilBatchDetails']['dateTimes']['proposedAssessmentDate'],

                'council_sector_code'                            => $response_array['data']['councilBatchDetails']['jobRoles']['sectorDetails']['sectorId'],
                'council_sector_name'                            => $response_array['data']['councilBatchDetails']['jobRoles']['sectorDetails']['sectorName'],

                'council_course_name'                            => $response_array['data']['councilBatchDetails']['jobRoles']['courseDetails']['courseName'],
                'council_course_code'                            => $response_array['data']['councilBatchDetails']['jobRoles']['courseDetails']['courseCode'],

                'council_tp_id'                                    => $response_array['data']['tpDetails']['councilTpId'],
                'council_tp_name'                                => $response_array['data']['tpDetails']['councilTpName'],
                'user_tp_code'                                    => $response_array['data']['tpDetails']['userTpId'],
                'user_tp_name'                                    => $response_array['data']['tpDetails']['userTpName'],

                'council_tc_id'                                    => $response_array['data']['tcDetails']['councilTcId'],
                'council_tc_name'                                => $response_array['data']['tcDetails']['councilTcName'],
                'user_tc_code'                                    => $response_array['data']['tcDetails']['userTcId'],
                'user_tc_name'                                    => $response_array['data']['tcDetails']['userTcName'],

                'council_response_message_id_fk'                => $response_type,
                'flag_assessor_accepted_inability'                => 1,
                'assessor_accepted_council_json_data_id_fk'        => $rtn_array['raw_json'],

                'entry_ip'                                        => $this->ci->input->ip_address(),
                'entry_by_login_id_fk'                            => $this->ci->session->userdata('stake_holder_login_id_pk'),
                'entry_by_stake_id_fk'                            => $this->ci->session->userdata('stake_id_fk'),
                'active_status'                                     => 1
            );

            $set_batch_assessment = $this->ci->council_assessment_response_model->set_council_assessment_batch_response($batch_dtls);
            $rtn_array['batch'] = $set_batch_assessment;

            /************** Trainee array from response ******************/
            $i = 0;
            foreach ($response_array['data']['councilBatchDetails']['candidates'] as $list) {
                $candidate = array(
                    'council_trainee_id'                    => $list['councilTraineeId'],
                    'user_trainee_code'                        => $list['traineeId'],
                    'user_trainee_name'                        => $list['traineeName'],
                    'user_batch_code'                        => $response_array['data']['councilBatchDetails']['userBatchId'],
                    'council_batch_id'                        => $response_array['data']['councilBatchDetails']['councilBatchId'],
                    'council_ass_batch_response_id_fk'        => $set_batch_assessment,
                    'entry_ip'                                => $this->ci->input->ip_address(),
                    'entry_by_login_id_fk'                    => $this->ci->session->userdata('stake_holder_login_id_pk'),
                    'entry_by_stake_id_fk'                    => $this->ci->session->userdata('stake_id_fk'),
                    'process_status_id_fk'                    => 1,
                    'active_status'                            => 1
                );
                $trainee_response = $this->ci->council_assessment_response_model->set_council_assessment_trainee_response($candidate);
                $rtn_array['candidate'][$i] = $trainee_response;
                $i++;
            }
            /************** Trainee array from response ******************/

            /* Assessor Details Array */
            $assessor_array = array(
                'user_batch_code'                        => $batch_code,
                'assessor_name'                            => $response_array['data']['councilBatchDetails']['assessorDetails']['assessorName'],
                'assessor_id'                            => $response_array['data']['councilBatchDetails']['assessorDetails']['assessorId'],
                'assessor_email'                        => $response_array['data']['councilBatchDetails']['assessorDetails']['email'],
                'assessor_mobile_no'                    => $response_array['data']['councilBatchDetails']['assessorDetails']['mobile'],
                'assessor_assignment_status_id'            => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusId'],
                'assessor_assignment_status_name'        => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusName'],
                'assessor_assigned_date'                => $response_array['data']['councilBatchDetails']['dateTimes']['assessorAssignDate'],
                'assessor_action_date'                    => $response_array['data']['councilBatchDetails']['dateTimes']['assessorActionDate'],
                'proposed_assessment_date'                => $response_array['data']['councilBatchDetails']['dateTimes']['proposedAssessmentDate'],
                // 'assessor_approve_inability_comments'    => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['actionComments'],
                'entry_ip'                                => $this->ci->input->ip_address(),
                'process_status_id_fk'                    => $response_array['data']['councilBatchDetails']['assessorDetails']['actionStatus']['statusId'],
                'active_status'                            => 1,
            );
            $assessor_response = $this->ci->council_assessment_response_model->set_council_assessor_assigned_response($assessor_array);
            $rtn_array['assessor_assigned'] = $assessor_response;
            /* Assessor Details Array */
        }

        $this->ci->council_assessment_response_model->update_cssvse_batch_details($batch_code, array('process_id_fk' => 9));

        if ($this->ci->db->trans_status() === FALSE) {
            $this->ci->db->trans_rollback();
            $rtn_array['code'] = '0';
        } else {
            $this->ci->db->trans_commit();
            $rtn_array['code'] = '1';
        }

        return $rtn_array;
    }

    public function get_assessment_completed_batch_response($response_type = NULL, $response_array = NULL)
    {
        $this->ci->db->trans_begin();
        $rtn_array = array();

        $batch_code = $response_array['data']['councilBatchDetails']['userBatchId'];
        $rtn_array['raw_json'] = $this->set_raw_json_file($response_array, $batch_code, $response_type);

        $chk_already_received = $this->ci->council_assessment_response_model->get_already_received_response($batch_code, 5);
        if ($chk_already_received == 0) {

            $check_previous_response = $this->ci->council_assessment_response_model->get_previous_received_response($batch_code);
            if ($check_previous_response == 1) {

                $batch_update_array = array(
                    'council_response_message_id_fk'                => $response_type,
                    'assessment_completed_date'                        => $response_array['data']['councilBatchDetails']['dateTimes']['assessmentCompletedDate'],
                    'flag_assessment_completed'                        => 1,
                    'assessment_completed_council_json_data_id_fk'    => $rtn_array['raw_json'],
                    'council_batch_status'                            => $response_array['data']['councilBatchDetails']['councilBatchStatus'],
                );

                $set_batch = $this->ci->council_assessment_response_model->update_batch_response($batch_code, $batch_update_array);
                $rtn_array['batch'] = $set_batch;

                $this->ci->council_assessment_response_model->update_cssvse_batch_details($batch_code, array('process_id_fk' => 13));

                if ($this->ci->db->trans_status() === FALSE) {
                    $this->ci->db->trans_rollback();
                    $rtn_array['code'] = '0';
                } else {
                    $this->ci->db->trans_commit();
                    $rtn_array['code'] = '1';
                }
            } else {
                $rtn_array['code'] = '0';
            }
        } else {
            $rtn_array['code'] = '0';
        }
        return $rtn_array;
    }
}

/* End of file Council_cssvse_assessment_response.php */
