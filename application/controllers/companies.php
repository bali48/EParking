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
class companies extends BaseController {

    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Companies_model');
        $this->isLoggedIn();
        if ($this->isAdmin() == TRUE) {
            
        }
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';

        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function companiesListing() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('Companies_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Companies_model->companyListingCount($searchText);

            $returns = $this->paginationCompress("companiesListing/", $count, 15);

            $data['userRecords'] = $this->Companies_model->companyListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'EParking : Companies Listing';

            $this->loadViews("companies", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewcomp() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('Companies_model');
            $this->global['pageTitle'] = 'EParking : Add New Company';

            $this->loadViews("companies_view/addNewcomp", $this->global, NULL, NULL);
        }
    }

    function addNewCompany() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            if (isset($_FILES['input-file-preview']['name'])) {


                $config = array(
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'max_width' => 500,
                    'max_height' => 500
                );

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('input-file-preview')) {
                    $data = array('upload_data' => $this->upload->data());
                } else {
                    $this->session->set_flashdata('error', 'Image File size should be File Size less then 500 * 500');
                    redirect('addNewcomp');
                }
            }
            $this->form_validation->set_rules('companyname', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
            $this->form_validation->set_rules('Feature1', 'Feature1', 'trim|xss_clean');
            $this->form_validation->set_rules('Feature2', 'Feature2', 'trim|xss_clean');
            $this->form_validation->set_rules('Feature3', 'Feature3', 'trim|xss_clean');
            $this->form_validation->set_rules('companyoverview', 'Company Overview', 'xss_clean');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            // overview
            // $this->form_validation->set_rules('input-file-preview','Company Logo','xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $companyname = ucwords(strtolower($this->input->post('companyname')));
                $rate = $this->input->post('rate');
                $Feature1 = $this->input->post('Feature1');
                $Feature2 = $this->input->post('Feature2');
                $Feature3 = $this->input->post('Feature3');
                $overview = $this->input->post('companyoverview');
                //   $email = $this->input->post('email');
                $isbann = $this->input->post('isbann');
                $featured = $this->input->post('isfeatured');
                if(empty($featured) || $featured == NULL){
                   $featured = 0;
                }elseif($featured == 'on'){
                    $featured = 1;
                }
                
              //  echo '<pre>'; var_dump($_POST);exit();
                if (isset($data['upload_data']['file_name'])) {

                    $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                        'feature3' => $Feature3, 'overview' => $overview, 'createdDtm' => date('Y-m-d H:i:s'), 'company_logo' => $data['upload_data']['file_name'],'featured' => $featured);
                } else {
                    $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                        'feature3' => $Feature3, 'overview' => $overview, 'createdDtm' => date('Y-m-d H:i:s'),'featured' => $featured);
                }
                $this->load->model('Companies_model');
                $result = $this->Companies_model->addNewCompany($compInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Company hasbeen added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company creation failed');
                }

                redirect('addNewcomp'); //addNewcomp
            }
        }
    }

    function editCompany($compId = NULL) {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($compId == null) {
            redirect('companiesListing');
        }
        $data['CompanyInfo'] = $this->Companies_model->getCompanyInfo($compId);

        $this->global['pageTitle'] = 'EParking : Edit Company';

        $this->loadViews("companies_view/editcompany", $this->global, $data, NULL);
    }

//editCompany
    /**
     * This function is used to edit the user information
     */
    function Companyupdate() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
