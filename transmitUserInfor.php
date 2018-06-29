<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/18
 * Time: 19:10
 */
session_start();

function _post($str){
    $val = !empty($_POST[$str]) ? $_POST[$str] : null;
    return $val;
}

$_SESSION['server'] = 'localhost';
$_SESSION['username'] = _post("username");
$_SESSION['password'] = _post("password");

header("location:good.php");
