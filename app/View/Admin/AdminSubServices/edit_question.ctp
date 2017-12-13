<div class="x_panel">
	<div class="x_title">
		<h2>Form Setting</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap">
		<div class="form-group">
			<div id="container">

				<div style="height: 100px;">

					<?php foreach ($subService['Question'] as $key => $value) { ?>
						
						<div class="dragme form-control col-md-12">
							<?php echo $value['Ename'].'<br/>'; ?>
							<?php echo $value['Mname'].'<br/>'; ?>
						</div>

					<?php } ?>


				</div>
			</div>
		</div>

	</div>
</div>

<style type="text/css">
	.dragme {
		display: inline-block;
		margin-bottom: 2%;
		height: 50px;
		background-color: cadetblue;
		width: 987px;
		right: auto;
		bottom: auto;
		left: 0px;
		top: 0px;
		color: #fff;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$(".dragme")
			.draggable({
				revert: true,
				revertDuration: 0,
				scroll: false
			})
		.droppable({
			over: function(event, ui) {
			// Get drag & drop elements
			var a = $(this);
			var b = $(ui.draggable);

			// Swap those elements
			var tmp = $('<span>').hide();
			a.before(tmp);
			b.before(a);
			tmp.replaceWith(b);

			// TODO: Refresh Position?
			}
		});
	});

</script>