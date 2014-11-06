<?php
session_start();
include_once "func.php";

    $user = file_get_contents('php://input');
    $userO = json_decode($user);

    $conn = mysql_connect("localhost", "root", "") or die("no connection to DB");
    mysql_select_db("cms_project") or die("no DB");

    $userS = unserialize($_SESSION['userInfo']);

    $sql = "UPDATE cms_users SET
                        name='{$userO->userName}',
                        phone='{$userO->userPhone}',
                        birthday='{$userO->userBDay}',
                        info='{$userO->userInfo }'
                          WHERE email='{$userS->getEmail()}'";

    $flag = mysql_query($sql) or die("false insert data!");
    if($flag) {
        $userS->setName($userO->userName);
        $userS->setBirthday($userO->userBDay);
        $userS->setPhone($userO->userPhone);
        $userS->setInfo($userO->userInfo);

        $_SESSION['userInfo'] = serialize($userS);

        echo '{"msg":"ok"}';
    }else { echo '{"msg":"bad"}'; }

    mysql_close($conn);
