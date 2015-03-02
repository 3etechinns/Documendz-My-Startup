<?php

if(isset($_POST['token']) && ($_POST['token'] == 'jh67jb')){

require_once 'functions.php';
session_start();
	
 	if(isset($_SESSION['email'])) { // if already login
	echo "1";
		
	}
        else{
            
            echo "0";
        }
        
}	
	
else{




}	

?>