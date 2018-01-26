<?php echo $this->Html->css('DateTimePicker'); ?>
<?php echo $this->Html->script('DateTimePicker'); ?>
<?php $user_id = $this->Session->read('authId'); ?>
<section>
<div class="container">
	<div class="request-box col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="sub_box" >

			<div class="Utitle" >
				<center class="hidden-sm hidden-xs">
					<h3>
						<?php echo $service['Service']['name']; ?>
					</h3>
				</center>
				<center class="hidden-lg hidden-md">
					<h4 style="margin-bottom: -2%;margin-top: 10%;">
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
										$chkValue[$value] = $value; ?>
										<div class="form-check">
											<label>
												<input type="checkbox" name= "<?php echo 'data[ServiceRequest]['.$questionId.']['.$key.']' ?>" value="<?php echo $value; ?>" > <span class="label-text">
													<?php echo $value; ?>
												</span>
											</label>
										</div>

									<?php } ?>
								<?php } elseif ($value['Question']['type'] == 'radio') { ?>
									<?php
										$string = rtrim($value['Question']['en_answer'],"@@");
										$answer = explode('@@', $string);
									?>
									<div>
										<?php foreach ($answer as $key => $value) : ?>
											<!-- <label class="radio-inline">
												<input type="radio" name="<?php echo 'data[ServiceRequest]['.$questionId.']'; ?>" value = "<?php echo $value; ?>" > 
												<?php echo $value; ?>
											</label> -->
											<div class="form-check">
												<label>
													<input type="radio" name="<?php echo 'data[ServiceRequest]['.$questionId.']'; ?>" value = "<?php echo $value; ?>" > <span class="label-text">
														<?php echo $value; ?>
															
														</span>
												</label>
											</div>
										<?php endforeach; ?>
									</div>

								<?php }	?>
						</div>
					</div>

				<?php endforeach; ?>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>When do you need the service ?</label>
						<?php
							echo $this->Form->input('request_datetime', array(
								'type' => 'text',
								'label'=>false,
								'data-field' => 'datetime',
								'class' => 'form-control'
							));
						?>
						<div id="dtBox"></div>
					</div>
				</div>

				<?php if (empty($user_id)) : ?>
					
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
		margin-top: 2%;
	}
	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}

	p {
		margin-left: 20px;
	}

	input {
		width: 200px;
		padding: 10px;
		/*margin-left: 20px;*/
		margin-bottom: 20px;
	}

	@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

	input[type="checkbox"], input[type="radio"]{
		position: absolute;
		right: 9000px;
	}

	/*Check box*/
	input[type="checkbox"] + .label-text:before{
		content: "\f096";
		font-family: "FontAwesome";
		speak: none;
		font-style: normal;
		font-weight: normal;
		font-variant: normal;
		text-transform: none;
		line-height: 1;
		-webkit-font-smoothing:antialiased;
		width: 1em;
		display: inline-block;
		margin-right: 5px;
	}

	input[type="checkbox"]:checked + .label-text:before{
		content: "\f14a";
		color: #2980b9;
		animation: effect 250ms ease-in;
	}

	input[type="checkbox"]:disabled + .label-text{
		color: #aaa;
	}

	input[type="checkbox"]:disabled + .label-text:before{
		content: "\f0c8";
		color: #ccc;
	}

	/*Radio box*/

	input[type="radio"] + .label-text:before{
		content: "\f10c";
		font-family: "FontAwesome";
		speak: none;
		font-style: normal;
		font-weight: normal;
		font-variant: normal;
		text-transform: none;
		line-height: 1;
		-webkit-font-smoothing:antialiased;
		width: 1em;
		display: inline-block;
		margin-right: 5px;
	}

	input[type="radio"]:checked + .label-text:before{
		content: "\f192";
		color: #8e44ad;
		animation: effect 250ms ease-in;
	}

	input[type="radio"]:disabled + .label-text{
		color: #aaa;
	}

	input[type="radio"]:disabled + .label-text:before{
		content: "\f111";
		color: #ccc;
	}

</style>

<script type="text/javascript">

	$(document).ready(function() {
		$("#dtBox").DateTimePicker({
			minuteInterval: 5
		});
	});

</script>