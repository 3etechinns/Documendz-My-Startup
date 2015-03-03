
<?php
// for profile page

if(!isset($_SESSION))  // if the session not yet started
	session_start();

if(!isset($_SESSION['email'])) { //if not yet logged in
	header("Location: t_login.php");// send to login page
	exit;
}

$uname = $_SESSION['uname'];
$salt = 'change me cause im not secure'; // security for changing password after login
$path = '/t_changepass.php';
$timestamp = time() + (30 * 24 * 60 * 60); // one month valid
$hash = md5($salt . $timestamp); // order isn't important at all... just do the same when verifying
$url = "http://localhost/Hello{$path}?a=url&b=1&s={$hash}&t={$timestamp}&un=".md5($uname); // var a for just extra, var b for checking from where the pwd is changing, s & t for security and time, un for username

$username = "root";
$password = "";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("userdata",$dbhandle)
or die("Could not select examples");

//execute the SQL query and return records
$result = mysql_query("SELECT UID, Email, Subscribed FROM users WHERE UserName='$uname'");

//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
	$_SESSION['subs']=$row['Subscribed']; // subscribed or not
	$_SESSION['uid']=$row['UID']; // UID in session for uploading files
	$email=$row['Email'];
	if($row['Subscribed']==1) // if subscribed
	{
		echo "<label>Subscribe<input type='checkbox' name='subscribe' value='1' onclick='subscribe(this.value)' checked/></label>";
	}
	else  // if not subscribed
	{
		echo "<label>Subscribe<input type='checkbox' name='subscribe' value='0' onclick='subscribe(this.value)'/></label>";
	}
}
$uid=$_SESSION['uid'];
$rem=mysql_query("SELECT SizeLimit, Remaining FROM remaining WHERE UID='$uid'");
$rowr = mysql_fetch_assoc($rem);
$reml=trim($rowr['Remaining']); // remaining files can be uploaded
$size=trim($rowr['SizeLimit']); // size limit of file
?>

<script type="text/javascript">
 function subscribe(str) { // ajax for subscribe
	    if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      var r=xmlhttp.responseText;
	      alert(r);
	    }
	  }
	  xmlhttp.open("GET","subscribe.php?s="+str,true);
	  xmlhttp.send();  
} 
 
 function myFunction() { // confirmation of deleting an account
     if (confirm("Are you sure! You want to delete an account?") == true) {
         return true;
     } else {
         return false;
     }
 }

 function checkFileSize() {
	    var input, file, size, limit;

	    // (Can't use `typeof FileReader === "function"` because apparently
	    // it comes back as "object" on some browsers. So just see if it's there
	    // at all.)
	    if (!window.FileReader) {
	        alert("The file API isn't supported on this browser yet.");
	        return false;
	    }

	    input = document.getElementById('fileinput'); // file input
	    size = document.getElementById('size').value; // size limit
	    limit = document.getElementById('limit').value; // remaining files
	    if (!input) {
	        alert("Couldn't find the fileinput element.");
	        return false;
	    }
	    else if (!input.files) {
	        alert("This browser doesn't seem to support the `files` property of file inputs.");
	        input.focus();
	        return false;
	    }
	    else if (!input.files[0]) {
	        alert("Please select a file before clicking 'Upload'");
	        input.focus();
	        return false;
	    }
	    else {
	        file = input.files[0];
	        var filesize=file.size/1024;
	        if(filesize<=size) // size limit is less than or equal to current file size
	        {
	        	if(limit>0) // remaining is not zero
	        	{
		        	return true;
	        	}
	        	else
	        	{
	        		alert("Your limit for uploading file is reached. Buy a plan to upload more files");
	        		input.style.borderColor="red";
	        		input.focus();
			        return false;
	        	}	
	        }
	        else
	        {
		        alert("The filesize should be less than the size limit. Your Size Limit is "+size);
	        	input.style.borderColor="red";
		        input.focus();
		        return false;
	        }
	    }
}

 function stopUpLoad() // cancel uploading
 {
	 if(document.getElementById('fileinput').files[0]) // if uploading and clicked
	 {
 		document.location.href="t_userprofile.php";
	 } 
	 else // if clicked without uploading
	 {
		alert("Please start uploading a file first");
	 }
 }

