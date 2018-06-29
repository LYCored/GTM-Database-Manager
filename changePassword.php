<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/29
 * Time: 9:56
 */

session_start();

if (isset($_SESSION['server']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $conn = mysqli_connect($_SESSION['server'],$_SESSION['username'],$_SESSION['password']);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        header("location:index.php");
    }
}
else
    die("error!");

mysqli_query($conn, "set names utf8");
mysqli_select_db($conn,'mysql');

$username = $_SESSION['username'];
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$ensurepassword = $_POST['ensurepassword'];
$sql = "select * from user where user = '$username' and authentication_string = password('$oldpassword')";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row == null)
{
    die('error 101: password don\'t correct!');
}
if($newpassword != $ensurepassword){
    die('error 102: new password don\'t ensure!');
}
$sql = "update user set authentication_string = password('$newpassword')";
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}
echo("<html><script language='JavaScript'>alert('Change password sucessfully!');</script></html>");