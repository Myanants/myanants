<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
		<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
		<?php echo $this->fetch('meta'); ?>
		<!-- ========== Title ========== -->
		<title><?php echo 'MyanAnts | We Connect Service Providers'; ?></title>
	
		<?php echo $this->Html->charset(); ?>
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
		<?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
		<?php //echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
		<?php echo $this->Html->meta(array('name '=>'description','content'=>'MyanAnts is the No.1 Leading Home Service Provider in Yangon.It will provide services like AC Installation,Cleaning,Electrical and Plumbing.There’s more in MyanAnts which is available in Yangon.As foreign people are finding help for their homes,we have every services that you wanted.'))?>
		<?php echo $this->Html->meta(array('name '=>'keywords','content'=>'Home service provider, Home service provider in Yangon, No.1 & leading Home service provider, services, cleaning, electrical, plumbing'))?>
		<?php echo $this->Html->meta(array('name '=>'author','content'=>'myanants.com'))?>
		<?php //echo $this->fetch('meta'); ?>
		<link rel="shortcut icon" href="favicon.ico">


		<!-- ========== CSS ========== -->
		
		<?php echo $this->Html->css('//cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css'); ?>
		<?php echo $this->Html->css('bootstrap.min'); ?>
		<?php echo $this->Html->css('font-awesome.min'); ?>
		<?php echo $this->Html->css('nprogress'); ?>
		<?php echo $this->Html->css('custom.min'); ?>
		<?php echo $this->Html->css('green'); ?>
		<?php echo $this->Html->css('adstyle'); ?>
		<?php echo $this->Html->css('report'); ?>
		<?php echo $this->Html->css('message'); ?>
		<?php echo $this->Html->css('select2.min'); ?>
		<?php echo $this->Html->css('custombtntb'); ?>
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>
		<?php echo $this->Html->script('select2.min'); ?>
		<?php echo $this->Html->script('datatables.min') ?>
		<?php echo $this->Html->script('datatable'); ?>
		<?php echo $this->Html->script('jquery-cloneya'); ?>
	
		
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;margin-left: 70px;margin-left: -11px;">
							<?php echo $this->Html->link('<img src= "/img/logo/myanants-white.png" alt="MyanAnts" style = "width: 76%;height: 59%;margin-top: 24%;" >', array('controller' => 'admin', 'action' => 'company/index'), array('class' => 'site_title', 'escape' => false,'style' => 'padding-left:-1px; width: 100%; height:112px;margin-top: -57px;')) ?>
						</div>
						<br />
						<?php $string = Router::reverse($this->params); ?>
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<h3>Welcome Admin</h3>
								<ul class="nav side-menu">
									
									<li><a><i class="fa fa-users"></i> <?php echo "Customer " ; ?><span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Customer List', array('controller' => 'admin_customers', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Customer Add', array('controller' => 'admin_customers', 'action' => 'add')); ?>
											</li>
										</ul>
									</li>
																		
									<li><a><i class="fa fa-edit"></i> <?php echo "Service Provider" ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li><?php echo $this->Html->link('Service Provider List', array('controller' => 'admin_service_providers', 'action' => 'index')); ?></a></li>
											<li><?php echo $this->Html->link('Service Provider Add', array('controller' => 'admin_service_providers', 'action' => 'add')); ?></a></li>
										</ul>
									</li>

									<li><a><i class="fa fa-building-o"></i> <?php echo "Service"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Service List', array('controller' => 'admin_services', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Service Add', array('controller' => 'admin_services', 'action' => 'add')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Sub Service Add', array('controller' => 'admin_sub_services', 'action' => 'add')); ?>
											</li>

										</ul>
									</li>

									

									<!-- <li><a><i class="fa fa-building-o"></i> <?php echo "Service Request"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
										
												<?php echo $this->Html->link('Service Request List', array('controller' => 'admin_service_requests', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Service Request Add', array('controller' => 'admin_service_requests', 'action' => 'add')); ?>
											</li>
										</ul>
									</li> -->


									<li><a><i class="fa fa-cogs"></i> <?php echo "Question"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Question List', array('controller' => 'admin_questions', 'action' => 'index')); ?>
											</li>
										<!-- 	<li>
												<?php echo $this->Html->link('Question Add', array('controller' => 'admin_sub_services', 'action' => 'add_answer')); ?>
											</li> -->
											<li>
												<?php echo $this->Html->link('Question Setting', array('controller' => 'admin_sub_services', 'action' => 'form')); ?>
											</li>
											
										</ul>
									</li>

									<li><a><i class="fa fa-bar-chart"></i> <?php echo "Record"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Record', array('controller' => 'admin_service_requests', 'action' => 'index')); ?>
											</li>
										</ul>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Admin
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li>
											<?php echo $this->Html->link('<i class="fa fa-sign-out pull-right"></i> Log Out', array('controller' => 'adminusers', 'action' => 'logout'), array('escape' => false)); ?>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div id="mydiv">
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
	<!-- ================Content Part==============================-->
									<div class="x_content">
										<?php echo $this->fetch('content'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<?php //echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'); ?>
		<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>

		<?php echo $this->Html->script('fastclick'); ?>
		<?php echo $this->Html->script('nprogress'); ?>
		<?php echo $this->Html->script('custom'); ?>
		<?php echo $this->Html->script('message'); ?>
		<?php echo $this->Html->script('logo'); ?>
	</body>
</html>
