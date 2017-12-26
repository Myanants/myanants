<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Freelance Cleaner List</h2>
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
										'empty' => 'Status',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							// echo $this->Form->end();
							?>
						</div>

						<div class="col-md-3">
							<?php if (!empty($this->params->query['township'])): ?>
								<?php $township_act = trim($this->params->query['township']); ?>
							<?php else: ?>
								<?php $township_act = ''; ?>
							<?php endif; ?>

							<?php echo $this->Form->input('township', array(
										'label' => false,
										'default'=> $township_act ,
										'options' => $townships,
										'onChange' => 'this.form.submit();',
										'empty' => 'Township',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							echo $this->Form->end();
							?>
						</div>

						<div class="search-box sbox">
							<?php echo $this->Form->create('Cleaner', array('type' => 'get', 'url' => array('controller' => 'admin_cleaners', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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

						<?php echo $this->Html->link('Register', array('controller' => 'admin_cleaners', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('Cleaner.cleaner_id', 'Cleaner ID'); ?></th>
								<th><?php echo $this->Paginator->sort('Cleaner.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Cleaner.phone', 'Phone Number'); ?></th>
								<th><?php echo $this->Paginator->sort('Cleaner.township', 'Township'); ?></th>
								<th><?php echo $this->Paginator->sort('Cleaner.status', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('Cleaner.modified', 'Updated Date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php foreach ($pag as $key => $value): ?>
								<tr class="<?php if($value['Cleaner']['deactivate'] == true) echo 'even'; ?>">
									<td>
										<?php if(!empty($value['Cleaner']['cleaner_id'])): ?>
											<?php echo h($value['Cleaner']['cleaner_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Cleaner']['name'])): ?>
											<?php if(strlen($value['Cleaner']['name']) > 12): ?>
												<?php echo mb_substr($value['Cleaner']['name'],0,12,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Cleaner']['name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Cleaner']['phone'])): ?>
											<?php if(strlen($value['Cleaner']['phone']) > 13): ?>
												<?php echo mb_substr($value['Cleaner']['phone'],0,13,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Cleaner']['phone']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Cleaner']['township'])): ?>
											<?php echo $townships[$value['Cleaner']['township']]; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($value['Cleaner']['deactivate'] == 1) : ?>
											<?php echo "Deactivated"; ?>
										<?php else: ?>
											<?php echo "Active"; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Cleaner']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['Cleaner']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('View', array('controller' => 'admin_cleaners', 'action' => 'browse',h($value['Cleaner']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($value['Cleaner']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'admin_cleaners', 'action' => 'approved', h($value['Cleaner']['id'])), array('onclick' => 'return confirm(" Do you want to deactivate?")', 'class' => 'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($value['Cleaner']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'admin_cleaners', 'action' => 'approved', h($value['Cleaner']['id'])), array('onclick' => 'return confirm(" Do you want to activate?")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>
										<!-- <div class="col-md-5 ">
										<?php //echo $this->Html->link('Service Request', array('controller' => 'admin_cleaners', 'action' => 'addRequest', h($value['Cleaner']['id'])), array('class' =>'btn btn-royal-blue btn-sm')); 
											echo $this->Form->input('service_id', array(
												'type' => 'select',
												'options'=> !empty($service) ? $service : array(),
												'label'=>false,
												'empty' => 'Service Request',
												'class' => 'form-control request',
												'id' => h($value['Cleaner']['id'])
											));


										?></div>
 -->
										<?php echo $this->Html->link('Delete', array('controller' => 'admin_cleaners', 'action' => 'delete', h($value['Cleaner']['id'])), array('confirm' => "Would you like to delete this freelance cleaner ?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
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