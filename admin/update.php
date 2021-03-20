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
<title>
update profile
</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  width: 12%;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

a:link {
  text-decoration: none;
}
h1 {
	text-align:center;
}
.hero-bg {
    background: #307D99;
    color: white;
	background-size: cover;
    padding-bottom: 50em;
	padding-top: 2em;
}
.hero-bg a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
	margin-left:12em;
	
}
form {
    margin: 6px auto;
    width: 45%;
    background-color: #727070;
    height: 1100px;
    border-radius: 10px;
    box-shadow: 1px 1px 5px 0px ;
	padding-bottom:3em;
}
form label ,input {
    display: block;

}
form label ,input {
    padding: 10px;
    width: 355px;
    margin-bottom: 12px;
    position: relative;
    left: 74px;
}
form input {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 1px 1px 0px #000;
    padding: 15px;
}
form input[type=submit] {
    background-color: #06d6a0;
    width: 386px;
    margin: 26px 0px 12px 0px;
    font-size: 20px;
    color: #FFF;
	cursor: pointer;
}
form label  {
    margin-bottom: -3px;
    margin-left: -6px;
    font-size: 20px;
}
span {
    color: red;
	margin-left:8em;
	font-size: 20px;
}		
.error {
	
	color: #FF0000;

	}
.form-design{
	position: static;
	
}
.footer {
  text-align: center;
  padding: 20px;
  background-color: #515151;
  color: white;
}
.footer a{
	color: white;
    text-decoration: none;
    font-weight: bold;
}

</style>

<?php
//margin-left: 40em;
	//margin-top: 5em;
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $genderErr = $remailErr = $passwordErr = $unameErr = "";

$fname = $lname= $email = $gender = $remail = $uname = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
    $fname = test_input($_POST["fname"]);
  }
  
  if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = test_input($_POST["lname"]);
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["uname"])) {
    $unameErr = "Username is required";
  } else {
    $uname = test_input($_POST["uname"]);
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  
  if (empty($_POST["remail"])) {
    $remailErr = "Recovery email is required";
  } else {
    $remail = test_input($_POST["remail"]);
  }
  if($fname != "" && $lname != "" && $email != "" && $gender !="" && $uname != "" && $password != "" && $remail != "")
   {
    for($row =0; $row <count($data_decoded); $row++){
        if($email == $data_decoded[$row]["email"] && $data_decoded[$row]["type"]=="admin")
        {
            $data_decoded[$row]["firstName"] = $fname;
            $data_decoded[$row]["lastName"] = $lname;
            $data_decoded[$row]["email"] = $email;
            $data_decoded[$row]["gender"] = $gender;
            $data_decoded[$row]["uname"] = $uname;
            $data_decoded[$row]["password"] = $password;
            $data_decoded[$row]["recoveryEmail"] = $remail;
            $data_decoded[$row]["type"] = 'user';
            file_put_contents('../data/usersdb.json', json_encode($data_decoded));
            header('Location: http://localhost/BDBooks-PHP/admin/home.php');
            exit();
        }
    }
   }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>
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
    <li><a href="#about">All books</a></li>
    <li><a href="/BDBooks-PHP/admin/addBooks.php">Add books</a></li>
    <li><a href="/BDBooks-PHP/admin/home.php"><?php echo $_SESSION["email"] ;?></a></li>
    <li><a href="/BDBooks-PHP/logout.php">Sign out</a></li>
</ul>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-design">
		<h1>Update Profile</h1>
        <?php for ($row=0; $row<count($data_decoded); $row++){ 
			if($_SESSION["email"] == $data_decoded[$row]["email"]) {?>
                <span class="error"> <?php echo $fnameErr;?></span>
                <div class="lb">
                    <label for="fname">First Name:</label>
                    <div>
                        <input type="text" id="fname" name="fname" value= "<?php echo htmlspecialchars($data_decoded[$row]["firstName"]);?>" />
                    </div>
                </div>
                <span class="error"> <?php echo $lnameErr;?></span>
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value= "<?php echo htmlspecialchars($data_decoded[$row]["lastName"]);?>" />
                
                
                <span class="error"> <?php echo $genderErr;?></span>
                <label for="gender">Gender:</label>
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="male" >
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="female">

                

                <span class="error"> <?php echo $emailErr;?></span>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data_decoded[$row]["email"]);?>" />

                <span class="error"> <?php echo $unameErr;?></span>
                <label for="uname">Username:</label>
                <input type="text" id="fname" name="uname" value="<?php echo htmlspecialchars($data_decoded[$row]["uname"]);?>" />

                        <span class="error"> <?php echo $passwordErr;?></span>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($data_decoded[$row]["password"]);?>" />

                

                        <span class="error"> <?php echo $remailErr;?></span>
                <label for="remail">Recovery Email:</label>
                <input type="remail" id="remail" name="remail" value="<?php echo htmlspecialchars($data_decoded[$row]["recoveryEmail"]);?>" />

                
                <input type="submit" name="submit" value="Update">
                <a href ="/BDBooks-PHP/admin/home.php">Back<a>
                <?php }
        } ?>

      </div>
</form>
</div>
<div class="footer">
	<?php include '../assets/layout/footer.php' ; ?>
</div>
</center>
</body>
</html>

