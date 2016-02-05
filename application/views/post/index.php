<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">
				<div class="panel-heading">Posts</div>
				<div class="panel-body">
					<div id="posts_list_container"> 
						<div id="posts_query">
							<input type="hidden" name="category_id" id="category_id" value="<?php if(isset($category_id)) echo $category_id; ?>" />
							<input type="hidden" name="user_id" id="user_id" value="<?php if(isset($user)) echo $user->id; ?>" />
						</div>
						<div id ="posts_list">
						</div>
					</div>
					

				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>