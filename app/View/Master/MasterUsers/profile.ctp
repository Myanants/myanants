<!-- ****** PROFILE ****** --> 
<section id="docs" class="docs section">
	<div class="container">
		<div class="docs-inner">

			<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'custom-link')); ?>
			<?php $service_provider_id =AuthComponent::user('service_provider_id');?>

			<h2 class="title text-center">Your Informations</h2>
			<div class="block1">
				<p class="col-md-12 text-center btn-cta-primary" style="background: #335b98;padding-top: 10px;padding-bottom: 10px;border-radius: 5px;">
					Your ID : <?php echo $service_provider_id; ?>
				</p>
			</div><!--//block-->


			<div class="block1">
				<!-- <h3 class="sub-title text-center">Service Requests</h3> -->
				

				<div class="list-group list-group-item request-data request-header">
					<!-- <a href="#" class="list-group-item request-data"> -->
						<div class="col-md-3">Service Request ID</div>
						<div class="col-md-3">Requested Date</div>
						<div class="col-md-3">Service Name</div>
					<!-- </a> -->
				</div>

				<div class="list-group">
					<?php foreach ($request as $key => $value) : ?>
						<a href="detail/<?php echo $value['ServiceRequest']['id']; ?>" class="list-group-item request-data">
							<div class="col-md-3">
								<?php echo $value['ServiceRequest']['service_request_id']; ?>
							</div>
							<div class="col-md-3">
								<?php echo $value['ServiceRequest']['modified']; ?>
							</div>
							<div class="col-md-5">
								<?php echo $value['Service']['name']; ?>
							</div>					
						</a>
					<?php endforeach; ?>
				</div>

				<!-- <p class="text-center">
					<a class="btn btn-cta-primary" href="https://github.com/xriley/devAid-Theme" target="_blank">More Detail</a>
				</p> -->
			</div><!--//block-->

		
		<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'custom-link')); ?>

		</div><!--//docs-inner-->
	</div><!--//container-->
</section><!--//features-->

<style type="text/css">
	.lm-custom {
		overflow-y: hidden;
		height: 70px;
		padding-top: 0px;
		font-family: 'Lato', arial, sans-serif;
		color: #444;
		font-size: 16px;
		-webkit-font-smoothing: antialiased;
	}
	.request-data {
		padding-top: 2%;
		padding-bottom: 5%;
		color: #fff;
	}
	.request-header {
		/*background-color: #074f66 ;*/
		background-color: lightgray ;
	}
	.block1 {
		margin-bottom : 80px;
	}
	.custom-link {
		color: blue;
		float: right;
	}
</style>