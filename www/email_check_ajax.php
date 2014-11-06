<?php
    include "func.php";

    $conn = mysql_connect("localhost", "root", "") or die("no connection to DB");
    mysql_select_db("cms_project") or die("no DB");

    $email = clearData($_POST['email']);

    $sql = "SELECT email FROM cms_users WHERE email='{$email}'";

    $res = mysql_query($sql) or die("bad arg!");

    if(mysql_num_rows($res) == 0){
        echo '{"email":"free"}';
    }else {
        echo '{"email":"busy"}';
    }
?>