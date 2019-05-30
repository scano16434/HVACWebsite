<?php

//delete.php

if (isset($_POST["id"])){
	try{
		$connect = new PDO('mysql:host=localhost;dbname=new_db', 'root', '');
	} catch (PDOException $e) {
    		print "Error!: " . $e->getMessage() . "<br/>";
    		die();
	}
	$query = "
	DELETE from events WHERE id=:id
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':id' 		=> $_POST["id"]
		)
	);
}

?>