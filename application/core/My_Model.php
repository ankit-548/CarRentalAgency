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

    //This function will return filtered rows in the table
    public function get_rows($filter = array(), $params=array() ,$num_rows=false,$join=array(),$table_name_to_fetch) {
        if(is_array($join) && count($join)>0){            
            $_PK="tbl.".$this->_primary_key;
            $this->db->from($table_name_to_fetch); //default table alias
            foreach($join as $table){
                if(array_key_exists('table', $table) && array_key_exists('condition', $table)){
                    $type='';
                    if(array_key_exists('type', $table) ){$type=$table['type'];}
                    $this->db->join($table['table'], $table['condition'], $type);
                }
            }
        }else{
            $_PK=$this->_primary_key;
            $this->db->from($table_name_to_fetch);
        }

        $this->db->where($filter);
       
        
        if(is_array($params)){
            $distinct=false;
            //if needs only distinct values
            if(array_key_exists('distinct', $params)){if($params['distinct']==true){$this->db->distinct();$distinct=true;}}
            //for specific columns
            if(array_key_exists('select', $params)){
                if(empty($params['select'])){
                    if(!$distinct){$this->db->select($_PK);}
                }else{                    
                    if(!$distinct && $need_mid){$this->db->select($_PK);}//necessary fields if not distinct value
                    $this->db->select($params['select']);
                }
            }else{
                if(!$distinct){$this->db->select($_PK);}
            }
            //for order_by
            if(array_key_exists('orderby', $params)){
                $orderby_array=explode(" ", $params['orderby']);
                if(count($orderby_array)>1 && strtolower($orderby_array[1])=='random'){
                    $this->db->order_by(explode(" ", $params['orderby'])[0],"RANDOM");
                }else{                   
                    $this->db->order_by($params['orderby']);
                }
            }else{
                $this->db->order_by($_PK,'DESC');
            }
            if(array_key_exists('groupby', $params)){
               // $groupby_array=explode(" ", $params['groupby']);
                    $this->db->group_by($params['groupby']);
            }
            //for limit
            if(array_key_exists('limit', $params)){
                if(array_key_exists('offset', $params)){                
                    $this->db->limit($params['limit'],$params['offset']);
                }else{
                    $this->db->limit($params['limit']);
                }
            }
            //for like
            if(array_key_exists('like', $params)){if(is_array($params['like']) && count($params['like'])>0){ 
                $like_str="(";
                $number=count($params['like']);
                $i=0;
                foreach ($params['like'] as $key => $value) {
                    $i++;
                    $like_str.=" ".$key." LIKE '%".$value."%' ";   
                    if($i<$number){$like_str.=" OR ";}         
                }
                $like_str.=")";
                $this->db->where($like_str,NULL,false);
            }}
            //for or_where // 1 where is necessary for this to work properly!
            if(array_key_exists('or_where', $params)){if(is_array($params['or_where']) && count($params['or_where'])>0){         
                foreach ($params['or_where'] as $key => $value) {
                    if(!empty($key) && !empty($value)){$this->db->or_where($key,$value);}
                }
            }}

            //for where_in //
            if(array_key_exists('where_in', $params)){if(is_array($params['where_in']) && count($params['where_in'])>0){         
                foreach ($params['where_in'] as $key => $value) {
                    //values must be an array E.g array('name',array('name1','name2','name3'))
                    if(!empty($key) && is_array($value) && count($value)>0){
                        $this->db->where_in($key,$value);
                    }
                }
            }}

            //for or_where_in // 1 where_in is necessary for this to work properly!
            if(array_key_exists('or_where_in', $params)){if(is_array($params['or_where_in']) && count($params['or_where_in'])>0){         
                foreach ($params['or_where_in'] as $key => $value) {
                    // values must be an array E.g array('name',array('name1','name2','name3'))
                    if(!empty($key) && is_array($value) && count($value)>0){
                        $this->db->or_where_in($key,$value);
                    }
                }
            }}

            //for where_not_in // 
            if(array_key_exists('where_not_in', $params)){if(is_array($params['where_not_in']) && count($params['where_not_in'])>0){         
                foreach ($params['where_not_in'] as $key => $value) {
                    // values must be an array E.g array('name',array('name1','name2','name3'))
                    if(!empty($key) && is_array($value) && count($value)>0){
                        $this->db->where_not_in($key,$value);
                    }
                }
            }}
        }
        /////////////////////////////////////////////////////////
        $query=$this->db->get();
     //   $vala= $this->db->last_query();
        // print_r($query);
        if($num_rows==true){
            return $query->num_rows();
        }else{
            $data=array();
            if($query !== FALSE && $query->num_rows()>0){
                $data=$query->result_array();
            }
            if(count($data)>0){
                $i=0;
                foreach($data as $field){
                    foreach($field as $key=>$var){
                        $data[$i][$key]=$var;                    
                    }
                    //------------------------
                    $i++;
                }
            }
            return $data;
        }
    }
}    