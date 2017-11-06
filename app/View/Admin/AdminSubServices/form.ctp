<div class="x_panel">
	<div class="x_title">
		<h2>Form</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap">
		<div class="form-group">
			<?php
//debug($services);
			?>

			<table>
				<tbody>
					<?php foreach ($services as $key => $value): ?>
						<tr>
							<td style="padding-bottom: 10px;font-size: initial;color: blue;">
								<?php
									echo $value['Service']['name'].' ( '.$value['Service']['myan_name'] .' ) ';
								?>
								
							</td>
						</tr>
						<?php foreach ($value['SubService'] as $subKey => $subValue): ?>
							<tr>
								<td style="padding-left: 10px;padding-top: 10px;padding-bottom: 10px;    width: 40%;">
									<div class="col-md-12">
											<?php
												echo $subValue['name'].' ( '.$subValue['myan_name'].' )';
											?>
											<div class="buttons" style="float: right;">
												<?php echo $this->Html->link('Edit Question', array('controller' => 'adminsubservices', 'action' => 'edit_question', h($subValue['id'])), array('class' =>'btn btn-success btn-sm')); ?>
											</div>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>


					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
</div>
