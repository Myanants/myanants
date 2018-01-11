<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
		<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
		<?php echo $this->fetch('meta'); ?>
		<!-- ========== Title ========== -->
		<title><?php echo 'MyanAnts | We Connect Service Providers' ?></title>

		<!-- ========== CSS ========== -->
		<?php echo $this->Html->css('custom.min'); ?>
		<?php echo $this->Html->css('bootstrap.min'); ?>
		<?php echo $this->Html->css('font-awesome.min'); ?>
		<?php echo $this->Html->css('nprogress'); ?>
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>		
	</head>
	<body class="nav-md">
		<?php echo $this->fetch('content'); ?>
		
		<!-- jQuery -->
		<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>
		<?php echo $this->Html->script('fastclick'); ?>
		<?php echo $this->Html->script('nprogress'); ?>
		<?php echo $this->Html->script('custom'); ?>
		<?php echo $this->Html->script('message'); ?>
		<?php echo $this->Html->script('logo'); ?>
	</body>
</html>