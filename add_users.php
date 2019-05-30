<?php

//add_users.php

try{
	$connect = new PDO('mysql:host=localhost;dbname=new_db', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//$id = mysql_insert_id($connect);
//if (isset($_POST["Submit"]))
//{
	$query = "
	INSERT INTO users
	(id, username)
	VALUES (:id, :username)
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':id' 			=> $_POST["id"],
			':username' 	=> $_POST["username"]
		)
	);
//}

?>