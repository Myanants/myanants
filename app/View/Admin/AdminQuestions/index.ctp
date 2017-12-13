<div class="row">
	<div class="col-md-20col-sm-8 col-xs-20" >
		<div class="x_panel">
			<div class="x_title">
				<h2>Question List</h2>
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
					<!-- <div class="col-md-10">
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
						</div> -->

						<div class="search-box sbox">
							<?php echo $this->Form->create('Question', array('type' => 'get', 'url' => array('controller' => 'adminquestions', 'action' => 'index'), 'class' => 'search-box-form', 'InputDefaults' => array('label' => false, 'div' => false))); ?>
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
								<th class="col-md-1"><?php echo $this->Paginator->sort('Question.customer_id', 'Service ID'); ?></th>
								<th><?php echo $this->Paginator->sort('Question.name', 'Question name'); ?></th>
								<th class="col-md-2"><?php echo $this->Paginator->sort('Question.modified', 'Updated Date'); ?></th>
								<th class="col-md-3">Operations</th>
							</tr>
						</thead>
						
						<tbody>
<?php //debug($pag); ?>		
							<?php foreach ($pag as $key => $value): ?>
								<tr>
									<td>
										<?php if(!empty($value['Service']['service_id'])): ?>
											<?php echo h($value['Service']['service_id']); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Question']['Ename'])): ?>
											<?php if(strlen($value['Question']['Ename']) > 12): ?>
												<?php echo mb_substr($value['Question']['Ename'],0,12,'UTF-8')."..."; ?>
											<?php else: ?>
												<?php echo h($value['Question']['Ename']); ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>

									<td>
										<?php if(!empty($value['Question']['modified'])): ?>
											<?php echo date("d M Y", strtotime($value['Question']['modified'])); ?>
										<?php endif; ?>
									</td>

									<td>
										<?php echo $this->Html->link('Browse', array('controller' => 'adminquestions', 'action' => 'browse',h($value['Question']['id'])), array( 'class' => 'btn btn-blue btn-sm')); ?>
										
										<?php echo $this->Html->link('Add Answer', array('controller' => 'adminquestions', 'action' => 'addAnswer', h($value['Question']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>

										<?php echo $this->Html->link('Delete', array('controller' => 'adminquestions', 'action' => 'delete', h($value['Question']['id'])), array('confirm' => "Would you like to delete this company?", 'class' =>'btn btn-royal-blue btn-sm')); ?>
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