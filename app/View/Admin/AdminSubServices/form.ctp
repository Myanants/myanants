<div class="x_panel">
	<div class="x_title">
		<h2>Form</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap">
		<div class="form-group">

			<table>
				<tbody>
					
					<?php foreach ($sub_services as $key => $value): ?>
						<tr>
							<td style="padding-bottom: 10px;">
								
								<h2>
									<?php
										$name = explode('@@', $service_name[$value['SubService']['service_id']]);
										echo $name[0].' : '.$name[1] .' ( '.$name[2] .' ) ';
									?>
								</h2>
								
							</td>
						</tr>
						<tr>
							<table class="table table-bordered">
								<tr>
									<th colspan=2>
										<?php echo $value['SubService']['name'].' ( '.$value['SubService']['myan_name'] . ' )'; ?>

										<div class="buttons" style="float: right;">
											<?php echo $this->Html->link('Sort Question', array('controller' => 'adminsubservices', 'action' => 'edit_answer', h($value['SubService']['id'])), array('class' =>'btn btn-success btn-sm')); ?>
										</div>
									</th>
								</tr>

								<?php foreach ($value['Question'] as $subKey => $subValue): ?>
									<tr>
										<td>
											<?php
												echo $subValue['Ename'].' ( '.$subValue['Mname'].' )';
											?>
										</td>
										<td>
											<div class="buttons" style="float: right;">
												<?php echo $this->Html->link('Edit Answer', array('controller' => 'adminsubservices', 'action' => 'edit_answer', h($subValue['id'])), array('class' =>'btn btn-success btn-sm')); ?>
											</div>
											<div class="buttons" style="float: right;">
												<?php echo $this->Html->link('Add Answer', array('controller' => 'adminsubservices', 'action' => 'add_answer', h($subValue['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
</div>