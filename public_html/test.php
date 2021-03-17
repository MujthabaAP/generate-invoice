<?php

include './config/helper.php';


$obj = new helper();

echo"<pre>";
print_r($_POST);
print_r(urldecode($_POST['product_detail']));
die();

?>