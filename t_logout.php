
<?php
// logout after closing session and destroy all

session_start();
session_destroy();
echo"<script>window.location.href ='http://zofler.com/enterprise'</script>";

?>
