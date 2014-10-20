<?php
$json_path = $_GET["json_path"];
$edited_data = $_POST["edited_data"];
$result = file_put_contents($json_path, $edited_data);

if($result === false){   // file_put_contents returns boolean
    echo "false";
}
else{
echo "true";
}
?>

