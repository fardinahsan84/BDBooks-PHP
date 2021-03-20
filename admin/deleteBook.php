<?php
// read json file
$data = file_get_contents('results.json');

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
file_put_contents('results_new.json', json_encode($json_arr));
?>