<?php
require "connect.php";
$fid = $_POST['fid'];

$r = mysqli_query($dbhandle, "SELECT filename from files WHERE uniqueFilename='".$fid."'");

$fn = mysqli_fetch_array($r);

echo $fn['filename'];

?>