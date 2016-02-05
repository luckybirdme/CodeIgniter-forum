<?php foreach($categories as $category){ ?> 
	<p ><a href="/post?category_id=<?php echo $category->id;?>" class='category-item' data-id=<?php echo $category->id; ?> ><?php echo $category->name;?></a></p>
<?php }


