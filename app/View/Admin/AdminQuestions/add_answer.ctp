<div class="x_panel">
	<div class="x_title">
		<h2>Add Answer
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><?php echo $service_name[$quest['Question']['service_id']]; ?></button>
		</h2>
		<div class="clearfix"></div>
	</div>
	<h4 class="title">
		<?php echo $quest['SubService']['name'].' '.$quest['SubService']['myan_name']; ?>
	</h4>
	<div class="x_content">
		<ul class="list-unstyled timeline">
			<li>
				<div class="newblock">
					
					<div class="block_content">
						<h2 class="title">
							<a><?php echo $quest['Question']['Ename'].' '.$quest['Question']['Mname']; ?></a>
						</h2>
						
						<p class="excerpt">
							<div class="x_content demo-wrap" id="simple-clone">
								<br />
								<?php
									echo $this->Form->create('Question', array(
										'type' => 'file',
										'class' => 'form-horizontal form-label-left',
										'inputDefaults' => array(
										'label' => false,
										'div' => false
										),
										'id' => 'demo-form2',
										'autocomplete' => 'off'
									));
								?>

								<div class="form-group" style="border-bottom: none;">
									<?php
										echo $this->Form->label('type', 'Question Type', array(
											'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
										));
									?>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<?php 
											echo $this->Form->input('type', array(
												'type' => 'select',
												'options'=> !empty($type) ? $type : array(),
												'label'=>false,
												'empty' => 'Please select your question type',
												'class' => 'form-control',
												'id' => '1st-dd'
											));
										?>
									</div>
								</div>

								<div id="dibox">
								
									<div class="col-md-12">
										<?php
											echo $this->Form->label('answer', 'Answers', array(
											'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
											));
										?>
									</div>

									<center>
										<div class="toclone form-group" style="border-bottom: none;">
											<p class="name">

												<?php
													echo $this->Form->input('Question.0.en_answer', array(
														'type' => 'text',
														'label' => false,
														'class' => 'form-control',
														'style' => 'margin-bottom: 2%;width: 49%;',
														'placeholder' => 'Enter Answer (English)',
														'id' => 'en_answer'
													));
												?>
												<?php
													echo $this->Form->input('Question.0.mm_answer', array(
														'type' => 'text',
														'label' => false,
														'class' => 'form-control',
														'style' => 'width: 49%;',
														'placeholder' => 'Enter Answer (Myanmar)' ,
														'id' => 'mm_answer'

													));
												?>

												<div class="delete col-md-1 col-md-offset-9" style="margin-top: -44px;">
													<span class="btn btn-primary"  id="minus">
														<i class="fa fa-minus" ></i>
													</span>
												</div>

												<div class="clone" style="margin-left: 670px;margin-top: -45px;" >
													<span class="btn btn-primary" id="plus">
														<i class="fa fa-plus" ></i>
													</span>
												</div>
											</p>
										</div>
									</center>

								</div>

								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admin_sub_services', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
										<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
									</div>
								</div>

								<?php echo $this->Form->end(); ?>
							</div>
						</p>
					</div>
				</div>
			</li>

		</ul>

	</div>

</div>

<style type="text/css">
	.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		border-bottom: 1px solid #D9DEE4;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	.logo-space{
		margin-left: -65px;
		border:none;
		color:red;
	}
	.logo-space-before{
		margin-left: -14px;
		border:none;
		color:red;
	}
	.space{
		padding-left: 65px;
	}
	.Message {
		margin-left: 248px;
		color: red;
	}
	/*.delete{
		margin-top: -44px;
	}
	.clone {
		margin-left: 670px;margin-top: -45px;
	}*/

	.timeline .newblock {
    /* margin: 0 0 0 105px; */
    /* border-left: 3px solid #e8e8e8; */
    overflow: visible;
    padding: 10px 15px;
}
</style>

<script>

	$(document).ready(function() {
		$('#simple-clone').cloneya();

		// Disable when selected 'text' in question type option
		$("#1st-dd").change(function() {
			
			if (this.value == 0) {
				$("#dibox *").attr("disabled", "disabled").off('click');
			} else {

				$("#dibox *").removeAttr("disabled");
			}
		});

	});
</script>