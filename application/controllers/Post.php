<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {

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
        	"createPost",
        	"commentPost"
        	);
        $this->login_check($login_check_function);
    }

	public function index()
	{
		$category_id = $this->input->get('category_id',TRUE);
		$data = array(
			'title' => 'Home',
			'category_id' => $category_id
			);
		$this->load->view('post/index',$data);
	}


	public function show(){
		$this->load->helper('form');
		$post_id = $this->input->get('post_id',TRUE);
		$this->load->model('Post_model');
		$this->load->model('Category_model');
		$this->load->model('User_model');
		$post = $this->Post_model->select($post_id);
		$post->read += 1;
		$update = array(
			'read' => $post->read);
		$this->Post_model->update($post->id,$update);

		$post->category = $this->Category_model->select($post->category_id);
		$post->user = $this->User_model->select($post->user_id);
		$data = array(
			'title' => $post->title,
			'post' => $post);
		$this->load->view('post/show',$data);
	}
	public function category(){
		$this->load->model('Category_model');
		$categories = $this->Category_model->get_all();
		$data = array(
			'categories' => $categories);
		$categories_list = $this->load->view('layout/category',$data,TRUE);

		$output = array(
			'state' => true,
			'categories_list' => $categories_list
			);
		json_output($output);

	}
	public function comment(){
		$this->load->model('Comment_model');
		$this->load->model('User_model');
		$post_id = $this->input->get('post_id',TRUE);
		$comments = $this->Comment_model->getByPost($post_id);
		if($comments){
			foreach($comments as $comment){
				$comment->user = $this->User_model->select($comment->user_id);
			}
		}
		$data = array(
			'comments' => $comments);
		$comments_list = $this->load->view('layout/comment',$data,TRUE);

		$output = array(
			'state' => true,
			'comments_list' => $comments_list
			);
		json_output($output);

	}
	public function query(){

		$limit = 10;
		$page = $this->input->get('page',TRUE);
		if($page){
			$offest = ($page - 1)*$limit;
		}else{
			$offest = 0;
			$page = 1;
		}
		$user_id = $this->input->get('user_id',TRUE);
		$category_id = $this->input->get('category_id',TRUE);

		$this->load->model('Post_model');
		$this->load->model('Category_model');
		$this->load->model('User_model');

		$query = array();
		if($user_id){
			$query['user_id'] = $user_id;
		}
		if($category_id){
			$query['category_id'] = $category_id;
		}
		$categories = $this->Category_model->get_all();


		$posts = $this->Post_model->query($query,$limit,$offest);

		foreach ($categories as $key => $value) {
			$_categories[$value->id] = $value;
		}

		foreach($posts as $post){
			$post->category = $_categories[$post->category_id];
			$post->user = $this->User_model->select($post->user_id);
		}


		$data = array(
			'posts' => $posts,
			'page' => $page,
			'user_id' => $user_id,
			'category_id' => $category_id
			);
		$posts_list = $this->load->view('layout/post',$data,TRUE);
		

		$output = array(
			'state' => true,
			'posts_list' => $posts_list
			);
		json_output($output);
	}

	public function create(){
		$this->load->helper('form');
		$id = $this->input->get('id',TRUE);
		$this->load->model('Post_model');
		$this->load->model('Category_model');

		$post = null;
		if($id){
			$post = $this->Post_model->select($id);
			$post->category = $this->Category_model->select($post->category_id);			
		}
		$categories = $this->Category_model->get_all();


		$data = array(
			'title' => 'Create',
			'post' => $post,
			'categories' => $categories
			);
		$this->load->view('post/create',$data);
	}

	public function commentPost(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('content', 'Content', 'required');

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

			$post_id = $this->input->post('post_id',TRUE);
			$content = $this->input->post('content',TRUE);

			$this->load->model('Comment_model');
			$this->load->model('Post_model');
		    $comment = array(
		    	'post_id' => $post_id,
		    	'content' => $content,
		    	'user_id' => $this->session->user->id
		    	);

		   
		    $id = $this->Comment_model->insert($comment);
		    

		   	

		   	$post = $this->Post_model->select($post_id);
		   	$update = array(
		   		'comment' => $post->comment+1
		   		);

		   	$this->Post_model->update($post_id,$update);

		   	$url = base_url('/post/show?id='.$post_id);
		   	$output['redirect'] = $url;
		}


		json_output($output);	


	}

	public function createPost(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		        'title', 
		        'Title',
		        'required|max_length[30]',
		        array(
		                'required'      => 'You have not provided %s.'
		        )
		);
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('markdown', 'Content', 'required');

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

			$id = $this->input->post('id',TRUE);
			$title = $this->input->post('title',TRUE);
			$category_id = $this->input->post('category_id',TRUE);
			$markdown = $this->input->post('markdown',TRUE);

		    $this->load->model('Post_model');
			$this->load->model('Category_model');
			$this->load->library('Markdown');

			$content=$this->markdown->markdown_to_html($markdown);

		    $post = array(
		    	'title' => $title,
		    	'markdown' => $markdown,
		    	'content' => $content,
		    	'category_id' => $category_id,
		    	'user_id' => $this->session->user->id
		    	);

		    if($id){
		    	$_post = $this->Post_model->select($id);
		    	if($this->session->user->id == $_post->user_id){
		    		$this->Post_model->update($id,$post);
		    	}
		    	
		    }else{
		    	$id = $this->Post_model->insert($post);
		    }

		   	

		   	$category = $this->Category_model->select($category_id);
		   	$update = array(
		   		'count' => $category->count+1
		   		);

		   	$this->Category_model->update($category_id,$update);

		   	$url = base_url('/post');
		   	$output['redirect'] = $url;
		}


		json_output($output);

	}
}