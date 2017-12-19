<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="language" content="en-us" />

<style type="text/css">
	thead.fixedHeader tr {
		position: relative;
		/* expression is for WinIE 5.x only. Remove to validate and for pure CSS solution      */
		top: expression(document.getElementById("tableContainer").scrollTop);
	}
	head:first-child+body thead[class].fixedHeader tr {
		display: block;
	}
	head:first-child+body tbody[class].scrollContent {
		display: block;
		height: 190px;
		overflow: auto;
		width: 100%
	}
	head:second-child+body tbody[class].scrollContent {
		display: block;
		height: 262px;
		overflow: auto;
		width: 100%
	}

	head:first-child+body tbody[class].scrollIndustryContent {
		display: block;
		height: 293px;
		overflow: auto;
		width: 100%
	}
	head:second-child+body tbody[class].scrollIndustryContent {
		display: block;
		height: 293px;
		overflow: auto;
		width: 100%
	}
</style>

<h3> Summary of the numbers </h3>
<?php
$headdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit)));
$headmonthName = $headdateObj->format('M');
echo
$this->Html->link("<i class= 'fa fa-chevron-circle-left'></i>", array(
	'controller' => 'admin_reports',
	'action' => 'index',
	date('Y-m', strtotime('-1 month', strtotime($limit))) ),
array('escape' => false,'style' => 'font-size: 20px;')
).' '.
$this->Html->link(date('Y', strtotime($limit)).'-'.
	$headmonthName,
	array('controller' => 'admin_reports', 'action' => 'index'
		),array('style' => 'font-size: 20px;')
	).' '.
$this->Html->link("<i class='fa fa-chevron-circle-right'></i>", array(
	'controller' =>'admin_reports',
	'action' => 'index',
	date('Y-m', strtotime('+1 month',strtotime($limit)))),
array('escape' =>false,'style' => 'font-size: 20px;')
);
?>

<div style = "overflow-x:auto;"><br>
	<table border = "0">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable gradienttable">
					<thead class="fixedHeader" id="fixedHeader">
						<tr>
							<th><p style = "width: 173px; height: 33px;"></p></th>
							<?php for ($i = 1; $i <= 31; $i++) : ?>
								<th><p class="header-size"> <?php echo $i; ?> </p></th>
							<?php endfor; ?>
							<!-- <th><p></p></th> -->
						</tr>
					</thead>
					<tbody class="scrollContent">
					
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Customers</p></th>
							<?php for ($cus = 1; $cus <= 31; $cus++) : ?>
								<?php $num_length = strlen((string)$cus); ?>
								<?php if ($num_length == 1) : ?>
									<?php $cus = '0'.$cus ; ?>
								<?php else: ?>
									<?php $cus = (string)$cus; ?>
								<?php endif; ?>
								<td>
									<p>
										<?php echo !empty($customer_info[$cus]) ? $customer_info[$cus] : '' ?>
									</p>
								</td>
							<?php endfor; ?>
						</tr>
						
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Service Providers</p></th>
							<?php for ($sp = 1; $sp <= 31; $sp++) : ?>
								<?php $num_length = strlen((string)$sp); ?>
								<?php if ($num_length == 1) : ?>
									<?php $sp = '0'.$sp ; ?>
								<?php else: ?>
									<?php $sp = (string)$sp; ?>
								<?php endif; ?>
								<td>
									<p>
										<?php echo !empty($service_provider_info[$sp]) ? $service_provider_info[$sp] : '' ?>
									</p>
								</td>
							<?php endfor; ?>
						</tr>

						<tr>
							<th><p style='padding: 10px;width: 173px;'>Requested Services</p></th>
							<?php for ($req = 1; $req <= 31; $req++) : ?>
								<?php $num_length = strlen((string)$req); ?>
								<?php if ($num_length == 1) : ?>
									<?php $req = '0'.$req ; ?>
								<?php else: ?>
									<?php $req = (string)$req; ?>
								<?php endif; ?>
								<td>
									<p>
										<?php echo !empty($request_info[$req]) ? $request_info[$req] : '' ?>
									</p>
								</td>
							<?php endfor; ?>
						</tr>
					</tbody>
				</table>
			</td>
			<td style = "width: 10px; padding-left: 24px;"></td>

			<td>
				<table class = "gradienttable" style = "float:right">
					<thead  class="fixedHeader" id="fixedHeader">
						<tr>
							<th><p style = "width: 166px;height: 33px;"></p></th>
							<?php
							$mon = explode('-', $limit) ;
							$dateObj = DateTime::createFromFormat('!m', $mon[1]);
							$monthName = $dateObj->format('M');
							$prevdateObj = DateTime::createFromFormat('!m', date('m', strtotime($limit." -1 month")));
							$prevmonthName = $prevdateObj->format('M');
							?>
							<th><p> <?php echo $prevmonthName.'.' ; ?> </p></th>
							<th><p> <?php echo $monthName.'.' ; ?> </p></th>
						</tr>
					</thead>
					<tbody class="scrollContent">
						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Customers</p></th>
							<td><p><?php echo $previous_customer['total']; ?></p></td>
							<td><p><?php echo $customer_info['total']; ?></p></td>
						</tr>

						<tr>
							<th><p style='padding: 10px;width: 173px;'>Registered Service Providers</p></th>
							<td><p><?php echo $previous_service_provider['total']; ?></p></td>
							<td><p><?php echo $service_provider_info['total']; ?></p></td>
						</tr>

						<tr>
							<th><p style='padding: 10px;width: 173px;'>Requested Services</p></th>
							<td><p><?php echo $previous_request['total']; ?></p></td>
							<td><p><?php echo $request_info['total']; ?></p></td>
						</tr>

					</tbody>
				</table>
			</td>			
		</tr>


	</table>
</div>