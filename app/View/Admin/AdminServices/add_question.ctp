<div class="x_panel">
	<div class="x_title">
		<h2>Add Question
		<?php
			echo '[ '.$service_name['Service']['name'].' ]';
		?>
		</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap"  id="simple-clone">
		<br />
		<?php
			echo $this->Form->create('Question', array(
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
						<?php
							echo $this->Form->input('Question.0.service_id', array(
								'type' => 'hidden',
								'label' => false,
								'id' => 'service_id',
								'value' => $service_id

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
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admin_services', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
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
	/*.delete{
		margin-top: -44px;
	}
	.clone {
		margin-left: 670px;margin-top: -45px;
	}*/
</style>

<script>

	$(document).ready(function() {
		$('#simple-clone').cloneya();
	});
</script>

