<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if($this->session->user && $post->user->id == $this->session->user->id){ ?> 
						<div>
							<a href="/post/create?id=<?php echo $post->id;?>" class="btn btn-primary pull-right " style="margin-left:20px;">Edit</a>

						</div>
					<?php } ?>

					<?php $this->load->view('layout/post',array('posts' => array($post)));?>


					<div class="post-body">
						<?php echo $post->content;?>
					</div>
					<hr>
					<div class="comment-body">
						<div class="comment-header">
							<label class="control-label">Comments</label>
						</div>
						<div id="showComment" class="comment-list">

						</div>
						<form id="commentForm" class="form-horizontal">
							<input type="hidden" name="post_id" id="post_id" value="<?php echo $post->id;?>">
							<div class="control-group">
								<div class="controls">
									<textarea name="content" rows="3" cols="50" class="form-control input-xlarge">
									</textarea>
								</div>
								<div id="contentAlert" class="alert-required">Email is not right</div>
							</div>
							<hr>
							<div class="control-group">
								<div class="controls">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
								<div id="submitAlert" class="alert-required">Email is not right</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>