<div class="x_panel">
	<div class="x_title">
		<h2>Service Provider Edit</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br/>
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
							'value' => $data['ServiceProvider']['service_provider_id'],
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

			<div class="form-group">
				<?php echo $this->Form->label('nirc', 'NIRC<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('nirc', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>


			<div class="form-group">
				<?php echo $this->Form->label('teammember', 'Team Member<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('teammember', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
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
				<?php echo $this->Form->label('business_summary', 'Business Summary<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('business_summary', array('type' => 'textarea', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('legal', 'Legal<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('legal', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('business_type', 'Business Type<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('business_type', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('where_hear', 'Where Hear<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('where_hear', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $this->Form->label('experience', 'Experience<span class="required">*</span>', array('class' => 'control-label col-md-3 col-sm-3 col-xs-12')); ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php echo $this->Form->input('experience', array('type' => 'text', 'label' => false, 'class' => 'form-control col-md-7 col-xs-12', 'autocomplete' => 'off' , 'placeholder' => '','maxlength' => '3000')); ?>
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
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'adminserviceproviders', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
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
