<?php 
// for chnging password page where user will enter data

if(isset($_GET['em'])) // if encoded username is there in url  
{		
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>

      	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

		<script type="text/javascript" src="javascripts/jquery1.9.1.js"></script>
		<script type="text/javascript" src="javascripts/bootstrap.min.js"></script>


<script type="text/javascript">

function bodyload()
{
	
	linkexpiry(); // ajax for link expiry
}
	
function linkexpiry() {


	   $.ajax({
	        type:"POST",
	        
	        url:"t_checklink.php",
	        datatype: "text",
			success: function(allow_check){
				
				
					if(allow_check.trim().localeCompare("allow-change") == 0){

						//show content
						
						}
					else if(allow_check.trim().localeCompare("disallow-change") == 0){

						
						$(".bs-example").html("Link is invalid or has expired");

						}		
				},
			error: function(){
					$(".bs-example").html("Something went wrong. Please try again.");
					}
		    });


	  
}




$(document).on({
	submit:function(e){

		var pw = document.change.pw; // current password
		var np = document.change.np; // new password
		var cp = document.change.cp; // confirm password

		var mx=6; // minimum length
		var np_len = np.value.length;  
		if (np_len < mx)  // length is less than minimum
		{  
		$("#password-error").html("Password should have atleast "+mx+" characters" );  
		$("#password-error").css('display','block');
		np.focus();  
		return false;  
		}
		
		if(np.value!=cp.value) // new and confirm pwd not matched
		{
			$("#password-error").html("Password and confirm password do not match");  
		$("#password-error").css('display','block');	
			cp.focus();  
			return false;
		}
	
		if(np.value.match(/\s/g)) // does not have space
		{
		$("#password-error").html("Password should not contain spaces");
		$("#password-error").css('display','block');
		
		np.focus();  
		return false;
		}

		e.preventDefault(); //stops default submit action... (doesnt show page submit at top)
		var post_data = $(this).serializeArray();
		
	    $.ajax({
	        type:"POST",
	        
	        url:"t_change.php",
	        datatype: "text",
	        data : post_data,
			success: function(message){
					
					if ($.trim(message).localeCompare('passwordset') == 0) {
				
					$(".bs-example").html("<div class='form-group'>Password changed successfully</div>"+"<div class='form-group'>Please <a href='https://www.zofler.com/enterprise/home.html'>click here</a> to continue</div>");
					}
					
					else if($.trim(message).localeCompare('wrongpassword') == 0){
					$("#password-error").html('The password you have entered is incorrect');
					$("#password-error").css('display','block');
					
					}
					
					else{
						alert('Oops, something went wrong');
					}
				},
			error: function(){
					$(".bs-example").html("Something went wrong. Please try again");
					}
		    });

		}
		
	},'#change-password');


</script>
</head>
<body onload="bodyload()">
<div id="txtHint"></div>

<div class="bs-example" style="height: auto; width: 400px; border: 1px solid black; margin: auto; margin-top: 50px; padding: 0 20px 20px 20px;">
	
	<h3 align="center">Set new password</h3>
<form id="change-password" name="change" method="post" >
<div class="form-group" ><input class="form-control" type="password" name="pw" id="password" placeholder="Password(provided through email)" required/></div>

<div class="form-group" ><input class="form-control" type="password" name="np" id="newpwd" placeholder="New password" required/></div>

<div class="form-group" >
	<input class="form-control"  type="password" name="cp" id="confirmpwd"  placeholder="Confirm password" required/></div>
	</br>
  <button class="btn btn-primary" type="submit" value="Submit" name='share_file'>Submit</button>
  
  		

  
</form>


<div id="password-error" style="
    display: none;	
    margin-top: 28px;
    padding: 2px;
    text-align: center;
    font-size: 11px;
    color: black;
    border: 1px solid brown;
    background: antiquewhite;
"></div>
</body>

</div>
</html>
<?php 
}

?>