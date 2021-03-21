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
$data = file_get_contents('../data/bookdb.json');
$data_decoded = json_decode($data, true);
    //delete book 
    //get array index to delete
    $arr_index = array();
    foreach ($data_decoded as $key => $value)
    {
        if($value['id'] == $_GET["id"])
        {
            unset($data_decoded[$key]);
        }
    }

    //rebase array
    $data_decoded = array_values($data_decoded);
    file_put_contents('../data/bookdb.json', json_encode($data_decoded));
    header('Location: http://localhost/BDBooks-PHP/admin/allBooks.php');
    exit();
?>