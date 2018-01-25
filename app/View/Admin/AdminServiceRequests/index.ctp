<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Service Request List</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				
				<div class = "adjust">
					<div class="col-md-2">
						<?php
							echo $this->Form->create(array('type'=>'get'));
							echo $this->Form->input('name', array(
								'empty' => FALSE,
								'onChange' => 'this.form.submit();',
								'name' => 'limit',
								'label' => 'Show&nbsp;',
								'default' => intval($limit),
								'options' => array_combine(array('50', '100','150'), array('50', '100','150')),
								'class' => 'btn btn-default'
							));
						?>
					</div>
					<div class="col-md-10">

						<div class="col-md-4">
							<?php if (!empty($this->params->query['status'])): ?>
								<?php $deact_act = trim($this->params->query['status']); ?>
							<?php else: ?>
								<?php $deact_act = ''; ?>
							<?php endif; ?>

							<?php echo $this->Form->input('status', array(
										'label' => false,
										'default'=> $deact_act ,
										'options' =>array('1'=>'Customer Cancel','2'=>'S_Provider Cancel', '3' => 'Not Confirmed','4' => 'No Status'),
										'onChange' => 'this.form.submit();',
										'empty' => 'Please select the status',
										'class' => 'form-control col-md-7 col-xs-12'
									)
								);
							echo $this->Form->end();
							?>
						</div>

						<div class="search-box sbox">
							<?php echo $this->Form->create('ServiceRequest', array('type' => 'get', 'url' => array('controller' => 'admin_service_requests', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
								<div class="input-group">
									<?php if (!empty($this->params->query['keyword'])) : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search','class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'value' => $this->params->query['keyword'], 'required' => false)); ?>
									<?php else : ?>
										<?php echo $this->Form->input('keyword', array('label' => false, 'id' => 'search', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Search for...', 'required' => false)); ?>
									<?php endif; ?>

									<span class="input-group-btn">
										<?php echo $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i>', array('class' => 'btn btn-default')); ?>
									</span>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>

					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('ServiceRequest.service_request_id', 'Request ID'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceRequest.customer_id', 'Customer ID'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceRequest.customer_name', 'Customer Name'); ?></th>
								<!-- <th><?php echo $this->Paginator->sort('ServiceRequest.phone_number', 'Phone Number'); ?></th> -->
								<th><?php echo $this->Paginator->sort('ServiceRequest.type', 'Service Name'); ?></th>
								<th class="col-md-2"><?php echo $this->Paginator->sort('ServiceRequest.status', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceRequest.modified', 'Request Time'); ?></th>
								<th style="width: 26%;">Operations</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php foreach ($pag as $key => $value): ?>
								<tr>
									<td>
										<?php if(!empty($value['ServiceRequest']['service_request_id'])): ?>
											<?php echo h($value['ServiceRequest']['service_request_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['customer_id'])): ?>
											<?php echo h($value['Customer']['customer_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['name'])): ?>
											<?php if(strlen($value['Customer']['name']) > 30): ?>
												<?php echo mb_substr($value['Customer']['name'],0,30,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Customer']['name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<!-- <td>
										<?php if(!empty($value['Customer']['phone_number'])): ?>
											<?php echo h($value['Customer']['phone_number']); ?>
										<?php endif; ?>
									</td> -->

									<td>
										<?php if(!empty($value['Service']['name'])): ?>
											<?php echo h($value['Service']['name']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($value['ServiceRequest']['status'] == 1) { ?>
											<label class="col-md-11 btn-blue lbl-status" style="background : blue;">Customer Cancel</label>
										<?php } elseif ($value['ServiceRequest']['status'] == 2) { ?>
											<label class="col-md-11 btn-blue lbl-status" style="background : red ;">S_Provider Cancel</label>	
										<?php } elseif ($value['ServiceRequest']['status'] == 3) { ?>
											<label class="col-md-11 btn-blue lbl-status" style="background : green ;">Not Confirmed</label>	
										<?php } else { ?>
											<label class=""></label>
										<?php } ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceRequest']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['ServiceRequest']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td style="width: 26%;">
										<?php

											$langs = array('opt1' => 'Customer Cancel', 'opt2' => 'S_Provider Cancel', 'opt3' => 'Not Confirmed','opt4' => 'Remove Status');

											echo $this->Form->input('status', array(
												'type' => 'select',
												'options' => $langs,
												'empty' => 'Status',
												'class' => 'status col-md-5 btn-sm',
												'label' => false,
												'style' => 'margin-right: 7px;',
												'id' => $value['ServiceRequest']['id']
												)
											);
										?>

										<?php echo $this->Html->link('View', array('controller' => 'admin_service_requests', 'action' => 'browse',h($value['ServiceRequest']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'admin_service_requests', 'action' => 'delete', h($value['ServiceRequest']['id'])), array('confirm' => "Would you like to delete this service request?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
									</td>
								</tr>
							<?php endforeach; ?>

						</tbody>

					</table>

					<p class="pull-left"><?php echo $this->Paginator->counter(array('format' => __('Display {:start}~{:end} of {:count} Items'))); ?></p>

					<div class="pull-right">
						<?php
							echo $this->Paginator->first(__('first'), array('class' => 'pagi gradient disabled'));
							if ($limit > 50) {
								echo $this->Paginator->prev(__('prev'), array(), null, array('class' => 'prev disabled', 'id' => 'example_first', 'tag' => false));
							}
							echo $this->Paginator->numbers(array(
								'separator' => false,
								'currentTag' => 'a',
								'class' => 'pagi gradient',
								'currentClass' => 'pagi active',
								'modulus' => 4,
								'ellipsis' => '. . .',
								'last' => 1,
								'first' => 1,
							));
							if ($limit > 50) {
								echo $this->Paginator->next(__('next'), array(), null, array('class' => 'next disabled', 'id' => 'example_next'));
							}
							echo $this->Paginator->last(__('last'), array('class' => 'pagi gradient disabled'));
						?>
					</div>
				<?php else: ?>
					<?php echo "EMPTY"; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.status').on('change', function() {
		var status = $(this).parent().parent().prev().prev().children();
		var selectedValue = this.value ;
		var id = this.id ;

		$.ajax({

			url: "../servicerequest/ajaxStatus",
			type: "POST",
			data:{ data : selectedValue , id : id },
			dataType: "json",
			success : function(response){
				console.log("Ajax Success");
			},
			error: function(){}

		});


		if (this.value == 'opt1') { // Cancel from Customer
			status.attr('style','background : blue;');
			status.attr('class','col-md-11 btn-blue lbl-status');
			status.text('Customer Cancel');			
		} else if (this.value == 'opt2') { // Cancel from Service Provider
			status.attr('style','background : red;');
			status.attr('class','col-md-11 btn-blue lbl-status');
			status.text('S_Provider Cancel');
		} else if (this.value == 'opt3') { // Not confirmed
			status.attr('style','background : green;');
			status.attr('class','col-md-11 btn-blue lbl-status');
			status.text('Not Confirmed');
		} else if (this.value == 'opt4') {
			status.attr('style','');
			status.attr('class','');
			status.text('');
		}
		
	});
</script>

<style type="text/css">
	.lbl-status {
		padding-left: 7px;
		padding-right: 7px;
		padding-top: 4px;
		padding-bottom: 4px;
		border-radius: 2px;
	}
</style>