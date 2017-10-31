<div class="x_panel">
	<div class="x_title">
		<h2>Sub Service Register</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap"  id="simple-clone">
		<br />
		<?php
			echo $this->Form->create('SubService', array(
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
					echo $this->Form->label('service_id', 'Service Type', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php 
						echo $this->Form->input('service_id', array(
							'type' => 'select',
							'options'=> !empty($services) ? $services : array(),
							'label'=>false,
							'empty' => 'Select Service Name',
							'class' => 'form-control'
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('name', 'Sub Service Name<span class="required">*</span>', array(
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
							'placeholder' => ''
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('myan_name', 'Sub Service Name (Myanmar)<span class="required">*</span>', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('myan_name', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => ''
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('text', 'Text', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('text', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => ''
						));
					?>
				</div>
			</div>

			<div class="form-group">
				<?php
					echo $this->Form->label('myan_text', 'Text (Myanmar)', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php
						echo $this->Form->input('myan_text', array(
							'type' => 'text',
							'label' => false,
							'class' => 'form-control col-md-7 col-xs-12',
							'autocomplete' => 'off' ,
							'placeholder' => ''
						));
					?>
				</div>
			</div>

			<div class="col-md-12">			
				<?php
					echo $this->Form->label('question', 'Questions', array(
						'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
					));
				?>
			</div>

			<center>
				<div class="toclone form-group" style="border-bottom: none;">
					<p class="name">
	                    
	                	<?php
							echo $this->Form->input('Question.0.Ename', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control',
								'style' => 'margin-bottom: 2%;width: 49%;',
								'placeholder' => 'Enter Question (English)',
								'id' => 'Ename'
							));
						?>
						<?php
							echo $this->Form->input('Question.0.Mname', array(
								'type' => 'text',
								'label' => false,
								'class' => 'form-control',
								'style' => 'width: 49%;',
								'placeholder' => 'Enter Question (Myanmar)' ,
								'id' => 'Mname'

							));
						?>
						

						<div class="delete col-md-1 col-md-offset-9" style="margin-top: -44px;" >
							<span class="btn btn-primary">
								<i class="fa fa-minus" ></i>
							</span>
						</div>

						<div class="clone" style="margin-left: 670px;margin-top: -45px;">
							<span class="btn btn-primary">
								<i class="fa fa-plus" ></i>
							</span>
						</div>
					</p>
				</div>
			</center>

			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'adminsubservices', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
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

<script>

	$(document).on('click', '.clone', function(){
   		$('#simple-clone').cloneya();
   	});

</script>
