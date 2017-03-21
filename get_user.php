<?php

	header('Access-Control-Allow-Origin:*');
	require_once('models/User.php');
	$u = new User();
	$json = '{ "status" : 0, "User" : [
				{
					"name" : "'.$u->get_name().'",
					"second_name" : "'.$u->get_second_name().'",
					"last_name" : "'.$u->get_last_name().'",
					"email" : "'.$u->get_email().'",
					"image" : "'.$u->get_imageURL().'"
				}]}';
	echo $json;
?>