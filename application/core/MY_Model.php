<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function base_insert($table,$data){
        $data['update_at'] = date("Y-m-d H:i:s");
        $data['create_at'] = date("Y-m-d H:i:s");
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function base_select($table,$id){
        $query = $this->db->get_where($table, array('id'=> $id));
        return $query->row();
    }

    public function base_update($table,$id,$data){
    	$data['update_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

}