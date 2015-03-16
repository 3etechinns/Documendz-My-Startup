<?php
if(isset($_GET['fid'])) {

$shareId = $_GET['fid'];
//$dbhost = "localhost";
$dbname = "annotationStorage";
$m = new MongoClient();
$db = $m ->$dbname;
$data = "";
$collection = $db->annotationData;


$cursor = $collection->find();

foreach ($cursor as $document2) {

if($document2['shareId'] == $shareId) {
$data = $document2;
	}
}
echo $_GET['callback'] . '(' . json_encode($data) . ')';
}

?>