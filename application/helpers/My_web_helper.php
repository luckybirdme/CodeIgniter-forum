<?php defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('static_url'))
{

	function static_url()
	{
		return get_instance()->config->item('static_url');
	}
}

if ( ! function_exists('image_url'))
{

	function image_url()
	{
		return get_instance()->config->item('image_url');
	}
}

if ( ! function_exists('json_output'))
{

	function json_output($data)
	{
		if((isset($data['state']) && $data['state'] == false) || isset($data['csrf'])){
			$csrf = array(
				'name' => get_instance()->security->get_csrf_token_name(),
			    'hash' => get_instance()->security->get_csrf_hash()
			);
			$data['csrf'] = $csrf;
		}

		get_instance()->output
        	->set_content_type('application/json')
        	->set_output(json_encode($data))
        	->_display();
		exit;
	}
}

if ( ! function_exists('form_error_array'))
{

	function form_error_array()
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		return $OBJ->error_array();
	}
}

if ( ! function_exists('encrypt_password'))
{

	function encrypt_password($password)
	{

		return md5($password);
	}
}