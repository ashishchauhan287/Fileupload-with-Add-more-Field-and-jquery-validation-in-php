<?php
$theString = "123456";
$j = strlen($theString);
for ($k = 0; $k < $j; $k++) 
{
    $char = substr($theString, $k, 1);
    $var_arr[$k] =  $char;
}
print_r($var_arr);
?>