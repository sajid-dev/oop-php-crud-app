<?php
/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/20/2017
 * Time: 1:25 PM
 */
$product_id = isset($_GET['id']) ? $_GET['id'] : die("Error no id found");

echo $product_id;