<?php
	require_once('models/User.php');
	require_once('security.php');
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Headers: username, password');
	$header = getallheaders();

	if (isset($header['username']) & isset($header['password']))
	{
		try 
		{
			//create user
			$u = new User($header['username'], $header['password']);
			//display user
			echo '{ "status" : 0,
					"id" : "'.$u->get_id_user().'",
					"name" : "'.$u->get_name().'",
					"second_name" : "'.$u->get_second_name().'",
					"last_name" : "'.$u->get_last_name().'",
					"email" : "'.$u->get_email().'",
					"image" : "'.$u->get_imageURL().'",
					"token" : "'.Security::generate_token($u->get_id_user()).'"
				}';	
		} catch (InvalidUserException $ex) 
		{
			echo '{ "status" : 1, "errorMessage" : "'.$ex->get_message().'" }';	
		}
	}
	else
		echo '{ "status" : 2, "errorMessage" : "Invalid Parameters" }';
?>