<?php

//load.php

try{
	$connect = new PDO('mysql:host=localhost;dbname=new_db', 'root', '');
} catch (PDOException $e) {
   	print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
	$data[] = array(
		'id'	=> $row["id"],
		'title' => $row["title"],
		'start' => $row["start_event"],
		'end'	=> $row["end_event"]
 	);
}

echo json_encode($data);

?>