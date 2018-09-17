/* Submit a review to the database. */
	try{
		$tsql = "INSERT INTO Production.ProductReview (ProductID, ReviewerName, ReviewDate, EmailAddress, Rating, Comments)VALUES(?,?,?,?,?,?)";
		$params = array(&$_POST['productid'], $_POST['name'], date("Y-m-d"), $_POST['email'], $_POST['rating'], $_POST['comments']);
		$insertReview = $conn->prepare($tsql);
		$insertReview->execute($params);
	}
	catch(Exception $e){
		die( print_r( $e->getMessage() ) );
	}
	GetSearchTerms( true );
