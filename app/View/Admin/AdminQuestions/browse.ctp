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
					<td class="left">Name</td>
					<td class="right"><?php echo $data['Question']['Ename'] ; ?></td>
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