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
        return parent::base_insert($this->table_name,$data);
    }

    public function select($id){
        return parent::base_select($this->table_name,$id);
    }

    public function update($id,$data){
        parent::base_update($this->table_name,$id,$data);
    }

    public function getByPost($post_id){
        $query = $this->db->get_where($this->table_name, array('post_id'=> $post_id));
        return $query->result();
    }

}