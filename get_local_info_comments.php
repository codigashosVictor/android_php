<?php
	//allow external access
	header('Access-Control-Allow-Origin:*');
	//use empresa
	require_once('models/user.php');
	require_once('models/local.php');
	require_once('connection.php');
	$found=false;
		//start json
		$json = '{ "status" : 0, 
			"Local Info" : {';
		//read data
		$first = true;
		$first1 = true;
		
		foreach (Local::getLocalInfo() as $e) 
		{
			$found=true;
			if (!$first) $json .= ','; else $first = false;
			$json .= '
						"localName" : "'.$e->getlocalName().'",
						"localLatitud" : '.$e->getlocalLatitud().',
						"localLongitud" : '.$e->getlocalLongitud().',
						"rating" : '.$e->getlocalRating().'
						},
					"datosUser" : [';
						foreach(User::getUserComment() as $d)
						{
							if (!$first1) $json .= ','; else $first1 = false;		
								$json.='
									{
										"name" : "'.$d->get_name().'",
										"second_name" : "'.$d->get_second_name().'",
										"last_name" : "'.$d->get_last_name().'",
										"comment" : "'.$d->get_comment().'",
										"imageURL" : "'.$d->get_imageURL().'"
									}';
						}
		$first1=true;			
		};
		$json .= ' ]}';
		
		if(!$found){echo '{ "status" : 1 , "message" : "Local not Found"}'; die; }
		//end json
		
		//display json
		echo $json;
?>