<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $title; ?></div>
				<div class="panel-body">
					<form class="form-horizontal" id="settingForm" />
						<input type="hidden" id="csrf_token" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
						<input type="hidden" id="id" name="id" value="<?php echo $this->session->user->id;?>" />						
						<div class="form-group">
							<label class="col-md-4 control-label">Avatar</label>
							<div class="col-md-5">
								<div class="inner">
									<div>
										<a href="/user/home" class="user-avatar">
											<img src=<?php echo image_url().$this->session->user->avatar;?> id="avatar">
											<input name="userAvatar" id="userAvatar" value="<?php echo $this->session->user->avatar;?>" type="hidden">
										</a>
										<span>
											<button type="button" id="uploadUserAvatar" class="btn btn-default btn-sm">Upload</button>
											<input name="imageInput" id="imageInput" type="file" style="display:none">
										</span>
									</div>
								</div>
								<div id="uploadAlert" class="alert-required">This field is required</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-5">
								<?php echo form_input(array('value'=>$this->session->user->name,'class'=> 'form-control','name'=>'name','id'=>'name','type'=>'text')); ?>
								<div id="nameAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-5">
								<?php echo form_input(array('readonly'=>'readonly','value'=>$this->session->user->email,'class'=> 'form-control','name'=>'email','id'=>'email','type'=>'email')); ?>
								<div id="emailAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>
												
						<div class="form-group">
							<div class="col-md-5 col-md-offset-4">
								<?php echo form_button(array('class'=> 'btn btn-primary','name'=>'submit','id'=>'submit','type'=>'submit','content'=>'Submit')); ?>
								<div id="submitAlert" class="alert-required" >Name's length is too short</div>
							</div>
						</div>			


					</form>				





				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>