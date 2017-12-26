<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> -->

<section>
	<div class="container">
		<div class="signupbox mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
			<div class="sub_box" >

				<!-- <div class="Utitle" >
					<center><h2 class="hidden-sm hidden-xs">Sign Up</h2></center>
					<center><h3 class="hidden-lg hidden-md">Sign Up</h3></center>
				</div> -->

				<div class="hidden-sm hidden-xs col-md-3" style="margin-top: -6%;margin-bottom: -1%;width: 100%;padding-left: 32%;">        
					<h1 class="logo pull-left">
						<a class="scrollto" href="http://myanants.com/staging">
							<img src='http://myanants.com/staging/img/colorant.png' class="logoimg" />
						</a>
					</h1><!--//logo-->
				</div>


				<div class="hidden-md hidden-lg col-md-3" style="margin-top: -8%;padding-left: 22%;">
					<h1 class="logo pull-left" style="margin-bottom: -8%;">
						<a class="scrollto" href="http://myanants.com/staging">
							<img src='http://myanants.com/staging/img/colorant.png' class="logoimg" style="width: 65%;" />
						</a>
					</h1><!--//logo-->
				</div>


				<div class="panel-body" >
					<?php 
						echo $this->Form->create('MasterCleaner', array(
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
							<label>Cleaner ID</label>
							<?php
								echo $this->Form->input('cleaner_id', array(
									'type' => 'text',
									'label' => false,
									'class' => 'form-control',
									'autocomplete' => 'off' ,
									'placeholder' => '',
									'value' => $UserCode,
									'disabled' => true
								));
							?>
						</div>

					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Name</label>
							<?php echo $this->Form->input('name', array( 'class' => 'form-control', 'placeholder' => 'Name', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Date of Birth</label>
							<?php echo $this->Form->input('date_of_birth', array( 'type' => 'date','class' => 'form-control','autofocus' => true, 'autocomplete' => 'off','label' => false,'value' => '1960-01-01')); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Phone Number</label>
							<?php echo $this->Form->input('phone', array( 'class' => 'form-control', 'placeholder' => 'phone', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Address</label>
							<?php echo $this->Form->input('address', array('type' => 'textarea' , 'class' => 'form-control', 'placeholder' => 'address', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Township</label>
							<?php
								echo $this->Form->input('township', array(
									'type' => 'select',
									'label' => false,
									'options' => $townships,
									'class' => 'form-control',
									'empty' => 'Please select your township'
								));
							?>

						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>NIRC</label>
							<?php echo $this->Form->input('nirc', array('class' => 'form-control', 'placeholder' => 'nirc', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-10 col-md-offset-1 ">
							<label>Photo</label>
							<?php //echo $this->Form->input('photo', array('class' => 'form-control', 'placeholder' => 'photo', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
							<?php
								echo $this->Form->input('photo', array(
									'type' => 'file',
									'label' => false
								));
							?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
						<div class="col-md-14 col-md-offset-1">
							<!-- <label>Job Type and Skill</label> -->
							<?php foreach ($job_type as $key => $value) { ?>
			 					<div class="form-group col-md-9 col-md-offset-2" style="border-bottom: none;margin-top: -1%;">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<?php echo $this->Form->input($value, array(
												'type'=>'checkbox',
												'label' => $value,
												'div' => false,
												'value' => $value
												)
											);
										?>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
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
					</div>

					<div class="form-group" ></div>
					<div class="form-group" >
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
					</div>

					<div class="form-group" ></div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<label>Password</label>
							<?php echo $this->Form->input('password', array('placeholder' => 'Password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						</div>
					</div>

					<div class="form-group" ></div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<label>Confirm Password</label>
							<?php echo $this->Form->input('confirm_password', array('placeholder' => 'Confirm Password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
							<?php echo $this->Form->button('Sign Up', array('class'=>'btn btn-info btn-md btn-block','type'=>'submit')); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
							<?php echo $this->Form->button('Sign Up', array('class'=>'btn btn-info btn-sm btn-block','type'=>'submit','style'=>'width:100%;')); ?>
						</div>
					</div>

					<div class="form-group" >
						<div class="col-md-10  col-md-offset-1 hidden-xs hidden-sm">
							<?php
							echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 5px;width:100%;')), array('controller' => 'master_users', 'action'=>'facebookLogin'),
								array( 'escape' => false)); ?>
						</div>
						<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
							<?php
						echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 3px;width:100%')), array('controller' => 'master_users', 'action'=>'facebookLogin'),
								array( 'escape' => false)); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-md-offset-1 col-sm-8  col-xs-10 ">
							You have an Account? <?php echo $this->Html->link("Login Now!", array('controller' => 'master_users', 'action' => 'login'),array( 'label' => false,'target' =>'_blank','style' => 'color: #0000ff;')); ?>
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

	.signupbox {
		margin-top: 2%;
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}
	
</style>

<!-- <script type="text/javascript">
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
</script> -->