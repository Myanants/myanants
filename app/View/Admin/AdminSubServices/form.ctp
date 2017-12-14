<div class="x_panel">
	<div class="x_title">
		<h2>Form</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap">
		<div class="form-group">

			<table>
				<tbody>
					<?php foreach ($temp as $key => $value): ?>
						<tr>
							<td style="padding-bottom: 10px;">
								<h2>
									<?php
									$head = explode('@@', $service_name[$key]); ?>

									<label> <?php echo $head[0].' : '.$head[1].' [ '.$head[2].' ] '; ?> </label>
								</h2>
								
							</td>
						</tr>
						<?php foreach ($value as $vkey => $vvalue) : ?>
							<tr>
								<table class="table table-bordered">
									<tr>
										<th colspan=2>
											<?php echo $vvalue['SubService']['name'].' [ '.$vvalue['SubService']['myan_name'] .' ] '; ?>

											<div class="buttons" style="float: right;">
												<?php echo $this->Html->link('Sort Question', array('controller' => 'admin_sub_services', 'action' => 'edit_answer', h($vvalue['SubService']['id'])), array('class' =>'btn btn-success btn-sm')); ?>
											</div>
										</th>
									</tr>
									<?php foreach ($vvalue['Question'] as $subKey => $subValue): ?>
										<tr>
											<td>
												<?php
													echo $subValue['Ename'].' ( '.$subValue['Mname'].' )';
												?>
											</td>
											<td>
												<div class="buttons" style="float: right;">
													<?php echo $this->Html->link('Edit Answer', array('controller' => 'admin_sub_services', 'action' => 'edit_answer', h($subValue['id'])), array('class' =>'btn btn-success btn-sm')); ?>
												</div>
												<div class="buttons" style="float: right;">
													<?php echo $this->Html->link('Add Answer', array('controller' => 'admin_sub_services', 'action' => 'add_answer', h($subValue['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</table>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
</div>