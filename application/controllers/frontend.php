<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontend
 *
 * @author Muhammad Bilal
 */
class frontend extends CI_Controller {

    protected $searchdata = array();
    //put your code here
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('Locations_model');
        //$count = $this->Locations_model->LocationListingCount($searchText);
        $data['userRecords'] = $this->Locations_model->LocationListing('', '', '');

        $token = md5(time() . rand());
        $data['token'] = $token;
        $tokkenArray = array(
            'token' => $token
        );

        $this->session->set_userdata($tokkenArray);
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/home', $data);
        $this->load->view('frontend/frontfooter');
    }

    function search() {
        $tokenarray = $this->input->get();


        if ($tokenarray['token'] == $this->session->userdata('token')) {

            $tokencheckout = md5('checkout' . time() . rand());
            $data['checkout'] = $tokencheckout;
            $tokkenArray = array(
                'checkout' => $tokencheckout
            );

            $this->session->set_userdata($tokkenArray);
            $dteStart = strtotime($this->input->post('arrivaldate'));
            $dteEnd = strtotime($this->input->post('departuredate'));
            $dteDiff = $dteEnd - $dteStart;
            $dteDiff = floor($dteDiff / (60 * 60 * 24));
            $days = array('nod' => $dteDiff);
            if ($days['nod'] != NULL) {
                $this->session->set_userdata($days);
            }

            
            $data['search'] = array(
                'airport' => $this->input->post('airportname'),
                'arrivaldate' => $this->input->post('arrivaldate'),
                'arrivaltime' => $this->input->post('arrivaltime'),
                'departuredate' => $this->input->post('departuredate'),
                'departuretime' => $this->input->post('departuretime'),
                'nod' => $this->session->userdata('nod')
            );
            $this->session->set_userdata('usersearch',$data['search']);
            $this->load->model('Companies_model');
            $data['companies'] = $this->Companies_model->companyListing('', '', '');
            //$data['companies'] = 
            $this->load->view('frontend/frontheader');
            $this->load->view('frontend/search', $data);
            $this->load->view('frontend/frontfooter');
        } else {
            redirect('/');
        }
    }

    function About() {
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/About');
        $this->load->view('frontend/frontfooter');
    }

    function Faq() {
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/faq');
        $this->load->view('frontend/frontfooter');
    }

    function Contact() {
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/contact');
        $this->load->view('frontend/frontfooter');
    }

    function pagenotfound() {
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/404');
        $this->load->view('frontend/frontfooter');
    }

    function userbookings() {
        $this->load->model('Reports_model');
        //$returns = $this->paginationCompress("reportsListing/", $count, 15);
        $userid = $this->session->userdata('userId');
        $data['userRecords'] = $this->Reports_model->reportListing('', '', '', '', '', $userid);
        $this->load->view('frontend/frontheader');
        $this->load->view('frontend/bookings', $data);
        $this->load->view('frontend/frontfooter');
    }

    function checkout() {
        $tokenarray = $this->input->get();
      //  print_r($tokenarray);        exit();
        if ($tokenarray['token'] == $this->session->userdata('checkout')) {
            $this->load->model('Front_model');
            $data['comp'] = $tokenarray['comp'];
            $data['userRecords'] = $this->Front_model->getUserInfo($this->session->userdata('userId'));
            $data['userVehicals'] = $this->Front_model->getmyvehicals($this->session->userdata('userId'));
            $this->load->view('frontend/frontheader');
            $this->load->view('frontend/checkout', $data);
            $this->load->view('frontend/frontfooter');
        } else {
            redirect('/');
        }
    }

    function bookmyvehicle() {
        //echo 'here'; exit();
       // $searchformdata = array();
         $searchformdata = $this->session->userdata('usersearch');
        $tout = $this->input->post('tout');
        $tin = $this->input->post('tin');
        $outfilight = $this->input->post('outfilight');
        $returnfilight = $this->input->post('returnfilight');
        $vehicleid = $this->input->post('vehicle');
        $userid = $this->session->userdata('userId');
        $comp =  $this->session->userdata('comp');
        $arrivaldate = $searchformdata ['arrivaldate'];
        $arrivaldate = date('Y-m-d',strtotime($arrivaldate));
        $departuredate = $searchformdata ['departuredate'];
        $departuredate = date('Y-m-d',strtotime($departuredate));
//        $arrivaltime = str_replace("AM", "", $searchformdata ['arrivaltime']);
         $arrivaltime = trim($searchformdata ['arrivaltime']," AMP");
         $arrivaltime .=':00';
         $departuretime = trim($searchformdata ['departuretime']," AMP");
         $departuretime .=':00';
        $userInfo = array('vehicaleid' => $vehicleid, 'terminalout' => $tout, 'terminalin' => $tin, 'outgoingflightno' => $outfilight,
            'returnflightno' => $returnfilight, 'userId' => $userid, 'bookingdate' => date('Y-m-d H:i:s'), 'companyid' => $comp,
            'locationid' => $searchformdata['airport'], 'bookingfrom' => $arrivaldate.' '.$arrivaltime,
            'bookingto' => $departuredate.' '.$departuretime,'pay'=>500,'status' => 1 );
        $this->load->model('Front_model');
        $result = $this->Front_model->bookmyvehicle($userInfo);
        if ($result > 0) {
            $this->session->set_flashdata('success', 'Booking successfully');
        } else {
            $this->session->set_flashdata('error', 'Something Going Wrong');
        }
       // print_r($searchformdata);         exit();
        $this->session->set_userdata('usersearch', '');
        redirect('/mybookings');
    }

}
