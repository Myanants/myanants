<section>
<div class="container">
	<div class="signupbox mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >

			<div class="hidden-sm hidden-xs col-md-3" style="margin-top: -6%;margin-bottom: -1%;width: 100%;padding-left: 32%;">
				<h1 class="logo pull-left">
					<a href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/colorant.png' style="width: 50%;" />
					</a>
				</h1><!--//logo-->
			</div>

			<div class="hidden-md hidden-lg col-md-3" style="margin-top: -8%;padding-left: 22%;">
				<h1 class="logo pull-left" style="margin-bottom: -8%;">
					<a href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/colorant.png' class="logoimg" style="width: 65%;" />
					</a>
				</h1><!--//logo-->
			</div>

			<div class="Utitle" >
				<center><h2 class="hidden-sm hidden-xs">
					<?php echo __('Service Provider Register'); ?>
				</h2></center>
				<center><h3 class="hidden-lg hidden-md">
					<?php echo __('Service Provider Register'); ?>
				</h3></center>
			</div>

			<div class="panel-body">
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
				<?php echo $this->Session->flash(); ?>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Service Provider ID'); ?>
						</label>
						<?php //echo $this->Form->input('id', array( 'class' => 'form-control', 'placeholder' => '', 'autofocus' => true, 'autocomplete' => 'off','label' => false,'value' => $UserCode,'disabled' => true)); ?>

						<?php
							echo $this->Form->input('id', array(
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
						<label>
							<?php echo __('Name'); ?>
							<span class="required" style="color: red;">*</span>
						</label>
						<?php echo $this->Form->input('name', array( 'class' => 'form-control', 'placeholder' => 'User Name', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Company Name'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('company_name', array( 'class' => 'form-control', 'placeholder' => 'Company name', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Phone Number'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('phone', array( 'class' => 'form-control', 'placeholder' => 'Phone Number', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Email'); ?>
						</label>
						<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Address'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('address', array( 'class' => 'form-control', 'placeholder' => 'Address', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('NIRC'); ?>
						</label>
						<?php echo $this->Form->input('nirc', array( 'class' => 'form-control', 'placeholder' => 'nirc', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Number of team member'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php //echo $this->Form->input('teammember', array( 'class' => 'form-control', 'placeholder' => 'teammember', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
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

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Business Summary'); ?>
						</label>
						<?php echo $this->Form->input('business_summary', array('type' => 'textarea' ,'class' => 'form-control', 'placeholder' => 'business summary', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Legal'); ?>
						</label>						
					</div>
					<div class="col-md-10 col-md-offset-1">
						<input type="radio" name="data[ServiceProvider][legal]" value="0" checked="checked" > No &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="data[ServiceProvider][legal]" value="1" > Yes 
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Category'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('business_type', array( 'class' => 'form-control', 'placeholder' => 'business type', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Prefer Location'); ?>
						</label>
						<?php echo $this->Form->input('prefer_location', array( 'class' => 'form-control', 'placeholder' => 'prefer location', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Team Photo'); ?>
						</label>
						<div class="col-md-10" style="padding-left: 1%;">
							<?php
								echo $this->Form->input('photo', array(
									'type' => 'file',
									'label' => false
								));
							?>
						</div>
						<div id='imageValidate' class="col-md-6 col-sm-6 col-xs-12 Message" style='display: none'>Please Choose The Image</div>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Pricing'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('pricing', array('type' => 'textarea' , 'class' => 'form-control', 'placeholder' => 'pricing', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Experience'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
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

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>
							<?php echo __('Township'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
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

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label>
							<?php echo __('Password'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('password', array('placeholder' => 'Password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label>
							<?php echo __('Confirm Password'); ?>
							<span class="required" style="color:red;">*</span>
						</label>
						<?php echo $this->Form->input('confirm_password', array('placeholder' => 'Confirm Password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php echo $this->Form->button('Submit', array('class'=>'btn btn-info btn-md btn-block','type'=>'submit')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php echo $this->Form->button('Submit', array('class'=>'btn btn-info btn-sm btn-block','type'=>'submit','style'=>'width:100%;')); ?>
					</div>
				</div>

				<!-- <div class="form-group" >
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
				</div> -->
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
	
	.required {
		color: red;
	}
</style>

