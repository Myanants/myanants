<div class="x_panel">
	<div class="x_title">
		<h2>Freelance Cleaner Detail</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Cleaner ID</td>
					<td class="right">
						<?php echo $data['Cleaner']['cleaner_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Name</td>
					<td class="right"><?php echo $data['Cleaner']['name'] ; ?></td>
				</tr>

				<tr>
					<td class="left"> Date of Birth </td>
					<td class="right">
						<?php if (!empty($data['Cleaner']['date_of_birth'])) { ?>
							<?php echo $data['Cleaner']['date_of_birth'] ; ?>
						<?php } ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> Age </td>
					<td class="right">
						<?php if (!empty($data['Cleaner']['age'])) { ?>
							<?php echo $data['Cleaner']['age'] ; ?>
						<?php } ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php echo $data['Cleaner']['phone'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Address</td>
					<td class="right"> 
						<?php echo nl2br($data['Cleaner']['address']) ; ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> Township </td>
					<td class="right">
						<?php echo $townships[$data['Cleaner']['township']] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> NIRC </td>
					<td class="right">
						<?php echo $data['Cleaner']['nirc'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left"> Photo </td>
					<td class="right">
						<?php if (!empty($data['Cleaner']['photo'])) { ?>
							<div class = "crop">
								<?php echo $this->Html->image($data['Cleaner']['photo'], array('alt' => 'story image')); ?>
							</div>
						<?php } ?>
					</td>
				</tr>

				<tr>
					<td class="left" style="color: red;"> Available time </td>
					<td class="right">
						<table class='custom-tb'>
							<tr>
								<th>Monday</th>
								<th>Tuesday</th>
								<th>Wednesday</th>
								<th>Thursday</th>
								<th>Friday</th>
								<th>Saturday</th>
								<th>Sunday</th>
							</tr>
							<tr>
								<td>
									<?php
										if ($data['Cleaner']['monday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['monday_from']) && !empty($data['Cleaner']['monday_to'])) {
											echo $data['Cleaner']['monday_from']. "<br/> ~ <br/>" .$data['Cleaner']['monday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['tuesday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['tuesday_from']) && !empty($data['Cleaner']['tuesday_to'])) {
											echo $data['Cleaner']['tuesday_from']. "<br/> ~ <br/>" .$data['Cleaner']['tuesday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['wednesday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['wednesday_from']) && !empty($data['Cleaner']['wednesday_to'])) {
											echo $data['Cleaner']['wednesday_from']. "<br/> ~ <br/>" .$data['Cleaner']['wednesday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['thursday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['thursday_from']) && !empty($data['Cleaner']['thursday_to'])) {
											echo $data['Cleaner']['thursday_from']. "<br/> ~ <br/>" .$data['Cleaner']['thursday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['friday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['friday_from']) && !empty($data['Cleaner']['friday_to'])) {
											echo $data['Cleaner']['friday_from']. "<br/> ~ <br/>" .$data['Cleaner']['friday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['saturday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['saturday_from']) && !empty($data['Cleaner']['saturday_to'])) {
											echo $data['Cleaner']['saturday_from']. "<br/> ~ <br/>" .$data['Cleaner']['saturday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
								<td>
									<?php
										if ($data['Cleaner']['sunday_check'] == 1) {
											echo "Whole day";
										} elseif (!empty($data['Cleaner']['sunday_from']) && !empty($data['Cleaner']['sunday_to'])) {
											echo $data['Cleaner']['sunday_from']. "<br/> ~ <br/>" .$data['Cleaner']['sunday_to'] ;
										} else {
											echo "Unavailable";
										}
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>


				<tr>
					<td class="left">Status</td>
					<td class="right">
					<?php if ($data['Cleaner']['deactivate'] == 1) : ?>
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
				<?php echo $this->Html->link('Edit', array('controller' => 'admin_cleaners', 'action' => 'edit', h($data['Cleaner']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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

	table .custom-tb {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	.custom-tb td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	.custom-tb th {
		background-color: #dddddd;
	}

</style>