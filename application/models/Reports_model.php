<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports_model extends CI_Model {

    function reportsCountdisplay($companyid = '') {
        $this->db->select('sum(BaseTbl.pay) as sum');
        $this->db->from('tbl_booking as BaseTbl');
        $this->db->join('tbl_users as user', 'user.userId = BaseTbl.userId', 'inner');
        $this->db->join('tbl_companies as company', 'company.id = BaseTbl.companyid', 'inner');
        $this->db->join('tbl_vehicals as vehical', 'vehical.id = BaseTbl.vehicaleid', 'inner');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if (!empty($companyid)) {
            $likeCriteria = "(BaseTbl.companyid = " . $companyid . ")";
            $this->db->where($likeCriteria);
        }


        $query = $this->db->get();


        return $query->result();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function reportListingCount($searchText = '', $cid = '', $date = '', $userid = '') {
        $this->db->select('BaseTbl.id, user.name, company.name, vehical.vname, vehical.vmodel,BaseTbl.status,BaseTbl.pay, BaseTbl.bookingfrom, BaseTbl.bookingto');
        $this->db->from('tbl_booking as BaseTbl');
        $this->db->join('tbl_users as user', 'user.userId = BaseTbl.userId', 'inner');
        $this->db->join('tbl_companies as company', 'company.id = BaseTbl.companyid', 'inner');
        $this->db->join('tbl_vehicals as vehical', 'vehical.id = BaseTbl.vehicaleid', 'inner');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if (!empty($searchText)) {
            $likeCriteria = "(user.name  LIKE '%" . $searchText . "%'
                            OR  vehical.vname  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($cid)) {
            $this->db->where('BaseTbl.companyid =' . $cid);
        }
        if (!empty($date)) {
            $this->db->where('BaseTbl.bookingdate >="' . $date . '"');
        }
        if (!empty($userid)) {
            $this->db->where('BaseTbl.userId =' . $userid);
        }

        $query = $this->db->get();


        return count($query->result());
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function reportListing($searchText = '', $page, $segment, $cid = '', $date = '', $userid = '') {
        $this->db->select('BaseTbl.id, user.name, company.name, vehical.vname, vehical.vmodel,BaseTbl.status,BaseTbl.pay, BaseTbl.bookingfrom, BaseTbl.bookingto');
        $this->db->from('tbl_booking as BaseTbl');
        $this->db->join('tbl_users as user', 'user.userId = BaseTbl.userId', 'inner');
        $this->db->join('tbl_companies as company', 'company.id = BaseTbl.companyid', 'inner');
        $this->db->join('tbl_vehicals as vehical', 'vehical.id = BaseTbl.vehicaleid', 'inner');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if (!empty($searchText)) {
            $likeCriteria = "(user.name  LIKE '%" . $searchText . "%'
                            OR  vehical.vname  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($cid)) {
            $this->db->where('BaseTbl.companyid =' . $cid);
        }
        if (!empty($date)) {
            $this->db->where('BaseTbl.bookingdate >="' . $date . '"');
        }
        if (!empty($userid)) {
            $this->db->where('BaseTbl.userId =' . $userid);
        }
        $this->db->limit($page, $segment);
        //var_dump($this->db);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function editindividualbooking($bookingid = '', $userid = '') {
        $this->db->select('BaseTbl.id,BaseTbl.outgoingflightno, BaseTbl.vehicaleid,BaseTbl.terminalin,BaseTbl.terminalout, BaseTbl.returnflightno');
        
        $this->db->from('tbl_booking as BaseTbl');
        if (!empty($userid) ) {
            $this->db->where('BaseTbl.id =' . $bookingid);
            $this->db->where('BaseTbl.userId =' . $userid);
            $query = $this->db->get();
            return $query->result();
        } else {
            return false;
        }   
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCompany($compInfo) {

        $this->db->trans_start();
        $this->db->insert('tbl_booking', $compInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getCompanyInfo($userId) {
        $this->db->select('id, name, rate, feature1, feature2,feature3,overview,report_logo');
        $this->db->from('tbl_booking');
        $this->db->where('id', $userId);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editCompany($compInfo, $compid) {

        $this->db->where('id', $compid);
        $this->db->update('tbl_booking', $compInfo);

        return TRUE;
    }

    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany($compId) {
        $this->db->where('id', $compId);
        $this->db->delete('tbl_booking');

        return $this->db->affected_rows();
    }

    function user_booking($userInfo) {
        
    }

}

?>