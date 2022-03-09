<?php

	function doLogin($email,$password)
	{

		$db = getDB();

		if ($db == null)
		{
			printf("db didn't get connected to");	
			return;
		}

		//Prepare the statement
		$stmt = $db->prepare("SELECT id, email, password FROM Users WHERE email = :email LIMIT 1;");

		$params = array(":email" => $email);
		$r = $stmt->execute($params);

		$e = $stmt->errorInfo();
		if ($e[0] != "00000"){
			printf("Something went wrong: " . var_export($e, true));
			return null;
		}

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//We weren't able to find a user with the specified email
		if ($result == null)
		{
			echo "ERROR: No user with that email found";	
			return false;
		}
		
		if ($password != $result["password"])
		{
			echo "ERROR: Password does not match";
			return false;
		}

		return true;
	}

	function doValidation($sectionID)
	{

	}

?>