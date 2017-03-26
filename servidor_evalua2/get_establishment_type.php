<?php
	//allow external access
	header('Access-Control-Allow-Origin:*');
	require_once('models/local.php');
	//start json
	$json = '{ "status" : 0, "Establishment" : [';
	//read data
	$first = true;
	foreach (Local::getLocalTypes() as $e) 
	{
		if (!$first) $json .= ','; else $first = false;
		$json .= '{
					"name" : "'.$e->getlocalType().'"
				}';		
	}
	//end json
	$json .= ' ]}';
	//display json
	echo $json;
?>