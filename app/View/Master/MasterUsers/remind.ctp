<div>
	<a class="hiddenanchor" id="signup"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<?php echo $this->Form->create('ServiceProvider', array('url' => array('controller' => 'master_users','action' => 'remind', $token),'class' => 'login-form','label' => false,'type' => 'post','inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<div class="inner">
					<p>
						<?php echo $this->Form->label('password', 'Password:'); ?>
						<?php echo $this->Form->input('password', array('label' => false, 'autocomplete' => 'off' , 'placeholder' => 'Password must be 8 to 20 digits')); ?>
					</p>
					<p>
						<?php echo $this->Form->label('confirm_password', 'Confirm Password:'); ?>
						<?php echo $this->Form->input('confirm_password', array('type' => 'password','label' => false, 'autocomplete' => 'off' , 'placeholder' => 'Password must be 8 to 20 digits' )); ?>
					</p>
					<div class="action mailremind">
						<?php echo $this->Form->submit('Save', array('class' => 'btn btn-md btn-success btn-block')); ?>
						<div class="clear"> </div>
					</div>
					<p>
						<?php echo $this->Html->link("Click here for login", array('controller' => 'users',
						'action' => 'login')); ?>
					</p>
					<div class="clearfix"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i><img src="/img/logo/myanants-black.png" style="width: 50%;margin-top: -36%;margin-bottom: -32%;"></i></h1>
							<p>Copyright © MyanAnts All rights reserved. </p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php echo $this->Form->end(); ?>
			</section>
		</div>
	</div>
</div>

<style type="text/css">
	.mailremind {
		margin-left: -36px;
		margin-right: 38px;
		margin-bottom: 16px;
	}
</style>