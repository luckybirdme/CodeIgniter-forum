<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
    	parent::__construct();
        $login_check_function = array(
        	"image"
        	);
        $this->login_check($login_check_function);
    }

	public function index()
	{

	}

	public function image()
	{
		$upload_directory = 'public/upload/image/'.date("Y").'/'.date("m");
		$upload_path = $this->config->item('upload_path').$upload_directory;
		if(!is_dir($upload_path)) 
	    {
	    	$oldmask = umask(0);
	      	mkdir($upload_path,0777,TRUE);
	      	umask($oldmask);
	    } 
		$file_name = $this->session->user->name.'_'.time().'.png';
		
		$config['upload_path'] = $upload_path;
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';

		$this->load->library('upload', $config);

		$field_name = "imageInput";
   		if ( ! $this->upload->do_upload($field_name))
        {
            $output['state'] = false;
            $output['error'] = array(
            	'upload' => $this->upload->display_errors("",""),
            	'data' => $this->upload->data()
            	);

            
        }
        else
        {
            $output['state'] = true;
            $output['csrf'] = true;
            $avatar = '/'.$upload_directory.'/'.$file_name;
            $output['success'] = array(
            	'url' => $avatar);
        }

        json_output($output);

	}
}