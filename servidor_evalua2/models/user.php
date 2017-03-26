<?php
	header('Access-Control-Allow-Origin:*');
	require_once('connection.php');
	class User {
		private $idUser;
		private $name;
		private $second_name;
		private $last_name;
		private $email;
		private $imageURL;
		private $comment;
		private $password;

		public function get_id_user() { return $this->idUser; }
		public function set_id_user($value) { $this->idUser = $value; }		
		public function get_name() { return $this->name; }
		public function set_name($value) { $this->name = $value; }
		public function get_second_name() { return $this->second_name; }
		public function set_second_name($value) { $this->second_name = $value; }
		public function get_last_name() { return $this->last_name; }
		public function set_last_name($value) { $this->last_name = $value; }
		public function get_email() { return $this->email; }
		public function set_email($value) { $this->email = $value; }
		public function get_imageURL() { return $this->imageURL; }
		public function set_imageURL($value) { $this->imageURL=$value; } 
		public function get_comment() { return $this->comment; }
		public function set_comment($value) { $this->comment=$value; } 
		public function get_password() { return $this->password; }
		public function set_password($value) { $this->password = $value; }

		public function __construct()
		{
			if (func_num_args() == 0)
			{
				$idUser = '';
				$name = '';
				$second_name = '';
				$last_name = '';
				$email = ''; 
				$imageURL = '';
				$comment = '';
				$password = '';
			}

			if (func_num_args() == 2) 
			{
				$args = func_get_args();
				$name_user = $args[0];
				$password = $args[1];

				$connection = get_connection();
				
				$query = 'SELECT id_user, first_name, second_name, last_name, email, image FROM user WHERE name_user = ? AND password = sha1(?);';
				
				$command = $connection->prepare($query);
				
				//bind param
				$command->bind_param('ss',$name_user, $password);
				
				if ($command == false) { echo 'Error in Query : '.$query; die; }
				
				$command->execute();
				
				$command->bind_result($this->idUser, $this->name, $this->second_name, $this->last_name, $this->email, $this->imageURL);
				
				$found = $command->fetch();
				
				mysqli_stmt_close($command);

				$connection->close();

			}
			if(func_num_args() == 5)
			{
				$args=func_get_args();
				$this->name=$args[0];
				$this->second_name=$args[1];
				$this->last_name=$args[2];
				$this->comment=$args[3];
				$this->imageURL=$args[4];
				
			}
		}
		public function getUserComment()
		{
			$list=array();  
       		
       		$connection=get_connection();
        	
        	$query='SELECT u.first_name, u.second_name, u.last_name, e.comment, u.image
					FROM premises p, evaluations e, user u
					WHERE p.id_premises = e.id_premises_evaluations
					and e.id_user_evaluation = u.id_user;';
			
			$command = $connection->prepare($query);
			
			if ($command === false) {
				echo "Error in Query ".$query;
				die;
			}
			//execute command 
			$command->execute();

			$command->bind_result($name, $second_name, $last_name, $comment, $imageURL);
			while ($command->fetch()) {

			array_push($list, new User($name, $second_name, $last_name, $comment,$imageURL));
			}
			// return list
			return $list;
		}
		
	}
?>