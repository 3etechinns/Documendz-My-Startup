<?php

$notifs = $_POST['notifs'];

require_once('Pusher.php');

$app_key = 'ff3fbe3a49687ae0a46d';
$app_secret = 'd127808defed20cfb77c';
$app_id = '88799';

$pusher = new Pusher($app_key, $app_secret, $app_id);
$data = array('message' => $notifs);
$pusher->trigger('my_notifications', 'notification', $data);

?>