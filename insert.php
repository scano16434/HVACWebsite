<?php

//insert.php

try{
	$connect = new PDO('mysql:host=localhost;dbname=new_db', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

//if (isset($_POST["Submit"]))
//{
	$query = "
	INSERT INTO events
	(title, start_event, end_event)
	VALUES (:title, :start_event, :end_event)
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':title' 		=> $_POST["title"],
			':start_event' 	=> $_POST["start"],
			':end_event'	=> $_POST["end"]
		)
	);
//}

?>