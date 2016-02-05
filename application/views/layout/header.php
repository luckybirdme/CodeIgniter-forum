<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="<?php echo static_url(); ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo static_url(); ?>/css/styles.css">
		<link rel="stylesheet" href="<?php echo static_url(); ?>/css/editor.css">
		<link rel="stylesheet" href="<?php echo static_url(); ?>/css/editor-self.css">
		<link rel="stylesheet" href="<?php echo static_url(); ?>/css/main.css">
		<script type="text/javascript">
			var BASE_URL = "<?php echo base_url(); ?>";
		</script>
	</head>
	<body>
		<nav class="navbar navbar-white">
			<div class="header-container">
				<div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse" class="navbar-toggle">
						<span class="nav-menu-name">Menu</span>
					</button>
					<a href="/" class="navbar-brand">LuckyBird</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/">Home</a></li>
						<?php if($this->session->has_userdata('user')) {?>
							<li><a href="/user"><?php echo $this->session->user->name;?></a></li>
							<li><a href="/user/setting">Setting</a></li>
							<li><a href="/user/logout">Logout</a></li>							
						<?php } else { ?>
							<li><a href="/user/login">Login</a></li>
							<li><a href="/user/register">Register</a></li>
						<?php } ?>

					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="sidebar col-sm-3 clearfix">
				<div class="panel panel-default">
					<?php if($this->session->has_userdata('user')) {?>
						<div class="panel-heading">My Account</div>
						<div class="panel-body"> 

							<div class="inner">
								<div>
									<a href="/user" class="user-avatar">
										<img src=<?php echo image_url().$this->session->user->avatar;?> >
									</a>
									<span class="user-name"><a href="/user"><?php echo $this->session->user->name;?></a></span>
								</div>
							</div>
							<div class="add-topic-btn">
								<a href="/post/create" class="btn btn-primary">Create Post</a>
							</div>

						</div>
					<?php } else { ?> 
						<div class="panel-heading">Welcome</div>
						<div class="panel-body"> 

							<div class="inner">
								<p>
									Welcome 
								</p>
							</div>
						

						</div>
					<?php } ?>

				</div>



			<div class="panel panel-default">
					<div class="panel-heading">Categories</div>
					<div class="panel-body"> 
						<div><p><a href="/">Home</a></p></div>
						<div id="categories_list" class="sidebar-tag-container">

						</div>
					</div>
				</div>
			</div>


