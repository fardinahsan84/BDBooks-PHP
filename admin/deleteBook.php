<?php
// read json file
/*$data = file_get_contents('results.json');

// decode json to associative array
$json_arr = json_decode($data, true);

// get array index to delete
$arr_index = array();
foreach ($json_arr as $key => $value)
{
    if ($value['Code'] == "2")
    {
        $arr_index[] = $key;
    }
}

// delete dataset
foreach ($arr_index as $i)
{
    unset($json_arr[$i]);
}

// rebase array
$json_arr = array_values($json_arr);

// encode array to json and save to file
file_put_contents('results_new.json', json_encode($json_arr));*/
?>
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
delete page
</title>
<style>

.error {color: #FF0000;}
h1 {
	text-align:center;
}
span {color: #FF0000;}
.image {
	float :left;
	margin-left : 15em;
	margin-top: 1em;
}
.info {
	float:left;
	margin: 5em 10em 0 2em;
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
.button {
  font-family:'Open Sans';
  font-size: 16px;
  font-weight:400;
  display:inline-block;
  color:#FFF;
  border-radius: .25em;
  text-shadow: -1px -1px 0px rgba(0,0,0,0.4);
}

.primary {
  line-height:40px;
  transition:ease-in-out .2s;
  padding: 0 16px;
}
.primary:hover{
	background-color:#990000;
  transform:scale(1.02);
  box-shadow:2px 2px 5px rgba(0,0,0,0.20), inset 0 0 0 99999px rgba(0,0,0,0.2);
}
.cancel:before, .delete:before {
  font-family: FontAwesome;
  display: inline-block;
  font-size:1rem;
  padding-right:12px;
  background:none;
  color:#FFF;
}
.cancel {
  background-color: #9400D3;
  cursor: pointer;
  text-decoration: none;
  
  &:before {
    content: "\f040";
  }
}
.cancel:hover {
	background-color: #4B0082;
}
.delete {
	cursor: pointer;
  background-color:#FF0000;
  
  &:before {
    content: "\f1f8";
  }
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
  <li><a href="/BDBooks-PHP/common/contact.php">Contact</a></li>
  <li><a href="/BDBooks-PHP/common/about.php">About</a></li>
  <li><a href="/BDBooks-PHP/admin/allBooks.php">All books</a></li>
  <li><a href="/BDBooks-PHP/admin/addBooks.php">Add books</a></li>
  <li><a href="/BDBooks-PHP/admin/home.php"><?php echo $_SESSION["email"] ?></a></li>
  <li><a href="/BDBooks-PHP/logout.php">Sign out</a></li>
</ul>
<div class="hero">
	
		<div class="form-design">
		<h1>Do you want to Delete this Book?</h1><br>
        <?php for ($row=0; $row<count($data_decoded); $row++){ 
			if($_GET["id"] == $data_decoded[$row]["id"]) {?>
            <div class="image">
                <img src="<?=@$data_decoded[$row]["path"]?>" width="400" height="400" />
            </div>

            <div class="info">
		    <?php 
			echo "Book name :" . $data_decoded[$row]["bname"] ."<br>";
			echo "Author :" . $data_decoded[$row]["author"] . "<br>";
			echo "Price :" . $data_decoded[$row]["price"] . "Tk" . "<br>";
			echo "Publication :" . $data_decoded[$row]["pub"] . "<br>";
			echo "Description :" . $data_decoded[$row]["des"]. "<br><br>";?>

            <a class="button primary cancel" href ="/BDBooks-PHP/admin/allBooks.php"> Cancel </a>
            <a class="button primary delete" href ="/BDBooks-PHP/admin/ok.php?id=<?php echo $data_decoded[$row]["id"];?>">Delete</a>
            </div>
            <?php
            }
        }
		?>
		</div>
    
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>