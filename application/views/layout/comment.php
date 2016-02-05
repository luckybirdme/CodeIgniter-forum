<?php if($comments){ 
	foreach($comments as $comment) { ?> 
		<div class="comment-list-item">
			<div class="meta">
				<a href="/user?id=<?php echo $comment->user->id;?>">
					<i class="glyphicon glyphicon-user"></i>
					<span><?php echo $comment->user->name;?></span>
				</a>
				<i class="glyphicon glyphicon-time"></i>
				<span class="timeago"><?php echo $comment->create_at;?></span>
			</div>
			<p class="comment-content"><?php echo $comment->content;?></p>
		</div>
		<?php } 
} ?>