</script>
<br/><br/>
<a href='t_logout.php'>Logout</a> 
<a href=<?php echo $url; ?>>Change Password</a>
<a href='delete.php' onclick="return myFunction()">Delete My Account</a><br/>
<?php
echo "<input type='hidden' id='size' value='$size'/>"; // hidden field for size limit
echo "<input type='hidden' id='limit' value='$reml'/>"; // hidden field for remaining
// how much file is remaining
if($reml==0)
 echo "<p>You can't Upload more files now</p>";
if($reml==1)
 echo "<p>You can Upload $reml more file</p>";
if($reml>1)
 echo "<p>You can Upload $reml more files</p>"
?>
 
<form method="post" action="t_userprofile.php" enctype="multipart/form-data">
    <p>Browse File to be uploaded:</p>
    <input type="file" name="Filename" id="fileinput"> 
    <br/>
    <input type="submit" name="upload" value="Upload" onclick="return checkFileSize()"/>
</form>
<a href="javascript:void(0)" onclick="stopUpLoad()">Cancel Upload</a>
<br/><br/>
<form method="post" action="t_userprofile.php" enctype="multipart/form-data">
Feedback: <input type="text" name="fb" id="fb" />
<input type="submit" name="fbsubmit" value="Send"/>
</form>

<?php 
// code for feedback
if(isset($_POST['fbsubmit'])) // if feedback submit is set
{
	$feedback=$_POST['fb'];
	$date = date('Y-m-d');
	date_default_timezone_set('Asia/Kolkata');
	$time = date('H:i:s');
	mysql_query("INSERT INTO feedback (UID, Email, Feedback, FeedbackDate, FeedbackTime)
	VALUES ('$uid', '$email', '$feedback', '$date', '$time')") ; // insert in feedback data table
}



// code to upload file

if(isset($_POST['upload'])) // if submit is set
{
 //This is the directory where images will be saved
$target = "Uploaded/"; 
$target = $target . basename($_FILES['Filename']['name']);

//This gets all the other information from the form
$Filename=basename($_FILES['Filename']['name']);
$Size=$_FILES["Filename"]["size"] / 1024;
$Location=$_FILES['Filename']['tmp_name'];

//Writes the Filename to the server
if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
	//Tells you if its all ok
	$uid=$_SESSION['uid'];
	
	$result = mysql_query("SELECT * FROM remaining WHERE UID='$uid'");
	if(mysql_num_rows($result)!=0)
	{
		$row = mysql_fetch_assoc($result);
		$reml=trim($row['Remaining']);
		
		if($reml!=0) // if remaining is not zero
		{
		if($row['SizeLimit']>=$Size) // if limit is more than the size
		{
			$rem=$row['Remaining']-1; // decrement remaining
			mysql_query("UPDATE remaining SET Remaining='$rem' WHERE UID='$uid'"); // update remaining
			mysql_query("INSERT INTO files (UID, FileName, FileSize, FileLocation)
			VALUES ('$uid', '$Filename', '$Size', '$Location')") ; // insert in raw data table
			$message = "The file ". basename( $_FILES['Filename']['name']). " has been uploaded";
			header("Refresh:0"); // refresh the page
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else 
		{
			$message = "The filesize should be less than the size limit. Your Size limit is ".$row['SizeLimit'];
			header("Refresh:0");
			echo "<script type='text/javascript'>alert('$message');</script>";
			
		}
		}
		else 
		{
			$message = "Your limit for uploading file is reached. Buy a plan to upload more files";
			header("Refresh:0");
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	else  // if not found in remaining table
	{
		echo "Register First to upload a file";
		header("t_register.html");
	}
} else {
	//Gives and error if its not
	$message = "Sorry, there was a problem in uploading your file.";
	header("Refresh:0");
    echo "<script type='text/javascript'>alert('$message');</script>";
}
}
?>