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
	#wrapper {
		padding-left: 2%;
	}
	#wrapper ul {
		background-color: transparent;
		
	}
	#wrapper ul li {
		list-style-type: circle;
		margin: 2%;
	}
	#wrapper ul p {
		margin-left: : 50%;
		padding-left: 25%;
	}
	
</style>
<body>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a class="active" href="store.php">BookStore</a></li>
	</ul>
<h1>Welcome to Komali's BookStore</h1>
<?php
require("mysqli_connect.php");
session_start();

$q = "select * from BookInventory";
$r = mysqli_query($dbc, $q);

echo "<br><h2>Books available in the Store. Click on each for checkout:</h2>";
while ($row = mysqli_fetch_array($r)) {
	$bookID = $row['bookid'];
	echo "<div id = 'wrapper'><ul>";
	echo "<li><a href = checkout.php?bookid=", $bookID, "><h3><u>", $row['booktitle'], "</u></h3></a></li>";

	echo "<p><strong>Price: </strong>", $row['price'], "</p>";
	echo "<p><strong>Quantity: </strong>", $row['quantity'], "</p>";
	echo "<p><strong>Author: </strong>", $row['author'], "</p>";
	echo "</ul></div>";

}
?>
</body>
</html>
