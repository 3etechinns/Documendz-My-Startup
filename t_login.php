<?php 
// login page



session_start();

if(isset($_SESSION['email'])) { // if already login
	header("location: profile_page.php"); // send to home page
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
function checklogin() {
	var un = document.login.email;
	var pw = document.login.pwd;
		 if(un.value.length!=0) // email field not empty
			 {
			 if(pw.value.length!=0) // pwd field is not empty
				 {
					 return true;
				 }
			 else
				 {
				 alert("Password should not be empty");
				 pw.focus();
				 return false;
				 }
			 }
		 else
		 {
			 alert("email should not be empty");
			 un.focus();
			 return false;
		 }
}

$(function() { // jquery for remember me

    if (localStorage.chkbx && localStorage.chkbx != '') {
        $('#remember_me').attr('checked', 'checked');
        $('#email').val(localStorage.usrname);
        $('#pass').val(localStorage.pass);
    } else {
        $('#remember_me').removeAttr('checked');
        $('#email').val('');
        $('#pass').val('');
    }

    $('#remember_me').click(function() {

        if ($('#remember_me').is(':checked')) {
            // save email and password
            localStorage.usrname = $('#email').val();
            localStorage.pass = $('#pass').val();
            localStorage.chkbx = $('#remember_me').val();
        } else {
            localStorage.usrname = '';
            localStorage.pass = '';
            localStorage.chkbx = '';
        }
    });
});

</script>
</head>
<body>
<form name="login" action="t_logincheck.php" method="post">
Email<input type="text" id="email" name="email"/><br/>
Password<input type="password" id="pass" name="pwd"/><br/>
<label class="checkbox">
 <input type="checkbox" value="remember-me" id="remember_me"> Remember me
</label><br/>
<input type="submit" name="submit" value="Login" onclick="return checklogin()"/>&nbsp;
<input type="reset" name="reset" value="Clear"/><br/>
<a href="t_register.html">New User, Click Here</a><br/>
<a href="t_forgot.html">Forgot Password</a>
</form>
</body>
</html>