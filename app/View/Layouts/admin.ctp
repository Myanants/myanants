<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
			<?php echo $this->Html->meta(null, null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1')); ?>
		<?php echo $this->Html->meta(array('http-equiv '=>'X-UA-Compatible','content'=>'IE=edge'))?>
		<?php echo $this->fetch('meta'); ?>
		<!-- ========== Title ========== -->
		<title><?php echo 'MyanAnts | We Connect Service Providers'; ?></title>
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
												<?php echo $this->Html->link('Customer List', array('controller' => 'admincustomers', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Customer Add', array('controller' => 'admincustomers', 'action' => 'add')); ?>
											</li>
										</ul>
									</li>
																		
									<li><a><i class="fa fa-edit"></i> <?php echo "Service Provider" ; ?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li><?php echo $this->Html->link('Service Provider List', array('controller' => 'adminserviceproviders', 'action' => 'index')); ?></a></li>
											<li><?php echo $this->Html->link('Service Provider Add', array('controller' => 'adminserviceproviders', 'action' => 'add')); ?></a></li>
										</ul>
									</li>

									<li><a><i class="fa fa-building-o"></i> <?php echo "Service"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
										
												<?php echo $this->Html->link('Service List', array('controller' => 'adminservices', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Service Add', array('controller' => 'adminservices', 'action' => 'add')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Sub Service Add', array('controller' => 'adminsubservices', 'action' => 'add')); ?>
											</li>
										</ul>
									</li>

									

									<!-- <li><a><i class="fa fa-building-o"></i> <?php echo "Service Request"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
										
												<?php echo $this->Html->link('Service Request List', array('controller' => 'adminservicerequests', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Service Request Add', array('controller' => 'adminservicerequests', 'action' => 'add')); ?>
											</li>
										</ul>
									</li> -->


									<li><a><i class="fa fa-cogs"></i> <?php echo "Form Setting"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Form', array('controller' => 'adminsubservices', 'action' => 'index')); ?>
											</li>
											
										</ul>
									</li>

									<li><a><i class="fa fa-bar-chart"></i> <?php echo "Record"?> <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li>
												<?php echo $this->Html->link('Record', array('controller' => '', 'action' => 'index')); ?>
											</li>
											<li>
												<?php echo $this->Html->link('Record Add', array('controller' => '', 'action' => 'add')); ?>
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
		<?php echo $this->Html->script('fastclick'); ?>
		<?php echo $this->Html->script('nprogress'); ?>
		<?php echo $this->Html->script('custom'); ?>
		<?php echo $this->Html->script('message'); ?>
		<?php echo $this->Html->script('logo'); ?>
	</body>
</html>
