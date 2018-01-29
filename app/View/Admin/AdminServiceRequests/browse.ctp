<div class="x_panel">
	<div class="x_title">
		<div class="col-md-12">
			<h2 style="float: left;">Service Request Detail</h2>

			<div class = "adjust" style="float: right;width: 80%;">
				<div class="col-md-10">
					<div class="col-md-5">
						<?php
						if (!empty($data['ServiceRequest']['service_provider_id'])) {
							$spId = $data['ServiceRequest']['service_provider_id'] ;
						} else {
							$spId = '' ;
						}
						echo $this->Form->input('sProvider', array(
									'label' => false,
									'options' => $sProvider,
									'value' => $spId, 
									'empty' => 'Add service provider',
									'class' => 'sProvider form-control col-md-7 col-xs-12',
									'id' => $data['ServiceRequest']['id']
								)
							);
						?>
					</div>

					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php if (!empty($data['ServiceRequest']['service_provider_id'])) { ?>
		<div class="lbl-sp col-md-6" style="display: block;">
			<label>
				<?php echo $sProvider[$data['ServiceRequest']['service_provider_id']]; ?>
			</label>
		</div>
	<?php } else { ?>
		<div class="lbl-sp col-md-6" style="display: none;">
			<label></label>
		</div>
	<?php } ?>
	

	<h4><label>Customer Informations</label></h4>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Customer ID</td>
					<td class="right">
						<?php echo $data['Customer']['customer_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Name</td>
					<td class="right"><?php echo $data['Customer']['name'] ; ?></td>
				</tr>

				<tr>
					<td class="left"> Email </td>
					<td class="right">
						<?php if (!empty($data['Customer']['email'])) { ?>
							<?php echo $data['Customer']['email'] ; ?>
						<?php } ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php echo $data['Customer']['phone_number'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Address</td>
					<td class="right"> 
						<?php echo nl2br($data['Customer']['address']) ; ?>						
					</td>
				</tr>
				
			</tbody>
		</table>
		
	</div>

	<h4><label>Service Request Informations</label></h4>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				
				<tr>
					<td class="left">Service Name</td>
					<td class="right"> 
						<?php echo $data['Service']['name']; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Service Rrequest ID</td>
					<td class="right"> 
						<?php echo $data['ServiceRequest']['service_request_id']; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Questions & Answers</td>
					<td class="right">
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
					</td>
				</tr>

				<tr>
					<td class="left">Status</td>
					<td class="right">
						<?php
							if ($data['ServiceRequest']['status'] == 1) {
								echo "Canceled from Customer";
							} elseif ($data['ServiceRequest']['status'] == 2) {
								echo "Canceled from Service Provider";
							} elseif ($data['ServiceRequest']['status'] == 3) {
								echo "Confirmed";
							} elseif ($data['ServiceRequest']['status'] == 4) {
								echo "Not Confirmed Yet";
							}
						?>
					</td>
				</tr>

				<tr>
					<td class="left">Request Time</td>
					<td class="right">
						<?php echo $data['ServiceRequest']['request_datetime']; ?>	
					</td>
				</tr>

			</tbody>
		</table>

		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php //echo $this->Html->link('Edit', array('controller' => 'admin_companys', 'action' => 'edit', h($data['Customer']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
			</div>
		</div>
	</div>

</div>

<style type="text/css" media="screen">
	table.table-st {
		width:100%;
	}
	table.table-st tr {
		border-bottom: 1px solid #D9DEE4;
	}
	table.table-st tbody tr td.left{
		width:93%;
		padding:10px;
	}
	table.table-st tbody tr td.right{
		width:71%;
		text-align: left;
		padding:10px;
	}
	.lbl-sp {
		padding-top: 5px;
		background: #47e847;
		border-radius: 5px;
		width: 30%;
		margin-right: 70%;
		margin-bottom: 2%;
	}

</style>

<script type="text/javascript">
	$(document).ready(function(){
		// $('.lbl-sp').hide();
		$('.sProvider').on('change', function() {

			if (!this.value) {
				$('.lbl-sp').hide();
				var selectedValue = '' ;
				var id = this.id ;

			} else {
				$('.lbl-sp').show();

				var selectedValue = this.value ;
				var id = this.id ;		
				var selectedText = $(".sProvider option:selected").text();				

				$('.lbl-sp').children().text(selectedText);
				
			}

			$.ajax({

				// url: "../servicerequest/ajaxProvider",
				url: "../ajaxProvider",
				type: "POST",
				data:{ data : selectedValue , id : id },
				dataType: "json",
				success : function(response){
					console.log("Ajax Success");
				},
				error: function(){}

			});

			
		});
	});

</script>