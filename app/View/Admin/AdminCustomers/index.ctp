<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Customer List</h2>
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
						<div class="col-md-3">
							<?php if (!empty($this->params->query['status'])): ?>
								<?php $deact_act = trim($this->params->query['status']); ?>
							<?php else: ?>
								<?php $deact_act = ''; ?>
							<?php endif; ?>

							<?php echo $this->Form->input('status', array(
										'label' => false,
										'default'=> $deact_act ,
										'options' =>array('1'=>'active','2'=>'deactivated'),
										'onChange' => 'this.form.submit();',
										'empty' => 'Please select status',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							// echo $this->Form->end();
							?>
						</div>

						<div class="col-md-3">
							<?php if (!empty($this->params->query['tsp'])): ?>
								<?php $tsp = trim($this->params->query['tsp']); ?>
							<?php else: ?>
								<?php $tsp = ''; ?>
							<?php endif; ?>

							<?php echo $this->Form->input('tsp', array(
										'label' => false,
										'default'=> $tsp ,
										'options' => $townships,
										'onChange' => 'this.form.submit();',
										'empty' => 'Please select township',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							echo $this->Form->end();
							?>
						</div>

						<div class="search-box sbox">
							<?php echo $this->Form->create('Customer', array('type' => 'get', 'url' => array('controller' => 'admin_customers', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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

						<?php echo $this->Html->link('Register', array('controller' => 'admin_customers', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('Customer.customer_id', 'Customer ID'); ?></th>
								<th><?php echo $this->Paginator->sort('Customer.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Customer.phone_number', 'Phone Number'); ?></th>
								<th><?php echo $this->Paginator->sort('Customer.township', 'Township'); ?></th>
								<th><?php echo $this->Paginator->sort('Customer.status', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('Customer.modified', 'Updated Date'); ?></th>
								<th class="col-md-5 ">Operations</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php foreach ($pag as $key => $value): ?>
								<tr class="<?php if($value['Customer']['deactivate'] == true) echo 'even'; ?>">
									<td>
										<?php if(!empty($value['Customer']['customer_id'])): ?>
											<?php echo h($value['Customer']['customer_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['name'])): ?>
											<?php if(strlen($value['Customer']['name']) > 12): ?>
												<?php echo mb_substr($value['Customer']['name'],0,12,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Customer']['name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['phone_number'])): ?>
											<?php if(strlen($value['Customer']['phone_number']) > 13): ?>
												<?php echo mb_substr($value['Customer']['phone_number'],0,13,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Customer']['phone_number']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['township'])): ?>
											<?php echo $townships[$value['Customer']['township']]; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($value['Customer']['deactivate'] == 1) : ?>
											<?php echo "Deactivated"; ?>
										<?php else: ?>
											<?php echo "Active"; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Customer']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['Customer']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('View', array('controller' => 'admin_customers', 'action' => 'browse',h($value['Customer']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($value['Customer']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'admin_customers', 'action' => 'approved', h($value['Customer']['id'])), array('onclick' => 'return confirm(" Do you want to deactivate?")', 'class' => 'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($value['Customer']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'admin_customers', 'action' => 'approved', h($value['Customer']['id'])), array('onclick' => 'return confirm(" Do you want to activate?")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>
										<div class="col-md-5 ">
										<?php //echo $this->Html->link('Service Request', array('controller' => 'admin_customers', 'action' => 'addRequest', h($value['Customer']['id'])), array('class' =>'btn btn-royal-blue btn-sm')); 
											echo $this->Form->input('service_id', array(
												'type' => 'select',
												'options'=> !empty($service) ? $service : array(),
												'label'=>false,
												'empty' => 'Service Request',
												'class' => 'form-control request',
												'id' => h($value['Customer']['id'])
											));


										?></div>

										<?php echo $this->Html->link('Delete', array('controller' => 'admin_customers', 'action' => 'delete', h($value['Customer']['id'])), array('confirm' => "Would you like to delete this customer ?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
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
	$('.request').on('change', function() {
		location.replace("http://myanants.com/staging/admin/customer/addRequest/"+this.id+"&"+this.value);
		console.log(this.id);
	})
</script>