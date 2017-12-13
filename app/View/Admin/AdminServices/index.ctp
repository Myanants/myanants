<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Service List</h2>
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
						<div class="search-box sbox">
							<?php echo $this->Form->create('Service', array('type' => 'get', 'url' => array('controller' => 'adminservices', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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

						<?php echo $this->Html->link('Register', array('controller' => 'adminservices', 'action' => 'add'), array('class' =>'btn btn-orange pull-right' ));
						?>
					</div>
				</div>

				<?php if (!empty($pag)) : ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('Service.service_id', 'Service ID'); ?></th>
								<th><?php echo $this->Paginator->sort('Service.name', 'Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Service.myan_name', 'Myanmar Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Service.modified', 'Updated Date'); ?></th>
								<th>Operations</th>
							</tr>
						</thead>
						
						<tbody>
							
							<?php foreach ($pag as $key => $value): ?>
								<tr>
									<td>
										<?php if(!empty($value['Service']['service_id'])): ?>
											<?php echo h($value['Service']['service_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Service']['name'])): ?>
											<?php if(strlen($value['Service']['name']) > 30): ?>
												<?php echo mb_substr($value['Service']['name'],0,30,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Service']['name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Service']['myan_name'])): ?>
											<?php if(strlen($value['Service']['myan_name']) > 36): ?>
												<?php echo mb_substr($value['Service']['myan_name'],0,36,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Service']['myan_name']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Service']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['Service']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('Add Question', array('controller' => 'adminquestions', 'action' => 'add',h($value['Service']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php echo $this->Html->link('Browse', array('controller' => 'adminservices', 'action' => 'browse',h($value['Service']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'adminservices', 'action' => 'delete', h($value['Service']['id'])), array('confirm' => "Would you like to delete this service?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
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