//            print_r($_FILES['input-file-preview']['name']); exit();
            $this->form_validation->set_rules('compid', 'compid', 'required|numeric');
            $compid = $this->input->post('compid');
            if (isset($_FILES['input-file-preview']['name']) && $_FILES['input-file-preview']['name'] != NULL) {
                

                $config = array(
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'max_width' => 500,
                    'max_height' => 500
                );
//                echo 'here';                exit();
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('input-file-preview')) {
                    $data = array('upload_data' => $this->upload->data());
                } else {
                    $this->session->set_flashdata('error', 'Image File size should be File Size less then 500 * 500');
//                    redirect('editCompany/'.$compid'//);
                    //echo 'here ';                    exit();
                    redirect('editCompany/'.$compid);
                    //$this->editCompany($compid);
                }
            }
            $compid = $this->input->post('compid');

            $this->form_validation->set_rules('companyname', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
            $this->form_validation->set_rules('Feature1', 'Feature1', 'trim|xss_clean');
            $this->form_validation->set_rules('Feature2', 'Feature2', 'trim|xss_clean');
            $this->form_validation->set_rules('Feature3', 'Feature3', 'trim|xss_clean');
            $this->form_validation->set_rules('companyoverview', 'Company Overview', 'xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->editCompany($compid);
            } else {
                $companyname = ucwords(strtolower($this->input->post('companyname')));
                $rate = $this->input->post('rate');
                $Feature1 = $this->input->post('Feature1');
                $Feature2 = $this->input->post('Feature2');
                $Feature3 = $this->input->post('Feature3');
                $overview = $this->input->post('companyoverview');
                $isbann = $this->input->post('isbann');
                $bannfrom = $this->input->post('bannfrom');
                $bannto = $this->input->post('bannto');
                $featured = $this->input->post('isfeatured');
               // echo $featured;                exit();
                if(empty($featured) || $featured == NULL){
                    $featured = 0;
                } else {
                    $featured = 1;
                }
                if (isset($data['upload_data']['file_name'])) {
                    //                  var_dump($_FILES); exit();
                    if (isset($isbann) && $isbann == 'on') {
                        $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                            'feature3' => $Feature3, 'overview' => $overview, 'updatedDtm' => date('Y-m-d H:i:s'), 'isbann' => 1, 'bannfrom' => $bannfrom, 'bannto' => $bannto, 'company_logo' => $data['upload_data']['file_name'],'featured' =>$featured);
                    } else {

                        $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                            'feature3' => $Feature3, 'overview' => $overview, 'updatedDtm' => date('Y-m-d H:i:s'), 'isbann' => 0, 'bannfrom' => '0000-00-00 00:00:00', 'bannto' => '0000-00-00 00:00:00', 'company_logo' => $data['upload_data']['file_name'],'featured' =>$featured);
                    }
                } else {
                    if (isset($isbann) && $isbann == 'on') {
                        $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                            'feature3' => $Feature3, 'overview' => $overview, 'updatedDtm' => date('Y-m-d H:i:s'), 'isbann' => 1, 'bannfrom' => $bannfrom, 'bannto' => $bannto,'featured' =>$featured);
                    } else {

                        $compInfo = array('name' => $companyname, 'rate' => $rate, 'feature1' => $Feature1, 'feature2' => $Feature2,
                            'feature3' => $Feature3, 'overview' => $overview, 'updatedDtm' => date('Y-m-d H:i:s'), 'isbann' => 0, 'bannfrom' => '0000-00-00 00:00:00', 'bannto' => '0000-00-00 00:00:00','featured' =>$featured);
                    }
                }
                $result = $this->Companies_model->editCompany($compInfo, $compid);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }

                redirect('companiesListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany() {
        if ($this->session->userdata('role') == 2) {
            redirect('/');
        }
        if ($this->isAdmin() == TRUE) {
            echo(json_encode(array('status' => 'access')));
        } else {
            $compId = $this->input->post('compId');
            //$userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->Companies_model->deleteCompany($compId);

            if ($result > 0) {
                echo(json_encode(array('status' => TRUE)));
            } else {
                echo(json_encode(array('status' => FALSE)));
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
//    function checkEmailExists() {
//        $userId = $this->input->post("userId");
//        $email = $this->input->post("email");
//
//        if (empty($userId)) {
//            $result = $this->user_model->checkEmailExists($email);
//        } else {
//            $result = $this->user_model->checkEmailExists($email, $userId);
//        }
//
//        if (empty($result)) {
//            echo("true");
//        } else {
//            echo("false");
//        }
//    }
}

?>