<div class="x_panel">
	<div class="x_title">
		<h2>Service Provider Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Service Provider ID</td>
					<td class="right">
						<?php echo $data['ServiceProvider']['service_provider_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Company Name</td>
					<td class="right"><?php echo $data['ServiceProvider']['company_name'] ; ?></td>
				</tr>

				<tr>
					<td class="left">Contact Person</td>
					<td class="right"><?php echo $data['ServiceProvider']['name'] ; ?></td>
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
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php echo $data['ServiceProvider']['phone'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">NIRC</td>
					<td class="right"> 
						<?php if (!empty($data['ServiceProvider']['nirc'])) { ?>
							<?php echo $data['ServiceProvider']['nirc'] ; ?>
						<?php } ?>					
					</td>
				</tr>

				<tr>
					<td class="left"> Number of team member </td>
					<td class="right">
						<?php echo $data['ServiceProvider']['teammember'] ; ?>
					</td>
				</tr>


				<tr>
					<td class="left">Business Summary</td>
					<td class="right"> 
						<?php if (!empty($data['ServiceProvider']['business_summary'])) { ?>
							<?php echo $data['ServiceProvider']['business_summary'] ; ?>
						<?php } ?>					
					</td>
				</tr>

				<tr>
					<td class="left">legal</td>
					<td class="right"> 
						<?php if ($data['ServiceProvider']['legal'] == 0) : ?>
							<?php echo "No"; ?>
						<?php else : ?>
							<?php echo "Yes"; ?>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Category</td>
					<td class="right"> 
						<?php if (!empty($data['ServiceProvider']['business_type'])) { ?>
							<?php echo $data['ServiceProvider']['business_type'] ; ?>
						<?php } ?>					
					</td>
				</tr>

				<tr>
					<td class="left">Prefer Location</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['prefer_location'] ; ?>
					</td>
				</tr>


				<tr>
					<td class="left">Team photo</td>
					<td class="right"> 
						<?php if (!empty($data['ServiceProvider']['image'])) { ?>
							<div class = "crop">
								<?php echo $this->Html->image($data['ServiceProvider']['image'], array('alt' => 'story image')); ?>
							</div>
						<?php } ?>
					</td>
				</tr>

				<tr>
					<td class="left">Pricing</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['pricing'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Experience</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['experience'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Township</td>
					<td class="right"> 
						<?php echo $data['ServiceProvider']['townships'] ; ?>
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
				<?php echo $this->Html->link('Edit', array('controller' => 'admin_service_providers', 'action' => 'edit', h($data['ServiceProvider']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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

	.crop {
		border: 2px solid gray;
		width: 300px;
		height: 209px;
		overflow: hidden;
	}

	.crop img {
		width: 397px;
		height: 281px;
		margin: -75px 0 0 -100px;
	}

</style>