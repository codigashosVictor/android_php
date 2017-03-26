<?php
	class Security
	{
		//generate token
		public static function generate_token()
		{
			$token = '';
			//token without user
			if (func_num_args() == 0)
			{
				$token = sha1('utt'.date('Ymd'));
			}
			if (func_num_args() == 1)
			{
				//get user id
				$args = func_get_args();
				$user_id = $args[0];
				//token
				$token = sha1($user_id.date('Ymd'));
			}
			//return token
			return $token;
		}
	}
?>