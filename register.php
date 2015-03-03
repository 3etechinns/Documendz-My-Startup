
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Zofler !</title>
</head>
<body>


<form action="newuser.php" method="post" onclick="submit">
New User?
<label>Emailid</label>
<input type="text" name="Emailid" placeholder="Emailid" /></br>
<label>Username</label>
<input type="text" name="Username" placeholder="Username" /></br>
<label>Pass</label>
<input type="Password" name="Password" placeholder="Password" /></br>
<input type="submit" value="Sign-up" /></br></br>
</form>

ALready hold an Account?
<form action="login_check.php" method="post" onclick="submit" >
<label>Username</label>
<input type="text" name="Username" placeholder="Username" autofocus="autofocus" /></br> <!-- Autofocus focusses the cursor at the start automatically when page loads -->
<label>Password</label>
<input type="Password" name="Password" placeholder="Password" /></br>
<input type="submit" value="Login" /></br></br>
</form>

</body>


</html>
