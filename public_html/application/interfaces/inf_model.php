<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Interface to be implemented into all models
* @author: Arnab Chattopadhyay
*/
interface Inf_Model
{
    /**
    * method to insert data into database
    * 
    * @param string $s_tab_name
    * @param mixed $m_data_arr
    */
    public function insertData($s_tab_name='', $m_data_arr=array());
    
    /**
    * method to update data into database according to a where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_data_arr
    * @param mixed $m_where
    */
    public function updateData($s_tab_name, $m_data_arr, $m_where);
    
    /**
    * method to fetch single data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchSingle($s_tab_name, $m_where);
    
    /**
    * method to fetch multiple data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMulti($s_tab_name, $m_where);
}
