#!/usr/bin/php

<?php

	require_once(__DIR__.'/getdb.php');

	function doQuery($query, $params)
	{
		$db = getDB();
		
		if ($db == null)
		{
			printf("db didn't get connected to");	
			return;
		}

		//Prepare the statement
		$stmt = $db->prepare($query);

		$r = $stmt->execute($params);

		// $r = $stmt->execute(null);

		printf("db returned: " . var_export($r, true));

		$e = $stmt->errorInfo();
		if ($e[0] != "00000"){
			printf("Something went wrong: " . var_export($e, true));
			return null;
		}

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

?>