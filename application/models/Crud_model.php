<?php

class Crud_model extends CI_Model {

    function create($table, $data) {
        $this->db->insert($table, $data);
    }

    function read($table,$where=null,$order=null) {
        if($where==null && $order==null){
            return $this->db->get($table)->result_array();
        }else if($where!=null && $order==null){
            return $this->db->where($where)->get($table)->result_array();
        }else if($where==null && $order!=null){
            return $this->db->order_by($order)->get($table)->result_array();
        }else{
            return $this->db->where($where)->order_by($order)->get($table)->result_array();
        }
    }

    function update($table, $where, $data) {
        $this->db->where($where)->update($table, $data);
    }

    function delete($table, $where) {
        $this->db->where($where)->delete($table);
    }
    
    function find($table, $where){
        return $this->db->where($where)->get($table)->result_array();
    }
}
