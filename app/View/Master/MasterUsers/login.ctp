<section>
<div class="container">
	<div class="signupbox mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
		<div class="sub_box" >

			

			<div class="hidden-sm hidden-xs col-md-3" style="margin-top: -8%;margin-bottom: -1%;width: 100%;padding-left: 32%;">        
				<h1 class="logo pull-left">
					<a class="scrollto" href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/colorant.png' class="logoimg" />
					</a>
				</h1><!--//logo-->
			</div>

			<div class="hidden-md hidden-lg col-md-3" style="margin-top: -8%;padding-left: 22%;">
				<h1 class="logo pull-left">
					<a class="scrollto" href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/colorant.png' class="logoimg" style="width: 65%;" />
					</a>
				</h1><!--//logo-->
			</div>

			<div class="Utitle col-md-offset-1" >
				<h2 class="hidden-sm hidden-xs">Sign In For Service Provider</h2>
				<h3 class="hidden-lg hidden-md">Sign In For Service Provider</h3>
			</div>
			

			<div class="panel-body" >
				<?php echo $this->Form->create('ServiceProvider', array('url' => array('controller' => 'master_users', 'action' => 'login'), 'label' => false,'class'=>'form-horizontal')); ?>
				<?php echo $this->Session->flash(); ?>

				<div class="form-group" ></div>
				<div class="form-group" >
					<div class="col-md-10 col-md-offset-1 ">
						<label>User Name</label>
						<?php if ($name) : ?>
							<?php echo $this->Form->input('name', array( 'class' => 'form-control', 'placeholder' => 'User name', 'autofocus' => true, 'autocomplete' => 'off','label' => false,'value'=> $name)); ?>
						<?php else : ?>
							<?php echo $this->Form->input('name', array( 'class' => 'form-control', 'placeholder' => 'User name', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<label>Password</label>
						<?php if ($password): ?>
							<?php echo $this->Form->input('password', array('value' => $password, 'placeholder' => 'password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						<?php else: ?>
							<?php echo $this->Form->input('password', array('placeholder' => 'password', 'autocomplete' => 'off','label' => false,'type'=>'password', 'class' => 'form-control')); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group" ></div>
				<div class="form-group">
					<div class="col-md-10 col-md-offset-1">
					<?php if(!empty($remember_me)):?>
						<?php echo $this->Form->checkbox('remember_me',array('checked'=>true)); ?>
					<?php  else:?>
						<?php echo $this->Form->checkbox('remember_me' ); ?>
					<?php endif;?>
						<?php echo $this->Form->label('remember_me', 'Do you remember');?>
					</div>
				</div>

				<!-- <div class="form-group">
					<div class="col-md-10 col-md-offset-1">
						<?php echo $this->Html->link("Click here if you forgot your password", array('controller' => 'master_users', 'action' => 'remind'),array( 'label' => false,'target' =>'_blank','style' => 'color: #0000ff;')); ?>
					</div>
				</div> -->

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-xs hidden-sm">
						<?php echo $this->Form->button('Login', array('class'=>'btn btn-info btn-md btn-block','type'=>'submit')); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-1 hidden-lg hidden-md">
						<?php echo $this->Form->button('Login', array('class'=>'btn btn-info btn-sm btn-block','type'=>'submit','style'=>'width:100%;')); ?>
					</div>
				</div>

				<!-- <div class="form-group">
					<div class="col-md-6 col-md-offset-1 col-sm-8  col-xs-10 ">
						With your social media account
					</div>
				</div> -->

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
						Don't have an Account? <?php echo $this->Html->link("Register Now!", array('controller' => 'master_users', 'action' => 'add'),array( 'label' => false,'target' =>'_blank','style' => 'color: #0000ff;')); ?>
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
		margin-top: 5%;
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
	.message {
		color: red;
		padding-left: 0%;
	}


</style>