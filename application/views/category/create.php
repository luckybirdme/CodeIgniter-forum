<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">

			<div class="panel panel-default">
					<div class="panel-heading"><?php echo $title;?></div>
					<div class="panel-body"> 
						<form class="form-horizontal" id="categoryForm" />

							<div class="form-group">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-5">
									<?php echo form_input(array('class'=> 'form-control','name'=>'name','id'=>'name','type'=>'text')); ?>
									<div id="nameAlert" class="alert-required" >Name's length is too short</div>
								</div>
							</div>
				
							
							<div class="form-group">
								<div class="col-md-5 col-md-offset-4">
									<?php echo form_button(array('class'=> 'btn btn-primary','name'=>'submit','id'=>'submit','type'=>'submit','content'=>'Save')); ?>
									<div id="submitAlert" class="alert-required" >Name's length is too short</div>
								</div>
							</div>			


						</form>	

						<div>
							<?php if($categories) { ?>
								<table class="table table-bordered table-striped table-hover">
										<tr>
											<td>#</td>
											<td>Name</td>
										</tr>
									<?php foreach($categories as $category) { ?> 
										<tr>
											<td><?php echo $category->id; ?></td>
											<td><?php echo $category->name; ?></td>
										</tr>
									<?php } ?>

								</table>
							 <?php } ?>
								

							
						</div>

					

					</div>


			</div>

		</div>


	


<?php $this->load->view('layout/footer');?>