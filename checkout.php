<?php

?>
<html>
<head>
	<title>The BookStore</title>
</head>
<style type="text/css">
	body {
		background-image: url("lib.jpg");
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}
	ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	  background-color: #333;
	}

	li {
	  float: left;
	}

	li a {
	  display: block;
	  color: white;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	}

	/* Change the link color to #111 (black) on hover */
	li a:hover {
	  background-color: #3DB6DC;
	}
	.active {
		background-color: #D5C7D6;
	}
	#title {
		color: blue;
	}
</style>
<body>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="store.php">BookStore</a></li>
		<li><a class="active" href="checkout.php">Checkout</a></li>
	</ul>
<h1>Welcome to Komali's BookStore</h1>


<?php
require("mysqli_connect.php");
session_start();
$bookID = $_GET['bookid'];
// $bookPRICE = $_GET['price'];
// $Quantity = $_GET['quantity'];
// $Author = $_GET['author'];
// echo $bookID;

$q = "select * from BookInventory where bookid = ?";
$r = @mysqli_query($dbc, $q);

// Prepare the statement:
$stmt = mysqli_prepare($dbc, $q);

// Bind the variables:
mysqli_stmt_bind_param($stmt, 's', $bookID);
// echo $bookID;

// Execute the query:
mysqli_stmt_execute($stmt);
// mysqli_stmt_store_result($stmt);
$res = $stmt->get_result();


while ($row = $res->fetch_array()) {
echo "<h3>You have selected the book <span id='title'>",  $row['booktitle'], "</span> for checkout</h3>";

	// echo "<br><strong>Title: </strong>", $row['booktitle'];
	// echo "<br><strong>Price: </strong>", $row['price'];
	// echo "<br><strong>Quantity: </strong>", $row['quantity'];
	// echo "<br><strong>Author: </strong>", $row['author'];
	$quantity = $row['quantity'];
	$price = $row['price'];
	$booktitle = $row['booktitle'];
	# code...
}
// }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<br><b>Quantity booked: </b>".$_POST['quantity'];
    echo "<br><b>Book Title: </b>".$booktitle;
    $quantity -=$_POST['quantity'];
    echo "<br><b>Quantity after update : </b>". $quantity;
    $updatestatement = mysqli_prepare($dbc, "UPDATE BookInventory SET quantity = ? WHERE bookid = ?");
            mysqli_stmt_bind_param($updatestatement, 'ss',$quantity, $bookID);
            mysqli_stmt_execute($updatestatement);
            // header('Location:index.php');


            $orderInsertQuery = "insert into BookInventoryOrder(firstname, lastname, item_ordered, quantity_ordered) values('{$_POST['firstname']}','{$_POST['lastname']}','$booktitle', {$_POST['quantity']})";
            $row = mysqli_query($dbc, $orderInsertQuery);
}
?>
    <p><h4>Please Enter the following details to checkout: </h4>
    <form action="#" method="POST">
        <p><b>Firstname: </b><input type='text' name='firstname' required></p>
        <p><b>Lastname: </b><input type='text' name='lastname' required></p>
        <p><b>Quantity required: </b><input type='text' name='quantity' required></p>
        <b>Payment Options: </b>
			<input type="radio" name="paymentmethod"
			<?php if (isset($paymentmethod) && $paymentmethod=="cred/deb") 
			echo "checked"
			// <p><b>enter the card Number: </b><input type='text' name='cardnumber' required></p>"
			?>
			value="cred/deb">Credit/debit
			<input type="radio" name="paymentmethod"
			<?php if (isset($paymentmethod) && $paymentmethod=="COD") echo "checked";?>
			value="COD">Cash on Delivery
			<input type="radio" name="paymentmethod"
			<?php if (isset($paymentmethod) && $paymentmethod=="gift") echo "checked";?>
			value="gift">Giftcards
        <p><input type='submit' value='CheckOut'>

    </form>
</body>
</html>



