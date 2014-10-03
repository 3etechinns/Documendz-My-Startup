
<?php
// logout after closing session and destroy all

session_start();
session_destroy();
echo"<script>window.location.href ='https://www.documendz.com'</script>";

?>
