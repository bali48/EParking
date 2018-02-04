<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_model extends CI_Model
{
    
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function reportListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.review, BaseTbl.company, company.name');
        $this->db->from('tbl_reviews as BaseTbl');
        $this->db->join('tbl_companies as company', 'company.id = BaseTbl.company','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(company.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.review  LIKE '%".$searchText."%')";
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
    function reportListing($searchText = '', $page, $segment,$cid = '',$date='')
    {
         $this->db->select('BaseTbl.id, BaseTbl.review, BaseTbl.company, company.name');
        $this->db->from('tbl_reviews as BaseTbl');
        $this->db->join('tbl_companies as company', 'company.id = BaseTbl.company','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(company.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.review  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $this->db->limit($page, $segment);
        //var_dump($this->db);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewReview($compInfo)
    {
       // var_dump($compInfo);        exit();
        $this->db->trans_start();
        $this->db->insert('tbl_reviews', $compInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $reviewId : This is user id
     * @return array $result : This is user information
     */
    function getReviewInfo($reviewId)
    {
        $this->db->select('id, review, company');
        $this->db->from('tbl_reviews');
        $this->db->where('id', $reviewId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $reviewId : This is user id
     */
    function editReview($compInfo, $compid)
    {
       
        $this->db->where('id', $compid);
        $this->db->update('tbl_reviews', $compInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $reviewId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteReview($reviewId)
    {
        $this->db->where('id', $reviewId);
        $this->db->delete('tbl_reviews');
        
        return $this->db->affected_rows();
    }




}

?>