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
class Reviews extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Reviews_model');
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
    function reviewsListing() {

        if ($this->session->userdata('role') == 2) {
            redirect('/');
        } elseif ($this->session->userdata('role') == 3) {
            $this->load->model('Reviews_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reviews_model->reportListingCount($searchText);

            $returns = $this->paginationCompress("reviewsListing/", $count, 15);

            $data['userRecords'] = $this->Reviews_model->reportListing($searchText, $returns["page"], $returns["segment"], $this->session->userdata('comp'));

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reviews", $this->global, $data, NULL);
        } else {
            $this->load->model('Reviews_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Reviews_model->reportListingCount($searchText);

            $returns = $this->paginationCompress("reviewsListing/", $count, 15);

            $data['userRecords'] = $this->Reviews_model->reportListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'EParking : Booking Listing';

            $this->loadViews("reviews", $this->global, $data, NULL);
        }
    }

    function editReview($compId = NULL) {

        if ($compId == null) {
            redirect('reviewsListing');
        }
        $data['ReviewInfo'] = $this->Reviews_model->getReviewInfo($compId);
        $this->load->model('Companies_model');
        $data['companies'] = $this->Companies_model->companyListing('', '', '');
        $this->global['pageTitle'] = 'EParking : Edit Review';

        $this->loadViews("reviews_view/editreview", $this->global, $data, NULL);
    }

//editReview
    /**
     * This function is used to edit the user information
     */
    function Reviewupdate() {

        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $compid = $this->input->post('compid');
            $this->form_validation->set_rules('Reviewname', 'Review Name', 'trim|required|numeric');
            $this->form_validation->set_rules('Review', 'Review', 'required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $this->editReview($compid);
            } else {
                 $reviewid = $this->input->post('Reviewname');
                $review = $this->input->post('Review');
                // $userInfo = array();
                $userInfo = array('review' => $review, 'company' => $reviewid);
                $this->load->model('Reviews_model');
                $result = $this->Reviews_model->editReview($userInfo, $compid);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Review updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Review updation failed');
                }

                redirect('reviewlist');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteReview() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $compId = $this->input->post('compId');
            //$userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->Reviews_model->deleteReview($compId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

    function addNewreview() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('Reviews_model');
            $this->load->model('Companies_model');
            $data['companies'] = $this->Companies_model->companyListing('', '', '');
            $this->global['pageTitle'] = 'EParking : Add New Review';

            $this->loadViews("Reviews_view/addreview", $this->global, $data, NULL);
        }
    }

    function addReview() {

        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('Reviewname', 'Review Name', 'trim|required|numeric');
            $this->form_validation->set_rules('Review', 'Review', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {

                $this->addNewreview();
            } else {
                $reviewid = $this->input->post('Reviewname');
                $review = $this->input->post('Review');

                $userInfo = array('review' => $review, 'company' => $reviewid);

                $this->load->model('Reviews_model');
//                echo 'here'; exit();//Your services are Owsome
                $result = $this->Reviews_model->addNewReview($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Review Created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Review failed');
                }

                redirect('reviewlist');
            }
        }
    }

}

?>