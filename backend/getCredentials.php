<?php    
	session_start();
	
?> 
 <?php
 $name = $_SESSION['name'];
$email = $_SESSION['email'];
$coyId = $_SESSION['coyId'];
$response = array("error" => FALSE);
	if ((isset($name)&&($name != ""))&&(isset($email)&&($email != ""))){
		$response["error"] = FALSE;
		$response["name"] = $name ;
		$response["email"] = $email;
		$response["coyId"] = $coyId;
		$response["status"] = 200;
		
	}else{
		$response["error"] = TRUE;
		$response["status"] = 211;
		}
		echo json_encode($response);
		
		?>