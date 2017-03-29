<?php
	require_once('models/user.php');
	require_once('security.php');
	header('Access-Control-Allow-Origin:*');

	if (isset($_GET['username']) && isset($_GET['password']))
	{
		//create user
		$u = new User($_GET['username'], $_GET['password']);

		if ($u->get_id_user() == '')
		{
			echo '{ "status" : 1, "errorMessage" : "User not Found" }';	
		}
		else
		{
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
		}	
	}
	else
		echo '{ "status" : 2, "errorMessage" : "Invalid Parameters" }';
?>