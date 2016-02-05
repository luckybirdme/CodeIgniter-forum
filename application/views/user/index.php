<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">

			<div class="panel panel-default">
					<div class="panel-heading">User Info</div>
					<div class="panel-body"> 

						<div class="inner">
							<div>
								<a href="/user" class="user-avatar">
									<img src=<?php echo image_url().$user->avatar;?> >
								</a>
								<span class="user-name"><a href="/user"><?php echo $user->name;?></a></span>
								<input type="hidden" name="user_id" id="user_id" value="<?php if(isset($user)) echo $user->id; ?>" />

							</div>
						</div>
					

					</div>


			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Posts</div>
				<div class="panel-body">

					<div id="posts_list">
					</div>

				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>