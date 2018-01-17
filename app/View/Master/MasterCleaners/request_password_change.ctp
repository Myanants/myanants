<div>
	<a class="hiddenanchor" id="signup"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<?php echo $this->Form->create('Cleaner', array('class' => 'login-form', 'label' => false, 'type' => 'post', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
					<h1>Password Reset</h1>
					<font color='red'><b><?php echo $this->Session->flash(); ?></b></font>
					<div>
						<?php echo $this->Form->input('email', array( 'class' => 'form-control', 'placeholder' => 'email', 'autofocus' => true, 'autocomplete' => 'off','label' => false)); ?>
					</div>
					<div class="action mailremind">
						<?php echo $this->Form->submit('Send', array('class' => 'btn btn-md btn-success btn-block')); ?>
						<div class="clear"> </div>
					</div>
					<p> <?php echo $this->Html->link("Click here for login", "/master/cleaner/login"); ?> </p>
					<div class="clearfix" style="padding-bottom: 9px;"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i>
								<a href="http://myanants.com/staging/"><img src="http://myanants.com/staging/img/logo/myanants-black.png" style="width: 50%;margin-top: -36%;margin-bottom: -32%;"></a>
							</i></h1>
							<p>Copyright © MyanAnts All rights reserved. </p>
						</div>
					</div>
					<div class="clearfix"></div>
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