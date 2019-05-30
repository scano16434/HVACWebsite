<?php

//get_id.php
	try{
		$connect = new PDO('mysql:host=localhost;dbname=new_db', 'root', '');
	} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
	}

	$query = "
	SELECT id FROM events
	ORDER BY id DESC
	LIMIT 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	echo json_encode( $result );

?>