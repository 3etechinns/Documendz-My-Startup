<?php
  header('Content-Type: text/javascript');

require "connect.php";
if(isset($_GET['e'])) {

$email = $_GET['e'];
$wkids = array();
$ckids = array();
$i     = 0;
 $SQL4="SELECT userid FROM signup WHERE emailid='".$email."'";
    $result4 = mysql_query($SQL4); 
  $userid = mysql_fetch_assoc($result4);
$SQL    = "SELECT * FROM workgroups WHERE auth_id = '".$userid['userid']."' OR uniqueId IN (SELECT wkUniqueId from collaborators where collabEmail = '".$email."')";
$result = mysql_query($SQL);
function getCollabs($wid)
{
    $collabsData = array();    
    $collabs = mysql_query("SELECT * from collaborators WHERE wkUniqueId = '" . $wid . "' ");
    while ($c = mysql_fetch_assoc($collabs)) {        
        $collabsData[] = $c;        
    }
    return $collabsData;
}
function getFiles($wgid)
{
    $filesData = array();
    $files     = mysql_query("SELECT * from files WHERE workgroupid = '" . $wgid . "' ");    
    while ($f = mysql_fetch_assoc($files)) {
        $filesData[] = $f;
    }    
    return $filesData;    
}
while ($row = mysql_fetch_assoc($result)) {
    $wkids[] = $row;    
    $wkids[$i]['collabs'] = getCollabs($row['uniqueId']);    
    $wkids[$i]['files'] = getFiles($row['uniqueId']);    
    $i++;
}
echo $_GET['callback'] . '(' . json_encode($wkids) . ')';
}
?>