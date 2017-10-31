<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Service Provider List</h2>
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
										'options' =>array('1'=>'active','2'=>'deactivated'),
										'onChange' => 'this.form.submit();',
										'empty' => 'Please select the status',
										'class' => 'form-control col-md-7 col-xs-12',
									)
								);
							echo $this->Form->end();
							?>
						</div>

						<div class="search-box sbox">
							<?php echo $this->Form->create('ServiceProvider', array('type' => 'get', 'url' => array('controller' => 'adminserviceproviders', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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

						<?php echo $this->Html->link('Register', array('controller' => 'adminserviceproviders', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('ServiceProvider.service_provider_id', 'ServiceProvider ID'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.email', 'Email'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.phone_number', 'Phone Number'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.company_name', 'Comapny Name'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.status', 'Status'); ?></th>
								<th><?php echo $this->Paginator->sort('ServiceProvider.modified', 'Updated Date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php foreach ($pag as $key => $value): ?>
								<tr class="<?php if($value['ServiceProvider']['deactivate'] == true) echo 'even'; ?>">
									<td>
										<?php if(!empty($value['ServiceProvider']['service_provider_id'])): ?>
											<?php echo h($value['ServiceProvider']['service_provider_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceProvider']['name'])): ?>
											<?php if(strlen($value['ServiceProvider']['name']) > 12): ?>
												<?php echo mb_substr($value['ServiceProvider']['name'],0,12,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['ServiceProvider']['name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceProvider']['email'])): ?>
											<?php if(strlen($value['ServiceProvider']['email']) > 14): ?>
												<?php echo mb_substr($value['ServiceProvider']['email'],0,14,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['ServiceProvider']['email']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceProvider']['phone'])): ?>
											<?php if(strlen($value['ServiceProvider']['phone']) > 13): ?>
												<?php echo mb_substr($value['ServiceProvider']['phone'],0,13,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['ServiceProvider']['phone']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceProvider']['company_name'])): ?>
											<?php if(strlen($value['ServiceProvider']['company_name']) > 12): ?>
												<?php echo mb_substr($value['ServiceProvider']['company_name'],0,12,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['ServiceProvider']['company_name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if ($value['ServiceProvider']['deactivate'] == 1) : ?>
											<?php echo "Deactivated"; ?>
										<?php else: ?>
											<?php echo "Active"; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['ServiceProvider']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['ServiceProvider']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('Browse', array('controller' => 'adminserviceproviders', 'action' => 'browse',h($value['ServiceProvider']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php if ($value['ServiceProvider']['deactivate'] == false): ?>
											<?php echo $this->Html->link('Deactivate', array('controller' => 'adminserviceproviders', 'action' => 'approved', h($value['ServiceProvider']['id'])), array('onclick' => 'return confirm(" Do you want to deactivate?")', 'class' => 'btn btn-gray btn-sm','style' => 'width:75px;')); ?>
										<?php elseif ($value['ServiceProvider']['deactivate'] == true): ?>
											<?php echo $this->Html->link('Activate', array('controller' => 'adminserviceproviders', 'action' => 'approved', h($value['ServiceProvider']['id'])), array('onclick' => 'return confirm(" Do you want to activate?")', 'class' => 'btn btn-white btn-sm','style' => 'width:75px;')); ?>
										<?php endif; ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'adminserviceproviders', 'action' => 'delete', h($value['ServiceProvider']['id'])), array('confirm' => "Would you like to delete this service provider?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
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