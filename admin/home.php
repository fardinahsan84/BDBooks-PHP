<?php
session_start();
if(empty($_SESSION))
{
	header('Location:http://localhost/BDBooks-PHP/login.php');
	exit();
}
if($_SESSION["type"] == "user")
{
  header('Location:http://localhost/BDBooks-PHP/login.php');
	exit();
}
$filepath = "../data/usersdb.json";
$f3 = fopen($filepath, "r");
$data = fread($f3, filesize($filepath));
$data_decoded = json_decode($data, true);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/header.css">
<title>
home page
</title>
<style>

.error {color: #FF0000;}
span {color: #FF0000;}
.btn-group a {
	background-color: #f3920a;
    border: none;
    width: 30%;
    color: white;
    padding: .5em 7em .5em 7em ;
    font-size: 1.3em;
    cursor: pointer;
	text-decoration: none;
	margin: .5em 0 .5em 0;
	display:block;
	margin-left:30em;
}
.btn-group a:hover {
	background-color: #d17c06;
}
</style>
</head>
<body>
<body>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks-PHP/index.php">
		<img src="/BDBooks-PHP/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
	</div>
	
</div>
<ul>
  <li><a class="active" href="/BDBooks-PHP/index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="/BDBooks-PHP/common/contact.php">Contact</a></li>
  <li><a href="/BDBooks-PHP/common/about.php">About</a></li>
  <li><a href="/BDBooks-PHP/book/allBooks.php">All books</a></li>
  <li><a href="/BDBooks-PHP/admin/addBooks.php">Add books</a></li>
  <li><a href="/BDBooks-PHP/admin/home.php"><?php echo $_SESSION["email"];?></a></li>
  <li><a href="/BDBooks-PHP/logout.php">Sign out</a></li>
</ul>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-design">
		<h1>Welcome to home page!!</h1><br>
		<?php for ($row=0; $row<count($data_decoded); $row++){ 
			if($_SESSION["email"] == $data_decoded[$row]["email"]) { 
				echo "Name :" . $data_decoded[$row]["firstName"] ." ". $data_decoded[$row]["lastName"] . "<br>";
				echo "Email :" . $data_decoded[$row]["email"] . "<br>";
				echo "Gender :" . $data_decoded[$row]["gender"] . "<br>";
				echo "Recovery email :" . $data_decoded[$row]["recoveryEmail"]. "<br><br>";
			}
		}?>

		<div class="btn-group">
			<a href ="/BDBooks-PHP/admin/update.php">Update Profile</a>
			<a href ="/BDBooks-PHP/admin/addBooks.php">Add New Book</a>
			<a href ="/BDBooks-PHP/admin/allBooks.php">View All Books</a>
		</div>

	</div>
</div>
<div class="footer">
  <p>Contact us<br>
		samantasadia1971@gmail.com<br>
		Developer: Samanta Sadia<br>
		<a href="https://github.com/samantasadia">www.github.com</a><br>
		© Copyright 2021 BDBooks-PHP Ltd. - All Rights Reserved
  </p>
</div>
</center>
</body>
</html>