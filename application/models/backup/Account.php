<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account extends CI_Model
{
    // This function returns the username, password and the employee
    //      number based on the login information.
    function login($account_username, $account_password)
    {
        $this->load->database();
        $query = "SELECT account_username, account_password, emp_num FROM account WHERE account_username = '".$account_username."' AND account_password = '".$account_password."'";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
    }
    
    function getEmp_num($account_username, $account_password)
    {
        $this->load->database();
        $query = $this->db->query("SELECT emp_num FROM account WHERE account_username = '".$account_username."' AND account_password = '".$account_password."'");
        $row = $query->row();
        return $row->emp_num;
    }//end of getEmp_num
    
    function addAccount($data) //FROM POST
    {
        $this->load->database();
        return $this->db->insert('account', $data);
    }//end of addAccount
    
    function deleteAccount($emp_num)
    {
        $this->load->database();
        $query = "DELETE FROM account WHERE emp_num = '".$emp_num."'"; 
        return $this->db->query($query);
    }
}
