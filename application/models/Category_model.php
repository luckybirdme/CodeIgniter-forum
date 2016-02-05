<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model {
    /*
     var $title   = '';
     var $content = '';
     var $date    = '';
    */

    public $table_name = 'category';
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($data){
        return $this->insert($this->table_name,$data);
    }

    public function get($id){
        return $this->get($this->table_name,$id);
    }

    public function update($id,$data){
        $this->update($this->table_name,$id,$data)
    }

    public function get_all(){
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

}