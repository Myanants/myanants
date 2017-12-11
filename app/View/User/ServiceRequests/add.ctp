<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'); ?>
<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>


<section>
<div class="container">
	<div id="signupbox" class="login_box mainbox col-md-9 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="sub_box" >

			<div class="Utitle" >
				<center>
					<h3 class="hidden-sm hidden-xs">
						<?php echo $service['Service']['name']; ?>
					</h3>
				</center>
				<center>
					<h4 class="hidden-lg hidden-md">
						<?php echo $service['Service']['name']; ?>
					</h4>
				</center>
			</div>

			<div class="panel-body" >
				<?php 
					echo $this->Form->create('ServiceRequest', array(
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
				<?php echo $this->Session->flash(); ?>
		
				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<!-- <label>What type of Service ?</label> -->
						<?php
							$services = array('Air Conditioner Servicing', 'Air Conditioner Installation');
							echo $this->Form->input('service_id', array(
								'type' => 'select',
								'options'=> !empty($services) ? $services : array(),
								'label'=>false,
								'empty' => 'What do you need for..',
								'class' => 'form-control'
							));
						?>
					</div>
				</div>

				<?php foreach ($question as $key => $value)  : ?>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>
								<?php echo $value['Question']['Ename']; ?>
							</label>
							<?php

								if ($value['Question']['type'] == 'text') {
									echo $this->Form->input('service_id', array(
										'type' => 'text',
										'label'=>false,
										'class' => 'form-control'
									));
								} elseif ($value['Question']['type'] == 'check') {
									$string = rtrim($value['Question']['en_answer'],"@@");
									$answer = explode('@@', $string);
									foreach ($answer as $key => $value) { ?>
										<p><label style='font-weight: 400;'>
										<?php
											echo $this->Form->checkbox($value, array('value' => $value,'label' => false));
											echo $value;
										?>
										</label></p>
									<?php }
									
								} elseif ($value['Question']['type'] == 'radio') {
									$string = rtrim($value['Question']['en_answer'],"@@");
									$answer = explode('@@', $string);
									foreach ($answer as $key => $value) { ?>

									<div class="radio">
										<label>
											<input type='radio' name='sub_service_name' class="sub_service_name" value="<?php echo $value; ?>"><?php echo $value; ?>

											<?php
												// echo $this->Form->radio($value, array('value' => $value,'label' => false));
												// echo $value;
											?>

										</label>
									</div>
										
									<?php }
								}

							?>
						</div>
					</div>

				<?php endforeach; ?>
				
				<div class="form-group btn-submit">
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php echo $this->Form->button('Request', array('class'=>'btn btn-info btn-md btn-block','type'=>'submit')); ?>
					</div>
				</div>

				<div class="form-group btn-submit">
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php echo $this->Form->button('Submit', array('class'=>'btn btn-info btn-sm btn-block','type'=>'submit','style'=>'width:100%;')); ?>
					</div>
				</div>
				
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
</section>

<style type="text/css">
	.btn-facebook{
		color:#fff;
		background-color:#3b5998;
		border-color:rgba(0,0,0,0.2);
	}
	.btn-facebook:hover,.btn-facebook:focus,.btn-facebook:active,.btn-facebook.active,.open .dropdown-toggle.btn-facebook {
		color:#fff;
		background-color:#30487b;
		border-color:rgba(0,0,0,0.2)}
	button.btn {
		margin:0px;
		transition: all 0.5s;
	}
	.message {
		color: red;
		padding-left: 9%;
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}
</style>