<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Front_model
 *
 * @author Muhammad Bilal
 */
class Front_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getUserInfo($userId) {
        $this->db->select('user.userId, user.name, user.email, user.address, user.mobile');
        $this->db->from('tbl_users as user');
        $this->db->where('isDeleted', 0);
        $this->db->where('roleId !=', 1);
//        $this->db->where('companyid ==', 0);
        $this->db->where('user.userId', $userId);
        $query = $this->db->get();

        return $query->result();
    }

    function getmyvehicals($userId) {

        $this->db->select('vehical.vname, vehical.vnumber, vehical.vmodel, vehical.id');
        $this->db->from('tbl_vehicals as vehical');
        $this->db->where('userid = ', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    function bookmyvehicle($userInfo) {
        print_r($userInfo);
        $this->db->trans_start();
        $this->db->insert('tbl_booking', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

}
