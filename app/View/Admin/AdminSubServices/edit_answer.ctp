
<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'); ?>

<div class="x_panel">
	<div class="x_title">
		<h2>Form Setting</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content demo-wrap">
		<div class="form-group">
			<div id="container" class= <?php echo $sub_service['SubService']['id']; ?>>
				<?php foreach ($sub_service['Question'] as $key => $value) { ?>
					<div class="dragme form-control col-md-12" id = '<?php echo $value['id']; ?>' >

						<?php

							$mmstr = $value['mm_answer'];
							$mmstr = rtrim($mmstr,"@@");
							$mm = explode('@@', $mmstr);

							$enstr = $value['en_answer'];
							$enstr = rtrim($enstr,"@@");
							$en = explode('@@', $enstr);
							
							$combined = array_combine($mm, $en);

							$option = array();
							$k = 1;
							foreach ($combined as $combinedkey => $combinedvalue) {
								$option[$k] = $combinedkey.' '.$combinedvalue ;
								$k++;
							}

						?>
						<?php echo $value['Ename'].'<br/>'; ?>
						<?php echo $value['Mname'].'<br/>'; ?>
						<?php

							if ($value['type'] == 'check') {
								echo $this->Form->input('checkbox', array(
									'type'=>'select',
									'multiple'=>'checkbox',
									'options'=> $option,
									'label' => false,
									'div' => false,
									// 'disabled' => 'disabled'
									)
								);
							} elseif ($value['type'] == 'radio') { ?>
								<?php foreach ($option as $key => $value) { ?>
									<div class="radio">
										<label>
											<input type='radio' name='firstquestion' class="firstquestion"><?php echo $value; ?>
										</label>
									</div>
								<?php } ?>

							<?php } elseif ($value['type'] == 'text') { ?>
								<?php foreach ($option as $key => $value) { ?>
									<div>
										<label>
											<input type='text'><?php echo $value; ?>
										</label>
									</div>
								<?php } ?>
							<?php }	?>
					</div>

				<?php } ?>
			</div>
		</div>

	</div>
</div>

<style type="text/css">
	.dragme {
		display: inline-block;
		margin-bottom: 2%;
		height: auto;
		background-color: cadetblue;
		width: 987px;
		right: auto;
		bottom: auto;
		left: 0px;
		top: 0px;
		color: #fff;
	}
	.checkbox, .radio {
		position: relative;
		display: block;
		margin-top: 10px;
		margin-bottom: 10px;
		padding-left: 3%;
	}
	.testOuterClass {
		position: relative;
		display: block;
		margin-top: 10px;
		margin-bottom: 10px;
		padding-left: 5%;
	}
	.testClass {
		position: relative;
		display: block;
		margin-top: 10px;
		margin-bottom: 10px;
		padding-left: 5%;
	}
	
</style>

<script type="text/javascript">
	$(document).ready(function() {
		var myArray = [];

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

			/*********************************** Save in DB ********************************************/
			

			var length = $("#container > div").length;	
			var div = $("#container > div");
			var id = $("#container").attr('class');

			for (var i = 0; i < length; i++) {
				myArray[i] = div[i].id;
			}		

			$.ajax({
				url: "../ajaxTest",
				type: "POST",
				data:{ data : myArray , id : id},
				dataType: "json",
				success : function(response){
					alert("Ajax Success");
				},
				error: function(){}
			});


			/**********************************************************************************************/

			}
		});

	});

</script>