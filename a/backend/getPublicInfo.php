<?php
require "connect.php";
$nid = $_GET['nid'];
$SQL = mysqli_query($dbhandle, "SELECT p.origId, f.authid, f.filename FROM publicLinks p LEFT JOIN files f ON f.uniqueFilename = p.origId WHERE p.newId ='" .$nid."'");
$row = mysqli_fetch_array($SQL);
echo json_encode($row);
?>