<div class="col-md-6 hidden-sm hidden-xs alert alert-success" style="margin-left: 25%;">
	<?php echo $message; ?>
	<a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
</div>

<div class="col-md-6 hidden-lg hidden-md alert alert-success" style="margin-bottom: auto;">
	<?php echo $message; ?>
	<a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
</div>

<style type="text/css">
	.alert-success {
		color: #3c763d;
		background-color: #dff0d8;
		border-color: #d6e9c6;
	}
	.alert {
		padding: 15px;
		border: 1px solid transparent;
		border-radius: 4px;
	}

	/*---------- mobile -----------*/
	@media screen and (max-width: 768px) and (max-width: 992px) {
		.alert-success {
			color: #3c763d;
			background-color: #dff0d8;
			border-color: #d6e9c6;
		}
		.alert {
			padding: 15px;
			border: 1px solid transparent;
			border-radius: 4px;
		}
	}
</style>