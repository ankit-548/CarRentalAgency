<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //INSERT/UPDATE DATA INTO DATABASE
    public function save($data, $where=NULL, $insert=false, $table_name){
        // Insert
        if ($where === NULL && $insert==true) {
            $this->db->set($data);
            $this->db->insert($table_name);
            $insert_id = $this->db->insert_id();
            return $this->db->insert_id();
        }else{
            $data['updated']=time();
            // Update save_where
            if(is_array($where) && count($where)>0){
                $this->db->where($where);
                $this->db->set($this->validate_save_data($data, $table_name));
                $this->db->update($table_name);
                return $this->db->affected_rows();
            }else{
                //update with primary key
                $filter = $this->_primary_filter;
                $id = $filter($where);
                $this->db->set($this->validate_save_data($data, $table_name));
                $this->db->where($this->_primary_key, $id);
                $this->db->update($table_name);
                $message   = UPDATE_RECORD_CONSTANT . " On ".$table_name.' Id ' . $id;
                $action    = "Update";
                $record_id = $insert_id = $id;
                $this->log($message, $record_id, $action);
                return $this->db->affected_rows();                
            }
        }
    }
}    