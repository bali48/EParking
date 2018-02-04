<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Reports extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Reports_model');
        $this->isLoggedIn();
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            
        }
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        $this->global['pageTitle'] = 'EParking : Dashboard';
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function reportsListing() {

        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }elseif ($this->session->userdata('role') == 3) {
            $this->load->model('Reports_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reports_model->reportListingCount($searchText);

            $returns = $this->paginationCompress("reportsListing/", $count, 15);
            
            $data['userRecords'] = $this->Reports_model->reportListing($searchText, $returns["page"], $returns["segment"],$this->session->userdata('comp'));

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reports", $this->global, $data, NULL);
        }else{
            $this->load->model('Reports_model');
            
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reports_model->reportListingCount($searchText);

            $returns = $this->paginationCompress("reportsListing/", $count, 15);
            
            $data['userRecords'] = $this->Reports_model->reportListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reports", $this->global, $data, NULL);
        }
    }
    
    
function reportstoday(){
    
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }elseif ($this->session->userdata('role') == 3) {
            $this->load->model('Reports_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reports_model->reportListingCount($searchText,'',date('Y-m-d'),'');

            $returns = $this->paginationCompress("reportstoday/", $count, 15);
            
            $data['userRecords'] = $this->Reports_model->reportListing($searchText, $returns["page"], $returns["segment"],$this->session->userdata('comp'),date('Y-m-d'));

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reports", $this->global, $data, NULL);
        }else{
            $this->load->model('Reports_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reports_model->reportListingCount($searchText,'',date('Y-m-d'),'');

            $returns = $this->paginationCompress("reportstoday/", $count, 15);
            
            $data['userRecords'] = $this->Reports_model->reportListing($searchText, $returns["page"], $returns["segment"],'',date('Y-m-d'));

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reports", $this->global, $data, NULL);
        }
}    

//    function editReport($compId = NULL) {
//
//        if ($compId == null) {
//            redirect('reportsListing');
//        }
//        $data['ReportInfo'] = $this->Reports_model->getReportInfo($compId);
//
//        $this->global['pageTitle'] = 'EParking : Edit Report';
//
//        $this->loadViews("reports_view/editcompany", $this->global, $data, NULL);
//    }

//editReport
    /**
     * This function is used to edit the user information
     */
//    function Reportupdate() {
//
//        if ($this->isAdmin() == TRUE) {
//            $this->loadThis();
//        } else {
//            $this->load->library('form_validation');
//
//            $compid = $this->input->post('compid');
//
//            $this->form_validation->set_rules('companyname', 'Report Name', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
//            $this->form_validation->set_rules('Feature1', 'Feature1', 'trim|xss_clean');
//            $this->form_validation->set_rules('Feature2', 'Feature2', 'trim|xss_clean');
//            $this->form_validation->set_rules('Feature3', 'Feature3', 'trim|xss_clean');
//            $this->form_validation->set_rules('companyoverview', 'Report Overview', 'xss_clean');
//
//            if ($this->form_validation->run() == FALSE) {
//                $this->editReport($compid);
//            } else {
//                $companyname = ucwords(strtolower($this->input->post('companyname')));
//                $rate = $this->input->post('rate');
//                $Feature1 = $this->input->post('Feature1');
//                $Feature2 = $this->input->post('Feature2');
//                $Feature3 = $this->input->post('Feature3');
//                $overview = $this->input->post('companyoverview');
//
//                // $userInfo = array();
//                $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
//                    'feature3' => $Feature3, 'overview' => $overview, 'updatedDtm' => date('Y-m-d H:i:s'));
//
//                $result = $this->Reports_model->editReport($compInfo, $compid);
//
//                if ($result == true) {
//                    $this->session->set_flashdata('success', 'Report updated successfully');
//                } else {
//                    $this->session->set_flashdata('error', 'Report updation failed');
//                }
//
//                redirect('reportsListing');
//            }
//        }
//    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteReport() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $compId = $this->input->post('compId');
            //$userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->Reports_model->deleteReport($compId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

  
}

?>