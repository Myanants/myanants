<div class="x_panel">
	<div class="x_title">
		<h2>Company Browse</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<table class="table-st">
			<tbody>
				<tr>
					<td class="left">Customer ID</td>
					<td class="right">
						<?php echo $data['Customer']['customer_id']; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Name</td>
					<td class="right"><?php echo $data['Customer']['name'] ; ?></td>
				</tr>

				<tr>
					<td class="left"> Email </td>
					<td class="right">
						<?php if (!empty($data['Customer']['email'])) { ?>
							<?php echo $data['Customer']['email'] ; ?>
						<?php } ?>						
					</td>
				</tr>

				<tr>
					<td class="left"> Phone Number </td>
					<td class="right">
						<?php echo $data['Customer']['phone_number'] ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Address</td>
					<td class="right"> 
						<?php echo nl2br($data['Customer']['address']) ; ?>						
					</td>
				</tr>

				<tr>
					<td class="left">Status</td>
					<td class="right">
					<?php if ($data['Customer']['deactivate'] == 1) : ?>
						<?php echo "Deactivated"; ?>
					<?php else :?>
						<?php echo "Active"; ?>
					<?php endif ; ?>
					</td>
				</tr>

				<tr>
					<td class="left">Service Requests</td>
					<td class="right">
						<?php foreach ($data['ServiceRequest'] as $key => $value) : ?>
							<label>
								<?php echo $main_service[$value['service_id']].' > '.
										$sub_service[$value['sub_service_id']] ; ?>
							</label>
							<br/>

							<?php $answer = explode('###', $value['answer']); ?>
							<?php foreach ($answer as $anskey => $ansvalue) : ?>
								<?php
									$answer_string = '' ;
									$temp_answer = explode('/', $ansvalue);
									$question_id = $temp_answer[0] ;
									echo $question[$question_id].'<br/>';
									if (strpos($temp_answer[1], '$$') == true) { //TRUE
										$anss = explode('$$', $temp_answer[1]) ;
										foreach ($anss as $k => $val) {
											$answer_string .= $val.',';
										}
										$answer_string = rtrim($answer_string,",");
										echo $answer_string;
									} else { //FALSE
										echo $temp_answer[1];
									}
								?>
								<br/>
							<?php endforeach; ?>
							<br/>
						<?php endforeach; ?>
					</td>
				</tr>

			</tbody>
		</table>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
				<?php echo $this->Html->link('Back', 'javascript:history.back()', array('class' => 'btn btn-default btn-sm')); ?>
				<?php echo $this->Html->link('Edit', array('controller' => 'admin_customers', 'action' => 'edit', h($data['Customer']['id'])), array('class' =>'btn btn-orange btn-sm')); ?>
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