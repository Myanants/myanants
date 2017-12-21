<div class="x_panel">
	<div class="x_title">
		<h2>Service Provider Register</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php
			echo $this->Form->create('ServiceProvider', array(
				'type' => 'file',
				'class' => 'form-horizontal form-label-left',
				'inputDefaults' => array(
					'label' => false,
					'div' => false
				),
				'id' => 'demo-form2',
				'autocomplete' => 'off'
			));
		?>

			<div class="form-group">
				<?php
					echo $this->Form->label('id', 'Service Provider ID', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('id', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'value' => $UserCode,
							'disabled' => true
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('company_name', 'Company Name<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('company_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
			</div>


			<div class="form-group">
				<?php
					echo $this->Form->label('name', 'Contact person<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none; ">
				<?php
					echo $this->Form->label('email', 'Email Address', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<?php
						echo $this->Form->input('email', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100',
							'required' => false
						));
					?>
				</div>
			</div>

			<div class="form-group"">
				<?php
					echo $this->Form->label('phone', 'Phone Number <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<span class=" error">
						<?php
							echo $this->Form->input('phone', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-5',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength' => '20'
							));
						?>
					</span>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('nirc', 'NIRC', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('nirc', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('teammember', 'Number of team member<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						$member = array();
						for ($i= 1; $i <= 30 ; $i++) { 
							$member[$i] = $i;
						}
						echo $this->Form->input('teammember', array(
							'type' => 'select',
							'options'=> !empty($member) ? $member : array(),
							'label'=>false,
							'empty' => 'Select number of team member..',
							'class' => 'form-control'
						));
					?>
				</div>
			</div>
			

			<div class="form-group">
				<?php echo $this->Form->label('business_summary', 'Business Summary', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('business_summary', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('legal', 'Legal', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="radio" name="data[ServiceProvider][legal]" value="0" checked="checked" > No &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="data[ServiceProvider][legal]" value="1" > Yes 
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('business_type', 'Category<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('business_type', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('prefer_location', 'Prefer Location', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('prefer_location', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			
			<div class="form-group">
				<?php
					echo $this->Form->label('image', 'Team Photos', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
<?php //debug($image); ?>
					<?php if (!empty($image)) : ?>
						<div class="resize-img" style="width: 200px; height: 200px; border: thick solid #666666; overflow: hidden; position: relative;">
							<?php
								echo $this->Form->input('image',array(
									'type' => 'hidden',
									'label' => false,
									'value' => $image,
									'id' => 'img-hidden-val'
								));
							?>
							<?php
								echo $this->Html->image($image, array(
									'alt' => 'story image',
									'id' => 'previewHolder',
									"style" => "position: absolute;",
									"class" => "preview"
								));
							?>
						</div>
						<br/>
						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name"><?php echo $image; ?></span>

					<?php else: ?>
						<div>
							<img id="previewHolder" alt="Uploaded Image Preview Holder" class="hide" style="position: absolute;" />
						</div>
						<div class="clearfix"></div>
						<label for="file-7" class="btn btn-default">
							<span></span>
							<strong>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
									<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
								</svg> Choose a file&hellip;
							</strong>
						</label>
						<span id="img-name"></span>

					<?php endif; ?>
					<?php
						echo $this->Form->input('image',array(
							'type'=>'file',
							'label' => false,
							'id' => 'file-7',
							'style' => 'display:none',
							'required' => false
						));
					?>
				</div>
				<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>
			</div>


			<div class="form-group">
				<?php echo $this->Form->label('pricing', 'Pricing<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('pricing', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('experience', 'Experience<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php 
						echo $this->Form->input('experience', array(
							'type' => 'select',
							'options'=> !empty($experience) ? $experience : array(),
							'label'=>false,
							'empty' => 'Select experience',
							'class' => 'form-control'
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('townships', 'Township<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php 
						echo $this->Form->input('townships', array(
							'type' => 'select',
							'options'=> !empty($townships) ? $townships : array(),
							'label'=>false,
							'empty' => 'Select township',
							'class' => 'form-control'
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('password', 'Password<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('password', array(
							'type' => 'password',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-5',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '20',
							'minlength' => '8'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php echo $this->Form->label('noti', '<span class="required">※ </span>Password must be 8 to 20 digits. ', array('class' => 'control-label','style' => 'text-align: left;')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('confirm_password', 'Confirm Password<span class="error">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<span class="error">
						<?php
							echo $this->Form->input('confirm_password', array(
								'type' => 'password',
								'label' => false,
								'class' => 'form-control col-md-7 col-xs-5',
								'autocomplete' => 'off' ,
								'placeholder' => '',
								'maxlength' => '20',
								'minlength' => '8'
							));
						?>
					</span>
				</div>
			</div>

			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admin_service_providers', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
				</div>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">
	.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		border-bottom: 1px solid #D9DEE4;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	.logo-space{
		margin-left: -65px;
		border:none;
		color:red;
	}
	.logo-space-before{
		margin-left: -14px;
		border:none;
		color:red;
	}
	.space{
		padding-left: 65px;
	}
	.Message {
		margin-left: 248px;
		color: red;
	}
</style>


<script type="text/javascript">
$("#file-7").on("change", function(evt){
	readURL(this);
});

function readURL(input) {

	// Set the file name
	var file = input.files[0].name;

console.log(file);
	if($('#img-name').text() != ""){
		$('#img-name').text(file);
		$('#img-hidden-val').attr('value', file);
	} else {
		$('#img-name').text(file);
		$('#img-hidden-val').attr('value', file);
	}
	$(".resize-img").removeAttr('style');

	// Set the image for preview before upload
	if (input.files && input.files[0]) {

		var reader = new FileReader();
		var targetleft = 0;
		var targettop = 0;
		var t_width = 0;
		var t_height = 0;
		reader.onload = function(e) {

			var image = new Image();
			image.src = e.target.result;

console.log(image.src);
			image.onload = function() {
				var w = this.width;
				var h = this.height;
				var tw = 200;
				var th = 200;
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				t_width = result.width;
				t_height = result.height;
				targetleft = result.targetleft;
				targettop = result.targettop;
				$('#previewHolder').css("width", result.width);
				$('#previewHolder').css('height', result.height);
				$('#previewHolder').attr('src', image.src);
				$('#previewHolder').css("left", targetleft);
				$('#previewHolder').css("top", targettop);
				$('#previewHolder').attr("width", t_width);
				$('#previewHolder').attr("height", t_height);

			};
			$('#previewHolder').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
			$('#previewHolder').removeClass('hide');
		}
		reader.readAsDataURL(input.files[0]);
	}
}

$(document).ready(function() {
	OnImageLoad();
	//Validation
	// $("#imageSubmit").on('click', function(){
	// 	var error = 0;
	// 	var val = [];

	// 	var company = $('#companyName').val();
	// 	var companyDisable = $('#companyName').prop('disabled');
	// 	var address = $('#address').val();
	// 	var image = $('#file-7').val();
	// 	var coImage = '';


	// 	if (error === 1) {
	// 		// scroll to the top of the page without onload.
	// 		$(document).scrollTop(0);
	// 		return false;
	// 	}
	// });
});


function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {
	var result = { width: 0, height: 0, fScaleToTargetWidth: true };

	if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
		return result;
	}

	// scale to the target width
	var scaleX1 = targetwidth;
	var scaleY1 = (srcheight * targetwidth) / srcwidth;

	// scale to the target height
	var scaleX2 = (srcwidth * targetheight) / srcheight;
	var scaleY2 = targetheight;

	// now figure out which one we should use
	var fScaleOnWidth = (scaleX2 > targetwidth);
	if (fScaleOnWidth) {
		fScaleOnWidth = fLetterBox;
	}
	else {
		fScaleOnWidth = !fLetterBox;
	}

	if (fScaleOnWidth) {
		result.width = Math.floor(scaleX1);
		result.height = Math.floor(scaleY1);
		result.fScaleToTargetWidth = true;
	}
	else {
		result.width = Math.floor(scaleX2);
		result.height = Math.floor(scaleY2);
		result.fScaleToTargetWidth = false;
	}
	result.targetleft = Math.floor((targetwidth - result.width) / 2);
	result.targettop = Math.floor((targetheight - result.height) / 2);
	return result;
}

function OnImageLoad() {
	var img = $('.preview');
	if (img.length != 0) {
		// what's the size of this image and it's parent
		var w = parseInt($(img).css("width").replace('px',''));
		var h = parseInt($(img).css("height").replace('px',''));
		var tw = $(img).parent().width();
		var th = $(img).parent().height();
		// compute the new size and offsets
		var result = ScaleImage(w, h, tw, th, true);
		// adjust the image coordinates and size
		img.css("width", result.width);
		img.css('height', result.height);
		$(img).css("left", result.targetleft);
		$(img).css("top", result.targettop);
	}
}

</script>
