$(document).ready(function(){




	$("#feedback_submit").click(function(){

		
		var text=$.trim($("#feedback").val());


        //var mydata = 'field='+text;
		if(text==""){
			$("#feedback_display").text("Please enter your Suggestion");
		}

		else{

		
					
						$("#feedback_display").text("Thank you for your feedback !");
						setTimeout(function(){
							
								$('#suggestion').modal('hide');
								
							   
							   },1500); 
		$.ajax(
				{
					type:'POST',
					url:'feedback.php',
					cache:false,
					data:{
						field:text
					},
					datatype:"text",	
					
					
					success: function(){

						
					}
						

				}

			)
		}


	});

	$("#feedback_close").click(function(){
		
		//$("#feedback-div").show();
		$("#feedback").val('');
		$("#feedback_display").text('');
	});

	$("#suggestion").click(function(f){
		f.stopPropagation();
		$("#feedback-div").show();
	});

	$(document).click(function(){
		$("#feedback").val('');
		$("#feedback_display").text('');
		

	});

});

