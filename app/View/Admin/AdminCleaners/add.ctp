<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<div class="x_panel">
	<div class="x_title">
		<h2>Freelance Cleaner Register</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<?php
			echo $this->Form->create('Cleaner', array(
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
					echo $this->Form->label('cleaner_id', 'Cleaner ID', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('cleaner_id', array(
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
					echo $this->Form->label('name', 'Name<span class="required">*</span>', array(
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


			<div class="form-group">
				<?php
					echo $this->Form->label('date_of_birth', 'Date of Birth<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('date_of_birth', array(
							'type' => 'date',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'value' => '1960-01-01',

						));
					?>
				</div>
			</div>

			<div class="form-group" >
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

			<div class="form-group" style="border-bottom: none;">
				<?php echo $this->Form->label('address', 'Address<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('address', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<?php echo $this->Form->label('email', 'Email Address', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('email', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '')); ?>
				</div>
			</div>

			<div class="form-group" >
				<?php
					echo $this->Form->label('township', 'Township <span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<span class=" error">
						<?php
							echo $this->Form->input('township', array(
								'type' => 'select',
								'label' => false,
								'options' => $townships,
								'class' => 'form-control col-md-7 col-xs-5',
								'empty' => 'Please select your township'
							));
						?>
					</span>
				</div>
			</div>


			<div class="form-group">
				<?php
					echo $this->Form->label('nirc', 'NIRC<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<?php
						echo $this->Form->input('nirc', array(
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
					echo $this->Form->label('photo', 'Photo', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('photo', array(
							'type' => 'file',
							'label' => false
						));
					?>
				</div>
				<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('job_type', 'Job Type and Skill<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				
				<?php foreach ($job_type as $key => $value) { ?>
 					<div class="form-group col-md-9 col-md-offset-2" style="margin-left: 24%;border-bottom: none;margin-top: -1%;">
						<div class="col-md-3 col-sm-3 col-xs-3">
							<?php echo $this->Form->input($value, array(
									'type'=>'checkbox',
									'label' => $value,
									'div' => false,
									'value' => $value
									)
								);
							?>
						</div>

						<div class="col-md-3 col-sm-3 col-xs-3">
							<?php
								echo $this->Form->input($value.'skill', array(
									'type' => 'select',
									'label' => false,
									'options' => $skill,
									'class' => 'form-control col-md-7 col-xs-5',
									'empty' => 'Skill'
								));
							?>
						</div>
					</div>
				<?php } ?>

			</div>

			<div class="form-group" style="border-bottom: none;">
				<?php
					echo $this->Form->label('availabel_time', 'Available time', array(
						'class' => ' col-md-offset-2 control-label','style' => 'color : red;'
					));
				?>
				<br/>

				<!-- MONDAY -->
				<?php
					echo $this->Form->label('monday', 'Monday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('monday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker monday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('monday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker monday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('monday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'monday_check'
							)
						);
				?>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<!-- TUESDAY -->
				<?php
					echo $this->Form->label('tuesday', 'Tuesday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('tuesday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker tuesday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('tuesday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker tuesday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('tuesday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'tuesday_check'
							)
						);
				?>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<!-- WEDNESDAY -->
				<?php
					echo $this->Form->label('wednesday', 'Wednesday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('wednesday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker wednesday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('wednesday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker wednesday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('wednesday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'wednesday_check'
							
							)
						);
				?>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<!-- THURSDAY -->
				<?php
					echo $this->Form->label('thursday', 'Thursday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('thursday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker thursday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('thursday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker thursday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<?php
					echo $this->Form->input('thursday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'thursday_check'
							)
						);
				?>
			</div>

			<div class="form-group" style="border-bottom: none;">
				<!-- FRIDAY -->
				<?php
					echo $this->Form->label('friday', 'Friday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('friday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker friday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('friday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker friday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('friday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'friday_check'
							)
						);
				?>

			</div>

			<div class="form-group" style="border-bottom: none;">
				<!-- SATURDAY -->
				<?php
					echo $this->Form->label('saturday', 'Saturday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('saturday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker saturday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('saturday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker saturday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('saturday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'saturday_check'
							)
						);
				?>

			</div>

			<div class="form-group">
				<!-- SUNDAY -->
				<?php
					echo $this->Form->label('sunday', 'Sunday', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('sunday_from', array(
							'type' => 'text',
							'label' => 'From',
							'class' => 'timepicker sunday_from form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<?php
						echo $this->Form->input('sunday_to', array(
							'type' => 'text',
							'label' => 'To',
							'class' => 'timepicker sunday_to form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => '',
							'maxlength' => '100'
						));
					?>
				</div>

				<?php
					echo $this->Form->input('sunday_check', array(
							'type'=>'checkbox',
							'label' => 'Whole day',
							'div' => false,
							'class' => 'sunday_check'
							)
						);
				?>

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
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admin_cleaners', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
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
	$(document).ready(function(){

		$('input.timepicker').timepicker({});

		// Disable and Enable timepicker when check whole day
		$(".monday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".monday_from").prop('disabled', false);
				$(".monday_to").prop('disabled', false);
			} else {
				$(".monday_from").attr("disabled", "disabled").off('click');
				$(".monday_to").attr("disabled", "disabled").off('click');
				$('.monday_from').val('');
				$('.monday_to').val('');
			}

		}); 

		$(".tuesday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".tuesday_from").prop('disabled', false);
				$(".tuesday_to").prop('disabled', false);
			} else {
				$(".tuesday_from").attr("disabled", "disabled").off('click');
				$(".tuesday_to").attr("disabled", "disabled").off('click');
				$('.tuesday_from').val('');
				$('.tuesday_to').val('');
			}

		});

		$(".wednesday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".wednesday_from").prop('disabled', false);
				$(".wednesday_to").prop('disabled', false);
			} else {
				$(".wednesday_from").attr("disabled", "disabled").off('click');
				$(".wednesday_to").attr("disabled", "disabled").off('click');
				$('.wednesday_from').val('');
				$('.wednesday_to').val('');

			}

		});

		$(".thursday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".thursday_from").prop('disabled', false);
				$(".thursday_to").prop('disabled', false);
			} else {
				$(".thursday_from").attr("disabled", "disabled").off('click');
				$(".thursday_to").attr("disabled", "disabled").off('click');
				$('.thursday_from').val('');
				$('.thursday_to').val('');
			}

		});

		$(".friday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".friday_from").prop('disabled', false);
				$(".friday_to").prop('disabled', false);
			} else {
				$(".friday_from").attr("disabled", "disabled").off('click');
				$(".friday_to").attr("disabled", "disabled").off('click');
				$('.friday_from').val('');
				$('.friday_to').val('');
			}

		});
		
		$(".saturday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".saturday_from").prop('disabled', false);
				$(".saturday_to").prop('disabled', false);
			} else {
				$(".saturday_from").attr("disabled", "disabled").off('click');
				$(".saturday_to").attr("disabled", "disabled").off('click');
				$('.saturday_from').val('');
				$('.saturday_to').val('');
			}

		});
		
		$(".sunday_check").change(function() {
			var ischecked= $(this).is(':checked');
			if(!ischecked) {
				$(".sunday_from").prop('disabled', false);
				$(".sunday_to").prop('disabled', false);
			} else {
				$(".sunday_from").attr("disabled", "disabled").off('click');
				$(".sunday_to").attr("disabled", "disabled").off('click');
				$('.sunday_from').val('');
				$('.sunday_to').val('');
			}

		});

	});
</script>
