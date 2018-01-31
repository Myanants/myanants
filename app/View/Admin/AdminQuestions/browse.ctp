<div class="x_panel">
	<div class="x_title">
		<h2>Question Detail</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<h4><label>Question Informations</label></h4>
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Question</td>
					<td class="right"><?php echo $data['Question']['Ename'] ; ?></td>
				</tr>

				<tr>
					<td class="left">Answer</td>
					<td class="right">

						<?php if ($data['Question']['type'] == 'text') { ?>
							<input type="text" name="text" disabled="true" />

						<?php } elseif ($data['Question']['type'] == 'check') { ?>
							<?php
								$check_option = explode('@@', $data['Question']['en_answer']) ;
								echo $this->Form->input('checkbox', array(
									'type'=>'select',
									'multiple'=>'checkbox',
									'options'=> $check_option,
									'label' => false,
									'div' => false,
									'disabled' => 'disabled'
									)
								);
							?>

						<?php } elseif ($data['Question']['type'] == 'radio') { ?>
							<?php
								$radio_option = explode('@@', $data['Question']['en_answer']) ;
							?>

							<?php foreach ($radio_option as $radiokey => $radiovalue) { ?>
								<div class="radio">
									<label>
										<input type='radio' name='firstquestion' class="firstquestion" disabled="disabled"><?php echo $radiovalue; ?>
									</label>
								</div>
							<?php } ?>

						<?php } ?>
					</td>
				</tr>

				<tr>
					<td class="left">Modified Date</td>
					<td class="right"><?php echo $data['Question']['modified'] ; ?></td>
				</tr>
			</tbody>
		</table>

		<h4><label>Service Informations</label></h4>
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Service ID</td>
					<td class="right">
						<?php echo $data['Service']['service_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Service Name</td>
					<td class="right">
						<?php echo $data['Service']['name']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Modified Date</td>
					<td class="right">
						<?php echo $data['Service']['modified']; ?>
					</td>
				</tr>

			</tbody>
		</table>

		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php //echo $this->Html->link('Edit', array('controller' => 'admin_services', 'action' => 'edit', h($data['Question']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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

</style>