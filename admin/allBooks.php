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
$filepath = "../data/bookdb.json";
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
all books
</title>
<style>

.error {color: #FF0000;}
h1 {
	text-align:center;
}
span {color: #FF0000;}
.image {
	float :center;
	margin-left : 15em;
	margin-top: 1em;
}
.info {
	float:right;
	margin:0 25em 0 2em;
	font-weight: bold;
	text-aligh: left;
	font-size: 20px;

}
.hero {
    background: #307D99;
    color: white;
	background-size: cover;
    text-align: left;
    padding-bottom: 50em;
	padding-top: 2em;
}
.container .box { 
                width:650px; 
                margin:50px; 
                display:table; 
            } 
            .container .box .box-row { 
                display:table-row; 
            } 
            .container .box .box-cell { 
                display:table-cell; 
                width:200%; 
                padding:5px; 
            } 
            .container .box .box-cell.box1 { 
                float :center;

             } 
            .container .box .box-cell.box2 { 
				float:right;
				font-weight: bold;
				text-aligh: left;
				font-size: 20px;
				margin-bottom: 70px;
            } 
</style>
</head>
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
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="/BDBooks-PHP/book/allBooks.php">All books</a></li>
  <li><a href="/BDBooks-PHP/admin/addBooks.php">Add books</a></li>
  <li><a href="/BDBooks-PHP/admin/home.php">Samanta</a></li>
  <li><a href="/BDBooks-PHP/logout.php">Sign out</a></li>
</ul>
<div class="hero">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="form-design">
		<h1>All books list</h1><br>
		
					<?php for ($row=0; $row<3; $row++){ ?>
				<div class="container"> 
					<div class="box"> 
						<div class="box-row">
		
							<div class="box-cell box1">
							<img src="<?=@$data_decoded[$row]["path"]?>" width="300" height="350" />
							</div>
							<div class="box-cell box2">
							<?php echo "Book name :" . $data_decoded[$row]["bname"] ."<br>";
							echo "Author :" . $data_decoded[$row]["author"] . "<br>";
							echo "Price :" . $data_decoded[$row]["price"] . "Tk" . "<br>";
							echo "Publication :" . $data_decoded[$row]["pub"] . "<br>";
							echo "Description :" . $data_decoded[$row]["des"] ."<br>"; ?>
							</div>
						</div>
					</div>
				</div>
					<?php } ?>
				
	</div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>