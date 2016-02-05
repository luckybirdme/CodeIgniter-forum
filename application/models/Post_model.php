<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends MY_Model {
    /*
     var $title   = '';
     var $content = '';
     var $date    = '';
    */

    public $table_name = 'post';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($data){
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function get($id){
        $query = $this->db->get_where($this->table_name, array('id'=> $id));
        return $query->row();
    }

    public function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

    public function get_all(){
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function query($query,$limit, $offset)
    {
        $this->db->order_by('update_at', 'DESC');
        $query = $this->db->get_where($this->table_name, $query, $limit, $offset);
        return $query->result();
    }
}