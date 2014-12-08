<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $json = file_get_contents("php://input");
    $json = json_decode($json);

    $name = $json->productName;
    $category = $json->productCategory;
    $price = (float) $json->productPrice;
    $descr = $json->productDescription;

    if($name == "" || $category == "" || $price == 0 || $descr == "" ) {
    	echo '{"response": "Вы не заполнили все поля!"}'; exit;}

    $conn = mysql_connect("localhost", "root", "") or die("no connection to DB");
    mysql_select_db("cms_project") or die("no DB");

    $sql = "INSERT INTO cms_product (name,price,description,category)
    			   VALUES ('{$name}', {$price}, '{$descr}', '{$category}')";

    $flag = mysql_query($sql);

    if($flag) {
    	echo '{"response": "Товар успешно добавлен!"}';
    }else {echo '{"response": "При добавлении товара произошла ошибка. Попробуйте позже!"}';}

    mysql_close($conn);
}