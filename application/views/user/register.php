<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title; ?></div>
				<div class="panel-body">
					<form class="form-horizontal" id="registerForm" />
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-5">
								<?php echo form_input(array('class'=> 'form-control','name'=>'name','id'=>'name','type'=>'text')); ?>
								<div id="nameAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-5">
								<?php echo form_input(array('class'=> 'form-control','name'=>'email','id'=>'email','type'=>'email')); ?>
								<div id="emailAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-5">
								<?php echo form_input(array('class'=> 'form-control','name'=>'password','id'=>'password','type'=>'password')); ?>
								<div id="passwordAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-5">
								<?php echo form_input(array('class'=> 'form-control','name'=>'confirm_password','id'=>'confirm_password','type'=>'password')); ?>
								<div id="confirm_passwordAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>							
						<div class="form-group">
							<div class="col-md-5 col-md-offset-4">
								<?php echo form_button(array('class'=> 'btn btn-primary','name'=>'submit','id'=>'submit','type'=>'submit','content'=>'Register')); ?>
								<div id="submitAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>			

						<div class="form-group">
							<div class="col-md-5 col-md-offset-4">
								<a href="/user/login">Go to Login</a>
							</div>
						</div>

					</form>				





				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>