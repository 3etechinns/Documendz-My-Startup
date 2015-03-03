<?php

require_once 'unique_random_alphanumeric.php';



include 'angular/backend/connect.php';

for($i = 131; $i <=375; $i++){

    $r1 = getToken(20);
    $r2 = getToken(20);
    
    // $s1 = getToken(15);
    // $s2 = getToken(15);
    // $s3 = getToken(15);
    // $s4 = getToken(15);
/// 2 sample wkgroups ///

$n = mysqli_fetch_assoc(mysqli_query($dbhandle,"SELECT username FROM signup WHERE userid =".$i));

	mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                        VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $i.",'".$n['username']."',1),
                               ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $i.",'".$n['username']."',1)");
	


}

?>