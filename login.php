<?php
session_start();
$filepath = "data/usersdb.json";
$f3 = fopen($filepath, "r");
$data = fread($f3, filesize($filepath));
$data_decoded = json_decode($data, true);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/header.css">
<style>

a:link {
  text-decoration: none;
}

 table.center {
          margin-left: auto;
          margin-right: auto;
        }
        	*{
        		margin: 0;
        		padding: 0;
        	}
        	body{
        	margin: 0;
        	padding: 0;
        	font-family: sans-serif;
        	background: url(img1.jpg) no-repeat;
        	background-size: cover;
        	}
        	.header1{
        				padding-left: 540px;
        				padding-top: 70px;
        			}
        	.form-design{
        		width: 320px; background: #3e3d3d;
        		padding: 40px 20px;
        		box-sizing: border-box;
        		position: fixed;
        		left: 50%;
        		top: 50%;
        		transform: translate(-50%, -50%);
        	}
        	h1{
        		text-align: center;
        		color: #fff;
        		font-weight: normal;
        		margin-bottom: 20px;
        	}
        input{
        	width: 100%;
        	background: none;
        	border: 1px solid #fff;
        	border-radius: 3px; padding: 6px 15px;
        	box-sizing: border-box;
        	margin-bottom: 20px;
        	font-size: 16px;
        	color: #fff;
        }
        input[type="submit"]{
        	background: #bac675;
        	border: 0;
        	cursor: pointer;
        	color: #3e3d3d;
        }
        input[type="submit"]:hover{
        	background: #a4b15c;
        	transition: .6s;
        }
        ::placeholder{
        	color: #fff;
        }
        p{
        	color: white;
        	font-size: 12px;
        }
        p a{
        	color: white;
        }
        a{
        	padding-left: 80px ;
        	color: white;
        }
.error {
	
	color: #FF0000;

	}

</style>

<?php
// define variables and set to empty values
$passwordErr = $emailErr = $U_P_Err = "";

$email = $password =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "*Username is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["password"])) {
    $passwordErr = "*Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
  if($email != "" && $password!= ""){
		//$vemail = file_get_contents('./data/db.txt', FALSE, NULL, 0, strlen($email));
		//$pass = file_get_contents('./data/db.txt', FALSE, NULL, strlen($email), strlen($password)+1);
		//$data_explode_by_newline = explode("\n", $data);
		//$data_decoded = json_decode($data, true);
		for($row =0; $row <count($data_decoded); $row++){
			//admin login
			if($email == $data_decoded[$row]["email"] && $password== $data_decoded[$row]["password"] && $data_decoded[$row]["type"]=="admin")
			{
				$_SESSION["email"] = $email;
				$_SESSION["password"] = $password;
				$_SESSION["type"] = "admin";
				
				header('Location: http://localhost/BDBooks-PHP/admin/home.php');
				exit();
			}
			//user login
			elseif($email == $data_decoded[$row]["email"] && $password== $data_decoded[$row]["password"] && $data_decoded[$row]["type"]=="user")
			{ 
				$_SESSION["email"] = $email;
				$_SESSION["password"] = $password;
				$_SESSION["type"] = "user";
				
				header('Location: http://localhost/BDBooks-PHP/users/home.php');
				exit();
			}
			else 
			{
				$U_P_Err = "Invalid Email/Password!!";
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
  <li><a href="/BDBooks-PHP/common/contact.php">Contact</a></li>
  <li><a href="/BDBooks-PHP/common/about.php">About</a></li>
  <li><a href="/BDBooks-PHP/admin/allBooks.php">All books</a></li>
  <li><a href="#about">New Arrival</a></li>
  <li><a href="/BDBooks-PHP/login.php">Sign in</a></li>
  <li><a href="/BDBooks-PHP/users/register.php">Sign up</a></li>
</ul>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <div class="form-design">
              <h1>Log in</h1>
			  <span class="error"> <?php echo $emailErr;?></span>
              <input type="email" placeholder="email"  name="email" >
			  <span class="error"> <?php echo $passwordErr;?></span>
               <input type="password"  placeholder="password"  name="password" >
			   
				<input type="submit" value="Sign in" name="submit">
				<a href ="/BDBooks-PHP/user/register.php">Register now!!<a>
				<span class="error"> <?php echo $U_P_Err;?></span>
      </div>

</div>
<div class="footer">
	<?php include 'assets/layout/footer.php' ; ?>
</div>
</center>
</form>
</body>
</html>
