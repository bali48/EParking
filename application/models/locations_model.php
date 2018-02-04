<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Locations_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function LocationListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.lname');
        $this->db->from('tbl_locations as BaseTbl');
       // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "( BaseTbl.lname  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
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
    function LocationListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.lname');
        $this->db->from('tbl_locations as BaseTbl');
       // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.lname  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewLocation($compInfo)
    {

        $this->db->trans_start();
        $this->db->insert('tbl_locations', $compInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getLocationInfo($userId)
    {
        $this->db->select('id, lname');
        $this->db->from('tbl_locations');
        $this->db->where('id', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editLocation($compInfo, $compid)
    {
       
        $this->db->where('id', $compid);
        $this->db->update('tbl_locations', $compInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteLocation($compId)
    {
        $this->db->where('id', $compId);
        $this->db->delete('tbl_locations');
        
        return $this->db->affected_rows();
    }




}

?>