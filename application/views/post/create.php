<?php $this->load->view('layout/header');?>



	
		<div class="main col-sm-9 clearfix">
			<div class="panel panel-default">

				<div class="panel-heading"><?php echo $title; ?></div>
				<div class="panel-body" >


					<form class="form-horizontal" id="createForm" />
						<input type="hidden" id="id" name="id" value="<?php if($post) echo $post->id;?>" />						
						
		              <div class="control-group">
		                <label class="control-label">Title</label>
		                <div class="controls">
		                  <input name="title" class="form-control input-xlarge" value="<?php if($post) echo $post->title;?>">
		                  <div id="titleAlert" class="alert-required">This field is required</div>
		                </div>
		              </div>

						<div class="control-group">
				            <label class="control-label" >Category</label>
				            <div class="controls">
				              	<select class="form-control" name="category_id">
				              		<option value=""></option>
				              		<?php foreach($categories as $category){ ?> 
				              			<option value=<?php echo $category->id;?> 
				              				<?php if($post && $post->category->id == $category->id) { ?> selected="selected" <?php }?> >
				              				<?php echo $category->name;?>

				              			</option>

				              		<?php } ?>
				              	</select>
				              	<div id="category_idAlert" class="alert-required">This field is required</div>

				            </div>
				        </div>

		              <div class="control-group">
		                <label class="control-label">Content</label>
		                <div class="controls">
		                  <div class="editor-wrapper">
		                    <textarea name="markdown" cols="50" rows="10" id="editor"><?php if($post) echo $post->markdown;?></textarea>
		                  </div>
		                  <div id="contentAlert" class="alert-required">This field is required</div>
		                </div>
		                <div class="controls">
		                  <label class="control-label">Preview</label>
		                  <div id="editor-preview-container"></div>
		                </div>
		              </div>
		              <hr>
		              <div class="form-action">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		              <div id="submitAlert" class="alert-required">Email is not right</div>



					</form>		


			        <button data-toggle="modal" data-target="#imageUploadModal" style="display:none" id="uploadImageButton"></button>
			        <input type="file" value="" name="imageInput" style="display:none;" id="imageInput">
			        <div id="imageUploadModal" class="modal fade">
			          <div class="modal-dialog">
			            <div class="modal-content">
			              <div class="modal-header">
			                <button type="button" data-dismiss="modal" class="close">&times;</button>
			                <h4 class="modal-title">Add Image</h4>
			              </div>
			              <div class="modal-body image-upload-modal-body">
			                <div class="panel-body">
			                  <button type="button" id="imageLocalButton" class="btn btn-primary pull-right">Upload</button>
			                  <div class="form-group">
			                    <label class="col-md-4 control-label">Image Address</label>
			                    <div class="col-md-6">
			                      <input name="imageUrl" type="text" id="imageUrl" class="form-control">
			                    </div>
			                  </div>
			                  <div id="uploadAlert" class="alert-required">This field is required</div>
			                </div>
			              </div>
			              <div class="modal-footer image-upload-modal-footer">
			                <button id="addToPostButton" type="button" data-dismiss="modal" class="btn btn-primary">Add to Topic</button>
			              </div>
			            </div>
			          </div>
			        </div>






				</div>
			</div>
		</div>


	


<?php $this->load->view('layout/footer');?>