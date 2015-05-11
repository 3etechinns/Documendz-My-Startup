
<?php
session_start();
include 'connect.php';

if(isset($_GET['v'])) {
 

 if($_GET['v'] == 1) {
		mysqli_query($dbhandle, "UPDATE `notification_flag` SET `read`= 1  WHERE viewer_id =".$_SESSION['userid']);
	}

	$result = mysqli_query($dbhandle,"SELECT  n.wkgroup_id,n.name, w.wname,n.actor_id,UNIX_TIMESTAMP(n.time)*1000 as time, n.type_id, nf.read, s.username FROM notification_flag nf LEFT JOIN notification n ON n.id = nf.notification_id LEFT JOIN signup s ON s.userid IN (select actor_id from notification where id = nf.notification_id) LEFT JOIN workgroups w ON n.wkgroup_id = w.uniqueId WHERE nf.viewer_id =".$_SESSION['userid']. " ORDER BY n.time DESC");	

	  
	$data = array();
	 
	while ($row = mysqli_fetch_assoc($result)) {
	  $data[] = $row;
	}


	print json_encode($data);

	
}

?>

