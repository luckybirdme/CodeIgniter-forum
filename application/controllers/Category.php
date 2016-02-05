<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

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
        	"create",
        	"createPost"
        	);
        $this->login_check($login_check_function);
    }

	public function index()
	{

	}

	public function create(){
		$this->load->helper('form');
		$this->load->model('Category_model');
		$categories = $this->Category_model->get_all();
		$data = array(
			'title' => 'Create',
			'categories' => $categories
			);
		$this->load->view('category/create',$data);
	}

	public function createPost(){
		$this->load->model('Category_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');

		$output = array(
			'state' => false
			);
		if ($this->form_validation->run() == FALSE)
		{
		    $output['error'] = form_error_array();
		    $output['csrf'] = true;
		}
		else
		{

		    $output['state'] = true;

			$name = $this->input->post('name',TRUE);

		    $category = array(
		    	'name' => $name,
		    	'count' => 0
		    	);

		   
		    $id = $this->Category_model->insert($category);
	

		   	$url = base_url('/category/create');
		   	$output['redirect'] = $url;
		}


		json_output($output);
	}
}