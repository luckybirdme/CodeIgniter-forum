<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends MY_Model {
    /*
     var $title   = '';
     var $content = '';
     var $date    = '';
    */

    public $table_name = 'comment';
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

    public function getByPost($post_id){
        $query = $this->db->get_where($this->table_name, array('post_id'=> $post_id));
        return $query->result();
    }

}