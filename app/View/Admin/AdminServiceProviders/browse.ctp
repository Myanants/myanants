<div class="x_panel">
	<div class="x_title">
		<h2>Service Provider Browse</h2>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<table class="table-st">
			<tbody>

				<tr>
					<td class="left">ID</td>
					<td class="right">
						<?php echo $data['ServiceProvider']['id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Name</td>
					<td class="right">
						<?php echo $data['ServiceProvider']['name']; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Email </td>
					<td class="right">
						<?php if (!empty($data['ServiceProvider']['email'])) { ?>
							<?php echo $data['ServiceProvider']['email'] ; ?>
						<?php } ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> NIRC </td>
					<td class="right">
						<?php echo $data['ServiceProvider']['nirc'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php echo $data['ServiceProvider']['phone'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Company Name</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['company_name'] ; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Business Summary</td>
					<td class="right"> 
						<?php echo nl2br($data['ServiceProvider']['business_summary']) ; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Business Type</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['business_type'] ; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Where here </td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['where_hear'] ; ?>
					</td>
				</tr>
			
				<tr>
					<td class="left">Experience </td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['experience'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Team Member </td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['teammember'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Legal </td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['legal'] ; ?>						
					</td>
				</tr>


				<tr>
					<td class="left">Status</td>
					<td class="right">
					<?php if ($data['ServiceProvider']['deactivate'] == 1) : ?>
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
				<?php echo $this->Html->link('Edit', array('controller' => 'adminserviceproviders', 'action' => 'edit', h($data['ServiceProvider']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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