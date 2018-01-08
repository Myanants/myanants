<section>
<div class="container">
	<div id="signupbox" class="login_box mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >

			<div class="Utitle" >
				<center><h2 class="hidden-sm hidden-xs">Sign Up</h2></center>
				<center><h3 class="hidden-lg hidden-md">Sign Up</h3></center>
			</div>

			<div class="panel-body" >
				<?php 
					echo $this->Form->create('Customer', array(
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
						<label>User Name</label>
						<?php echo $this->Form->input('name', array( 'class' => 'form-control', 'placeholder' => 'User Name', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>Phone Number</label>
						<?php echo $this->Form->input('phone_number', array( 'class' => 'form-control', 'placeholder' => 'Phone Number', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>Email</label>
						<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>Address</label>
						<?php echo $this->Form->input('address', array( 'class' => 'form-control', 'placeholder' => 'Address', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label>Password</label>
						<?php echo $this->Form->input('password', array('placeholder' => 'password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
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
						echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 5px;width:100%;')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php
					echo $this->Html->link($this->Html->image('facebook-login.jpg', array('style' => 'border-radius: 3px;width:100%')), array('controller' => 'users', 'action'=>'facebookLogin'),
							array( 'escape' => false)); ?>
					</div>
				</div>
				<!-- <div class="form-group">
					<div class="col-md-8 col-md-offset-1 col-sm-8  col-xs-10 ">
						You have an Account? <?php echo $this->Html->link("Login Now!", array('controller' => 'users', 'action' => 'login'),array( 'label' => false,'target' =>'_blank','style' => 'color: #0000ff;')); ?>
					</div>
				</div> -->
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