<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
    }

    public function login_check($function_array)
    {
        $function_name = $this->uri->segment(2, null);
        if(in_array($function_name,$function_array)){
        	if(!$this->session->user){
                $url = base_url('/user/login');
                if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
                    $output['redirect'] = $url;
                    json_output($output);
                }else{
                    
                    redirect($url);
                }
        		
        	}
        }
    }
}


