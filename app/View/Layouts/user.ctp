<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyanAnts | We Connect Service Providers</title>
	
	<?php echo $this->Html->charset(); ?>
	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
	<?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
	<?php //echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
	<?php echo $this->Html->meta(array('name '=>'description','content'=>'MyanAnts is the No.1 Leading Home Service Provider in Yangon.It will provide services like AC Installation,Cleaning,Electrical and Plumbing.There’s more in MyanAnts which is available in Yangon.As foreign people are finding help for their homes,we have every services that you wanted.'))?>
	<?php echo $this->Html->meta(array('name '=>'keywords','content'=>'Home service provider, Home service provider in Yangon, No.1 & leading Home service provider, services, cleaning, electrical, plumbing'))?>
	<?php echo $this->Html->meta(array('name '=>'author','content'=>'myanants.com'))?>
	<?php //echo $this->fetch('meta'); ?>
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
	
	<!-- ******HEADER****** --> 
	<header id="header" class="header">  
		<div class="container">            
			<div class="hidden-sm hidden-xs col-md-3" style="margin-top: -3%;margin-bottom: -1%;">        
				<h1>
					<a href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/mm.png' class="logoimg" />
					</a>
				</h1><!--//logo-->
			</div>    

			<div class="hidden-md hidden-lg col-md-3" style="margin-top: -3%;margin-bottom: -1%;">        
				<h1 class="logo pull-left">
					<a class="scrollto" href="http://myanants.com/staging">
						<img src='http://myanants.com/staging/img/mm.png' class="logoimg" />
					</a>
				</h1><!--//logo-->
			</div>

			<nav id="main-nav" class="main-nav navbar-right" role="navigation">
				<div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button><!--//nav-toggle-->
				</div><!--//navbar-header-->            
				<div class="navbar-collapse collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active nav-item sr-only"><a class="scrollto" href="#promo">Home</a></li>
						<li class="nav-item">
							<?php if(empty($user_id)) : ?>
								<?php echo $this->Html->link("LOGIN", array('controller' => 'users', 'action' => 'login')) ;?>
							<?php else: ?>
								<?php echo $this->Html->link("LOGOUT", array('controller' => 'users', 'action' => 'logout')) ;?>
							<?php endif; ?>
						</li>
						<li class="nav-item">
							<?php if(empty($user_id)) : ?>
								<?php echo $this->Html->link("REGISTER", array('controller' => 'users', 'action' => 'add')) ;?>
							<?php endif; ?>
						</li>

						<li class="nav-item">
							<?php
								$currentUrl = Router::url($this->here, true);
								if (strpos($currentUrl, '/mya/') !== false || $currentUrl == 'http://myanants.com/staging') {
									echo $this->html->link('English', array('language'=>'eng'));
								} elseif (strpos($currentUrl, '/eng/') !== false) {
									echo $this->html->link('ျမန္မာ', array('language'=>'mya'));
								}
							?>	
						</li>

					</ul><!--//nav-->
				</div><!--//navabr-collapse-->
			</nav><!--//main-nav-->
		</div>
	</header><!--//header-->
	
	<!-- ================Content Part==============================-->
	<?php echo $this->fetch('content'); ?>
	<!-- ================Footer==============================-->
	<?php $user_id = AuthComponent::user('id'); ?>
			
	<!-- ******CONTACT****** --> 
	<section id="contact" class="contact section has-pattern">
		<div class="container">
			<div class="contact-inner">
				<div class="clearfix"></div>
				<div class="info text-center">
					<h4 class="sub-title">Get Connected</h4>
					<ul class="social-icons list-inline">
						<li><a href="https://www.facebook.com/MyanAnts/" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.linkedin.com/company/13391896/"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="https://www.instagram.com/myanants/"><i class="fa fa-instagram"></i></a></li>              
					</ul>
				</div><!--//info-->
			</div><!--//contact-inner-->
		</div><!--//container-->
	</section><!--//contact-->  
	  
	<!-- ******FOOTER****** --> 
	<footer class="footer">
		<div class="container text-center">
			<small class="copyright">© 2017 MyanAnts. All rights reserved.</small>
		</div><!--//container-->
	</footer><!--//footer-->
	 
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
	// 	location.replace("http://myanants.com/staging"+this.value+"/users/index");
	// })
</script>