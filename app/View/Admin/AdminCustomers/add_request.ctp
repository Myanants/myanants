<div class="x_panel">
	<div class="x_title">
		<h2>Customer's Service Request</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">

		<?php echo $service['Service']['name'].' '.$service['Service']['myan_name']; ?>
		<br />
		<?php
			echo $this->Form->create('ServiceRequest', array(
				'type' => 'file',
				'class' => 'form-horizontal form-label-left',
				'inputDefaults' => array(
					'label' => false,
					'div' => false
				),
				'id' => 'demo-form2',
				'autocomplete' => 'off'
			));
		?>


			<div class="form-group">
				<div class="panel panel-default" id="check">
					<div class="panel-body">


						<h3>Please select one option</h3>
						<?php foreach ($service['SubService'] as $key => $value) : ?>
							<div class="radio">
								<label>
									<input type='radio' name='sub_service' class="sub_service" value="<?php echo $value['id']; ?>">
									<?php echo $value['name']; ?>
								</label>
							</div>
						<?php endforeach; ?>

						<div class="subdiv">
							
						</div>
						

					</div>
				</div>
			</div>

			

			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<?php echo $this->Html->link('Cancel', array('type' => 'reset','controller' => 'admincustomers', 'action' => 'index'), array('onclick' => 'return confirm(" Do you want to cancel?")', 'class' => 'btn btn-gray btn-sm')); ?>
					<?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-orange btn-sm')); ?>
				</div>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<style type="text/css">
	.error, .required{
		color: red;
	}
	.form-group {
		padding-bottom: 10px;
		border-bottom: 1px solid #D9DEE4;
	}
	.form-group.no-line {
		border-bottom: none;
	}
	.logo-space{
		margin-left: -65px;
		border:none;
		color:red;
	}
	.logo-space-before{
		margin-left: -14px;
		border:none;
		color:red;
	}
	.space{
		padding-left: 65px;
	}
	.Message {
		margin-left: 248px;
		color: red;
	}
</style>

<script type="text/javascript">

	$(document).ready(function() {

		$(".subdiv").hide();
		$(".sub_service").change(function () {
			var checkval = $('.sub_service:checked').val();

			$.ajax({
				url: "/admincustomers/ajaxTest",
				type: "POST",
				data:{ checkval : checkval},
				dataType: "html",
				success : function(response){

					var obj = JSON.parse(response);

					// console.log(obj.length);

					for (var i = 0; i < obj.length; i++) {
						if (obj[i]['type'] == 'check') {
							var string = obj[i]['en_answer'] ;
							var array = string.split('@@');
console.log(array);



							// var assigndiv = '<div><label>'+obj[i]['Ename']+'</label><br/><input type= "text" id=" '+ obj[i] + ' " /></div>' ;
							// $('.subdiv').append(assigndiv);
console.log("check");
						}

						if (obj[i]['type'] == 'text') {

							var assigndiv = '<div><label>'+obj[i]['Ename']+'</label><br/><input type= "text" id=" '+ obj[i] + ' " /></div>' ;
							$('.subdiv').append(assigndiv);
							// console.log("text");
						}


					}

					// $(document).find('.contact-info').show();
					// var address = obj.SubHeadhunter.location + '<br/>' + obj.SubHeadhunter.region;
					// $("#address").append(address);

					// var representative_postion = obj.SubHeadhunter.representative_postion;
					// $("#representative-postion").append(representative_postion);
					// var number_of_employee = obj.SubHeadhunter.number_of_employee;
					// $("#number-of-employee").append(number_of_employee);

					// $("#sub_headhunter_id").attr("value",obj.SubHeadhunter.id);




					console.log("Ajax Success");
				},
				error: function(){}
			});

			$('.subdiv').show();

		});


	});
	
</script>