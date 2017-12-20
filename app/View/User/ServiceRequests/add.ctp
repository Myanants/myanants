<section>
<div class="container">
	<div class="request-box col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
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
							echo $this->Form->input('sub_service_id', array(
								'type' => 'select',
								'options'=> !empty($serviceName) ? $serviceName : array(),
								'label'=>false,
								'empty' => 'What do you need for..',
								'class' => 'form-control'
							));
						?>
					</div>
				</div>

				<?php foreach ($question as $key => $value)  : ?>
					<?php $questionId = $value['Question']['id']; ?>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>
								<?php echo $value['Question']['Ename']; ?>
							</label>
							<?php

								if ($value['Question']['type'] == 'text') {
									echo $this->Form->input($questionId, array(
										'type' => 'text',
										'label'=>false,
										'class' => 'form-control'
									));

								} elseif ($value['Question']['type'] == 'check') {
									$string = rtrim($value['Question']['en_answer'],"@@");
									$answer = explode('@@', $string);
									$chkValue = array();
									foreach ($answer as $key => $value) { 
										$chkValue[$value] = $value;										
									} ?>

									<?php echo $this->Form->input($questionId, array(
											'type' => 'select',
											'multiple' => 'checkbox',
											'label' => false,
											'class' => 'multiple-chb',
											'options' => $chkValue,
											'required' => false
										));

										?>
									
								<?php } elseif ($value['Question']['type'] == 'radio') { ?>
									<?php
										$string = rtrim($value['Question']['en_answer'],"@@");
										$answer = explode('@@', $string);
									?>
									<div>
										<?php foreach ($answer as $key => $value) : ?>
											<label class="radio-inline">
												<input type="radio" name="<?php echo 'data[ServiceRequest]['.$questionId.']'; ?>" value = "<?php echo $value; ?>" > 
												<?php echo $value; ?>
											</label>
										<?php endforeach; ?>
									</div>

								<?php }	?>
						</div>
					</div>

				<?php endforeach; ?>

				<?php if (empty(AuthComponent::user('id'))) : ?>
					
					<div class="form-group" >	
						<div class="col-md-10 col-md-offset-1 ">
							<label>
								Your Name
							</label>
							<?php
								echo $this->Form->input('name', array(
										'type' => 'text',
										'label'=>false,
										'class' => 'form-control'
									));
							?>
						</div>
					</div>

					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>
								Your Phone Number
							</label>
							<?php
								echo $this->Form->input('phone_number', array(
										'type' => 'text',
										'label'=>false,
										'class' => 'form-control'
									));
							?>
						</div>
					</div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>
								Your Township
							</label>
							<?php
								echo $this->Form->input('township', array(
									'type' => 'select',
									'options'=> !empty($townships) ? $townships : array(),
									'label'=>false,
									'empty' => 'Where do you live in ..',
									'class' => 'form-control'
								));
							?>
						</div>
					</div>

				<?php endif; ?>
				
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

	.request-box {
		margin-top: 8%;
	}
	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}
</style>