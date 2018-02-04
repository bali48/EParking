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
class locations extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Locations_model');
        $this->isLoggedIn();
        if ($this->isAdmin() == TRUE) {
            
        }
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';

        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }


    /**
     * This function is used to load the user list
     */
    function locationListing() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('Locations_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Locations_model->LocationListingCount($searchText);

            $returns = $this->paginationCompress("locationListing/", $count, 15);

            $data['userRecords'] = $this->Locations_model->LocationListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'EParking : Location Listing';

            $this->loadViews("locations", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewloc() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('Locations_model');
            $this->global['pageTitle'] = 'EParking : Add New Location';

            $this->loadViews("location_view/addNewloc", $this->global, NULL, NULL);
        }
    }

    function addNewlocation() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('location', 'Location Name', 'trim|required|xss_clean');
             // overview
            // $this->form_validation->set_rules('input-file-preview','Company Logo','xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $locationname = ucwords(strtolower($this->input->post('location')));
                $compInfo = array('lname' => $locationname, 'createdDtm' => date('Y-m-d H:i:s'));
                
                $this->load->model('Locations_model');
                $result = $this->Locations_model->addNewLocation($compInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Location hasbeen added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Location creation failed');
                }

                redirect('addNew');
            }
        }
    }

    function editlocation($compId = NULL) {
        if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) {
            redirect('/');
        }
        if ($compId == null) {
            redirect('locationListing');
        }
        $data['LocationInfo'] = $this->Locations_model->getLocationInfo($compId);

        $this->global['pageTitle'] = 'EParking : Location';

        $this->loadViews("location_view/editlocation", $this->global, $data, NULL);
    }

//editCompany
    /**
     * This function is used to edit the user information
     */
    function locationupdate() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $compid = $this->input->post('compid');
            $this->form_validation->set_rules('location', 'Location Name', 'trim|required|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                $this->editlocation($compid);
            } else {
                $location = ucwords(strtolower($this->input->post('location')));
                
                // $userInfo = array();
                $compInfo = array('lname' => $location, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->Locations_model->editLocation($compInfo, $compid);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect('locationListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteLocation() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $compId = $this->input->post('id');
            //$userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->Locations_model->deleteLocation($compId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

}

?>