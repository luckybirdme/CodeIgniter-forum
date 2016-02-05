<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">
				<div class="panel-heading">Posts</div>
				<div class="panel-body">
					<div id="posts_list"> 
					</div>
					<input type="hidden" name="category_id" id="category_id" value="<?php if(isset($category_id)) echo $category_id; ?>" />

				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>