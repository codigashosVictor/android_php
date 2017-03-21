<?php
	function get_connection()
	{
		//read configuration file
		$config = parse_ini_file('config.ini');
		//read parameters
		if (isset($config['server'])) $server = $config['server']; else	{ echo 'Configuration error : Server name not found'; die; }
		if (isset($config['user']))	$user = $config['user']; else {	echo 'Configuration error : User name not found'; die; }
		if (isset($config['password']))	$password = $config['password']; else {	echo 'Configuration error : Password not found'; die; }
		if (isset($config['database']))	$database = $config['database']; else {	echo 'Configuration error : Database name not found'; die; }
		//open connection
		$connection = mysqli_connect($server, $user, $password, $database);
		if ($connection === false) 
		{
			echo 'Could not connect to MySql';
			die;
		}
		//return connection
		return $connection;
	}
?>