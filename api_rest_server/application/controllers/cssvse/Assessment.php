<?php defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('council_cssvse_assessment_response');
    }

    public function batch_response_post()
    {
        $responseData = $this->post();

        if (isset($responseData['verticalId']) && ($responseData['verticalId'] == 'CSSVSE')) {
            $set_response = $this->council_cssvse_assessment_response->set_batch_response_council_assessment($responseData);

            if ($set_response['code'] == 1) {
                $this->response(
                    array(
                        "responseMsg"    => array(
                            "type"            => "SUCCESS",
                            "code"            => "SM8",
                            "msgDetails"    => "Response Consumed Successfully"
                        ),
                        'requestedData'    => $responseData
                    ),
                    REST_Controller::HTTP_OK
                );
            } else {
                $this->response(
                    array(
                        "responseMsg"    => array(
                            "type"            => "SUCCESS",
                            "code"            => "SM9",
                            "msgDetails"    => "Response Consumption Failed"
                        ),
                        'requestedData'    => $responseData
                    ),
                    REST_Controller::HTTP_OK
                );
            }
        } else {
            $this->response(
                array(
                    "responseMsg"    => array(
                        "type"            => "ERROR",
                        "code"            => "EM3",
                        "msgDetails"    => "Invalid Vertical ID"
                    ),
                    'requestedData'    => $responseData
                ),
                REST_Controller::HTTP_OK
            );
        }
    }
}
