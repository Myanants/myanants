<!-- ****** PROFILE ****** --> 
<section id="docs" class="docs section">

	<div class="container">
		<div class="docs-inner" style="height: 1000px;">
			<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'custom-link')); ?>
			
			<h3 class="title text-center">Service Request Details</h3>

			<div class="block1">
				<!-- <h3 class="sub-title text-center">Service Requests</h3> -->
				<?php //debug($request); ?>
				<?php if (!empty($request)) : ?>
					<div class="list-group">
						<div class="col-md-3">
							<?php echo 'Service Request ID'; ?>
						</div>
						<div class="col-md-9">
							<?php echo $request['ServiceRequest']['service_request_id']; ?>
						</div>
					</div>

					<div class="list-group">
						<div class="col-md-3">
							<?php echo 'Service Name'; ?>
						</div>
						<div class="col-md-9">
							<?php echo $request['Service']['name'] .' > <label>'. $sub_service[$request['ServiceRequest']['sub_service_id']].'</label>'; ?>
						</div>
					</div>

				<?php endif; ?>

			</div><!--//block-->


			<div class="cta-container">
				<div class="speech-bubble">
					<?php $ans_array = explode('###', $request['ServiceRequest']['answer']) ; ?>
					<?php foreach ($ans_array as $anskey => $ansvalue) : ?>
						<div class="list-group">
							<?php
								$answer_string = '' ;
								$temp_answer = explode('/', $ansvalue);
								$question_id = $temp_answer[0] ;
							?>
							<div class="col-md-12">
								<?php echo $question[$question_id]; ?>
							</div>
							<br/>
							<?php if (strpos($temp_answer[1], '$$') == true) { //TRUE
								$anss = explode('$$', $temp_answer[1]) ;
								foreach ($anss as $k => $val) {
									$answer_string .= $val.',';
								}
								$answer_string = rtrim($answer_string,",");
								?>
								<div class="col-md-12">
									<?php echo $answer_string; ?>
								</div>
							<?php } else { //FALSE ?>
								<div class="col-md-12">
									<?php echo $temp_answer[1]; ?>
								</div>
							<?php } ?>
						</div>
						<br/>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="block1">
				<div class="list-group">
					<h3 class="title text-center">Service Provider Details</h3>
					<?php if (!empty($spInfo)) { ?>
											
						<div class="list-group">
							<div class="col-md-3">
								<?php echo 'Service Provider Name'; ?>
							</div>
							<div class="col-md-9">
								<?php echo $spInfo['ServiceProvider']['name']; ?>
							</div>
						</div>

						<div class="list-group">
							<div class="col-md-3">
								<?php echo 'Business Summary'; ?>
							</div>
							<div class="col-md-9">
								<?php echo $spInfo['ServiceProvider']['business_summary']; ?>
							</div>
						</div>
			
						<div class="list-group">
							<div class="col-md-3">
								<?php echo 'Business Type'; ?>
							</div>
							<div class="col-md-9">
								<?php echo $spInfo['ServiceProvider']['business_type']; ?>
							</div>
						</div>

						<div class="list-group">
							<div class="col-md-3">
								<?php echo 'Pricing'; ?>
							</div>
							<div class="col-md-9">
								<?php echo $spInfo['ServiceProvider']['pricing']; ?>
							</div>
						</div>

						<div class="list-group">
							<div class="col-md-3">
								<?php echo 'Team Member'; ?>
							</div>
							<div class="col-md-9">
								<?php echo $spInfo['ServiceProvider']['teammember']; ?>
							</div>
						</div>

						<?php } else { ?>
							<?php echo "EMPTY"; ?>
						<?php } ?>
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
		margin-bottom: 12%;
	}
	.speech-bubble {
		padding-top: 16px;
		background: #d6f3fc;
		color: #074f66;
		border-radius: 4px;
		padding-left: 16px;
		padding-bottom: 16px;
		line-height: 1.6em;
	}
	
	.cta-container {
		/*max-width: 540px;*/
		margin: 0 auto;
		margin-top: 60px;
		-moz-border-radius: 4px;
		-ms-border-radius: 4px;
		-o-border-radius: 4px;
		border-radius: 4px;
		-moz-background-clip: padding;
		background-clip: padding-box;
	}
	.docs .title {
		color: #074f66;
		margin-top: 30px;
		margin-bottom: 30px;
	}
	.custom-link {
		color: blue;
		float: right;
	}
</style>