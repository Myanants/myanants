<div class="x_panel">
	<div class="x_title">
		<h2>Service Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Service ID</td>
					<td class="right">
						<?php echo $data['Service']['service_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Name</td>
					<td class="right"><?php echo $data['Service']['name'] ; ?></td>
				</tr>

				<tr>
					<td class="left">Myanmar Name</td>
					<td class="right"><?php echo $data['Service']['myan_name'] ; ?></td>
				</tr>

				<tr>
					<td class="left">Sub Service</td>
					
					<td class="right">
						<?php foreach ($data['SubService'] as $key => $value) { ?>
							<?php echo $key.'.'.$value['name'].' ( '.$value['myan_name'].' ) <br/>' ; ?>
							<?php if (!empty($value['text'])) { ?>
								<div class="col-md-10 text-style">								
										<?php echo $value['text'].' ( '.$value['myan_text'].')' ; ?>
								</div><br/>
							<?php } ?>
						<br/>
						<?php } ?>
					</td>
				</tr>

				<tr>
					<td class="left">Status</td>
					<td class="right">
					<?php if ($data['Service']['deactivate'] == 1) : ?>
						<?php echo "Deactivated"; ?>
					<?php else :?>
						<?php echo "Active"; ?>
					<?php endif ; ?>
					</td>
				</tr>

			</tbody>
		</table>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'admincompanys', 'action' => 'edit', h($data['Service']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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