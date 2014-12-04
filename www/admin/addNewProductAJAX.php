<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $json = file_get_contents("php://input");
    $json = json_decode($json);

    $conn = mysql_connect("localhost", "root", "") or die("no connection to DB");
    mysql_select_db("cms_project") or die("no DB");

    $name = $json->productName;
    $category = $json->productCategory;
    $price = (float) $json->productPrice;
    $descr = $json->productDescription;

    $sql = "INSERT INTO cms_produc (name,price,description,category)
    			   VALUES ('{$name}', {$price}, '{$descr}', '{$category}')";

    $flag = mysql_query($sql);

    if($flag) {
    	echo '{"response": "ok"}';
    }else {echo '{"response": "bad"}';}

    mysql_close($conn);
}