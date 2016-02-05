<div class="list-group post-list-group">


	<?php if($posts) { 

		foreach($posts as $post){ ?>

		<div class="pull-right last-comment-at">
			<div class="meta">
				<div id="post-list-right-container">
					<label class="post-category-item">
						<a href="/post?category_id=<?php echo $post->category->id;?>" >
							<span><?php echo $post->category->name;?></span>
						</a>
					</label>
					
					<i class="glyphicon glyphicon-eye-open"></i><span class="post-right-item"><?php echo $post->read; ?></span>
					<i class="glyphicon glyphicon-comment"></i><span class="post-right-item"><?php echo $post->comment; ?></span>
				
				</div>

			</div>
		</div>
		<div class="list-group-item post-list-item">
			<a href="/post/show/?id=<?php echo $post->id; ?>" > 
				<h4 class="list-group-item-heading"><?php echo $post->title;?></h4>
			</a>
			<div class="meta">
				<i class="glyphicon glyphicon-time"></i><span class="timeago"><?php echo $post->update_at;?></span>
				<i class="glyphicon glyphicon-user"></i><a href="/user?id=<?php echo $post->user->id;?>"><span><?php echo $post->user->name; ?></span></a>
			</div>
		</div>

		<?php }
	 }else{ ?> 

		  <div class="text-center"> 
		    <p>There is the no more post</p>
		    <p> <a href="/post/create" class="btn btn-primary">Create Post</a></p>
		  </div>

	<?php } ?>


</div>

<?php if(isset($page)){ ?> 
	<div class="pagination-container">
		<input type="hidden" name="page" id="page" value="<?php echo $page; ?>" />
		<?php if($page > 1){ ?> 
			<ul class ="pagination pull-left">
				<li>
					<a href="javascript:void(0);" class="page-button" data-id="<?php echo $page - 1; ?>">
						<span> < Previous</span>
					</a>
				</li>
			</ul>
		<?php } ?>

		<ul class="pagination">
			<li>
				<span class="page-info"><?php echo $page;?> Page</span>
			</li>
		</ul>

		<?php if($posts) { ?> 
			<ul class ="pagination pull-right">
				<li >
					<a href="javascript:void(0);" class="page-button" data-id="<?php echo $page + 1; ?>">
						<span> Next > </span>
					</a>
				</li>
			</ul>
		<?php } ?>

	</div>
<?php } ?>