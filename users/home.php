<?php
session_start();
if(empty($_SESSION))
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
th {
  text-align: left;
}
</head>
</style>
<body>
<body>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks-PHP/dashboard/index.html">
		<img src="/BDBooks-PHP/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
	</div>
	
</div>
<ul>
  <li><a class="active" href="/BDBooks-PHP/index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="#about">All books</a></li>
  <li><a href="/BDBooks-PHP/admin/allBooks.php">New Arrival</a></li>
  <li><a href="/BDBooks-PHP/users/home.php"><?php echo $_SESSION["email"]; ?></a></li>
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
				echo "Recovery email :" . $data_decoded[$row]["recoveryEmail"];
			}
		}?>
		</div>
	</form>
 </div>
 <div class="footer">
	<?php include '../assets/layout/footer.php' ; ?>	
</div>
<center>

</center>
</body>
</html>