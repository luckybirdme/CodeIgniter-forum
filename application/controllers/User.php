<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

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
        	"setting",
        	"settingPost"
        	);
        $this->login_check($login_check_function);
    }

	public function index()
	{
		$user_id = $this->input->get('user_id',TRUE);
		$this->load->model('User_model');
		$user = $this->User_model->select($user_id);

		if(!$user){
			$user = $this->session->user;
		}

		$data = array(
			'title' => 'Home',
			'user' => $user,
			'user_id' => $user->id
			);
		$this->load->view('user/index',$data);
	}

	public function login(){
		$this->load->helper('form');
		$data = array(
			'title' => 'Login'
			);
		$this->load->view('user/login',$data);		
	}

	public function home(){
		$data = array(
			'title' => 'Home'
			);

		$id = $this->input->get('id',TRUE);
		if($id){
			$this->load->model('User_model');
			$data['user'] = $this->User_model->select($id);
		}
		else if($this->session->user){
			$data['user'] = $this->session->user;
		}

		$this->load->view('user/home',$data);		
	}

	public function setting(){
		$this->load->helper('form');

		$data = array(
			'title' => 'Setting'
		);

		$this->load->view('user/setting',$data);		
	}


	public function register(){
		$this->load->helper('form');
		$data = array(
			'title' => 'Register'
			);
		$this->load->view('user/register',$data);		
	}

	public function registerPost(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'name', 
		        'Name',
		        'required|min_length[5]|max_length[12]|is_unique[user.name]',
		        array(
		                'required'      => 'You have not provided %s.',
		                'is_unique'     => 'This %s already exists.'
		        )
		);
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');

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
		    $this->load->model('User_model');

		    $user = array(
		    	'name' => $this->input->post('name',TRUE),
		    	'email' => $this->input->post('email',TRUE),
		    	'password' => encrypt_password($this->input->post('password',TRUE)),
		    	'avatar' => '/public/static/img/default-avatar.png'
		    	);

		   	$id = $this->User_model->insert($user);
		   	$url = base_url('/user/login');
		   	$output['redirect'] = $url;
		}


		json_output($output);
	}


	public function loginPost(){

		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		

		$output = array(
			'state' => false
			);
		if ($this->form_validation->run() == FALSE){
		    $output['error'] = form_error_array();
		    $output['csrf'] = true;
		}
		else
		{
		    $this->load->model('User_model');

		    $user = $this->User_model->get_user_by_email($this->input->post('email',TRUE));
		    if($user && $user->password == encrypt_password($this->input->post('password',TRUE)))
		    {
		    	$output['state'] = true;

				$this->session->set_userdata('user',$user);

			   	$url = base_url();
			   	$output['redirect'] = $url;

		    }else{

		    	$output['error'] = array(
		    		'email' => 'Email or Password is not right'
		    		);
		    	$output['csrf'] = true;

		    }
		    
		}

		json_output($output);
	}


	public function logout(){
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
	}

	public function settingPost(){
		$this->load->library('form_validation');
		$check = 'required|min_length[5]|max_length[12]';
		$name = $this->input->post('name',TRUE);
		$id = $this->input->post('id',TRUE);
		$avatar = $this->input->post('userAvatar',TRUE);

		if($this->session->user->name != $name){
			$check.='|is_unique[user.name]';
		};

		$this->form_validation->set_rules(
		        'name', 
		        'Name',
		        $check,
		        array(
		                'required'      => 'You have not provided %s.',
		                'is_unique'     => 'This %s already exists.'
		        )
		);

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
		    $this->load->model('User_model');

		    $user = array(
		    	'name' => $name,
		    	'avatar' => $avatar
		    	);

		   	$this->User_model->update($id,$user);
		   	$user = $this->User_model->select($id);
		   	$this->session->set_userdata('user',$user);
		   	$url = base_url('/user/setting');
		   	$output['redirect'] = $url;
		}


		json_output($output);		

	} 
}
