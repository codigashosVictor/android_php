<?php
header('Access-Control-Allow-Origin:*');
require_once('connection.php');
class Local
{
	private $localId;
	private $localName;
	private $localImage;
	private $localLatitud;
	private $localLongitud;
	private $localPhone;
	private $localRating;
	private $localType;
	
	public function getlocalId(){ return $this->localid; }
	public function getlocalName(){ return $this->localName; }
	public function getlocalImage(){ return $this->localimage; }
	public function getlocalLatitud(){ return $this->localLatitud; }
	public function getlocalLongitud(){ return $this->localLongitud; }
	public function getlocalPhone(){ return $this->localPhone; }
	public function getlocalRating(){ return $this->localRating; }
	public function getlocalType(){ return $this->localType; }
	
	public function __construct()
	{

		if (func_num_args()==1)
		{
			$args=func_get_args();
			$this->localType = $args[0];
		}

		if (func_num_args()==4)
		{
			$args=func_get_args();
			$this->localName=$args[0];
			$this->localLatitud=$args[1];
			$this->localLongitud=$args[2];
			$this->localRating=$args[3];
		}
	}
	public function getLocalInfo()
	{
		$list=array();  
       	$connection=get_connection();
        $query='SELECT p.name_premises, p.lati, p.longi, (e.cal_1 + e.cal_2 + e.cal_3 )/3 as rating FROM premises p, evaluations e;';
        $command = $connection->prepare($query);
		if ($command === false) {
			echo "Error in Query ".$query;
			die;
		}
		//execute command 
		$command->execute();
		//link columns to variables
		$command->bind_result($localName, $localLatitud, $localLongitud,$localRating);
		while ($command->fetch()) {
			//add Turno to list
		array_push($list, new Local($localName, $localLatitud, $localLongitud,$localRating));
		}
		// return list
		return $list;
	}
	public function getLocalTypes()
	{
		$list=array();  
       	$connection=get_connection();
        $query='select name_establishment from establishment';
        $command = $connection->prepare($query);
		if ($command === false) {
			echo "Error in Query ".$query;
			die;
		}
		//execute command 
		$command->execute();
		//link columns to variables
		$command->bind_result($localType);
		while ($command->fetch()) {
			array_push($list, new Local($localType));
		}
		// return list
		return $list;
	}
	
}


?>