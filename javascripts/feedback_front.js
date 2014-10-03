$(document).ready(function(){

	$("#feedback_front_submit").click(function(){		
		var text=$.trim($("#feedback_front").val());
                var email = $.trim($("#feedback_front_email").val());
        //var mydata = 'field='+text;
		if(text=="" || email == ""){
			$("#feedback_front_display").text("Please fill all the fields");
		}
        
                
		else{

			$("#feedback_front_display").text("Thank you for your feedback !");
		
		$.ajax(
				{
					type:'POST',
					url:'feedback_front.php',
					cache:false,
					data:{
                                            field1:text,
                                            field2:email,
                                            check_front:"jwbdv75"
                                            },
					datatype:"text",	
					success: function(){

						
					}
						

				}

			)
		}


	});

	$("#feedback_front_close").click(function(){
		
		//$("#feedback-div").show();
		$("#feedback_front").val('');
                $("#feedback_front_email").val('');
		$("#feedback_front_display").text('');
	});

	$("#suggestion_front").click(function(f){
		f.stopPropagation();
		$("#feedback_front_div").show();
	});

	$(document).click(function(){
		$("#feedback_front").val('');
                $("#feedback_front_email").val('');
		$("#feedback_front_display").text('');

	});

});

