	$conn = new PDO("sqlsrv:Server=127.0.0.1;Database=Testing","username","password");

	$sql = "{:retval = CALL spGetSomethingById (@Id=:userID,@myemail=:userEmail)}";

	$stmt = $conn->prepare($sql);

	$retval = null;
	$userID = 2;
	$userEmail = "";

	$stmt->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
	$stmt->bindParam('userID', $userID, PDO::PARAM_INT);
	$stmt->bindParam('userEmail', $userEmail, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 50);

	$stmt->execute();

	$results = array();
	do{
		$results []= $stmt->fetchAll();
	}
	while ($stmt->nextRowset());


	echo '<pre>';
		print_r($retval);echo "\n"; // the return value: 5
		print_r($userEmail);echo "\n"; // email for record id=1
		print_r($results);echo "\n"; // all record sets
	echo '</pre>';

	$stmt->closeCursor();
	unset($stmt);
