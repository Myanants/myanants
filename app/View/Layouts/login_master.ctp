<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyanAnts | We Connect Service Providers</title>
	
	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
	<?php echo $this->Html->meta(array('name '=>'description','content'=>'MyanAnts is the No.1 Leading Home Service Provider in Yangon.It will provide services like AC Installation,Cleaning,Electrical and Plumbing.There’s more in MyanAnts which is available in Yangon.As foreign people are finding help for their homes,we have every services that you wanted.'))?>
	<?php echo $this->Html->meta(array('name '=>'keywords','content'=>'Home service provider, Home service provider in Yangon, No.1 & leading Home service provider, services, cleaning, electrical, plumbing'))?>
	<?php echo $this->Html->meta(array('name '=>'author','content'=>'myanants.com'))?>
	<link rel="shortcut icon" href="favicon.ico">  

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>	

	<?php echo $this->Html->css('home/bootstrap/css/bootstrap.min'); ?>
	<?php echo $this->Html->css('home/font-awesome/css/font-awesome'); ?>
	<?php echo $this->Html->css('home/prism/prism'); ?>
	<?php echo $this->Html->css('styles'); ?>
	<?php echo $this->Html->css('mobile'); ?>
</head> 

<body data-spy="scroll">
	
	<!---//Facebook button code-->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	

	<?php $user_id = AuthComponent::user('id'); ?>
	
	<!-- ================Content Part==============================-->
	<?php echo $this->fetch('content'); ?>
	<!-- ================Footer==============================-->
	 
	<?php echo $this->Html->script('home/jquery-1.11.3.min'); ?>   
	<?php echo $this->Html->script('home/jquery.easing.1.3'); ?>   
	<?php echo $this->Html->script('home/bootstrap/js/bootstrap.min'); ?>   
	<?php echo $this->Html->script('home/jquery-scrollTo/jquery.scrollTo.min'); ?>   
	<?php echo $this->Html->script('home/prism/prism'); ?>   
	<?php echo $this->Html->script('home/main'); ?>   
</body>
</html> 

<script type="text/javascript">
	// $('select').on('change', function() {
	// 	location.replace("http://myanants.com/staging"+this.value+"/master_users/index");
	// })
</script>