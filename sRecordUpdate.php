<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/27
 * Time: 0:21
 */

session_start();
//连接数据库
if (isset($_SESSION['server']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $conn = mysqli_connect($_SESSION['server'],$_SESSION['username'],$_SESSION['password']);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        header("location:index.php");
    }
}
else
    die("error!");

mysqli_autocommit($conn, false);
mysqli_query($conn, "set names utf8");
mysqli_select_db($conn,'multipleshop');

$key = $_POST['key'];
$salespersonKey = $_POST['salespersonKey'];
$col = $_POST['col'];
$value = $_POST['value'];

if ($_POST['col'] == "col3"){
    $col = "name";
    $sql = "update salesperson set $col = \"" . $value . "\" where salespersonID = " . $salespersonKey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col4") {
    $col = "price";
    $sql = "update salerecord set $col = \"" . $value . "\" where sRecordID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "lastCol") {
    $col = "date";
    $sql = "update salerecord set $col = \"" . $value . "\" where sRecordID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}

mysqli_commit($conn);
echo("Update success!");
mysqli_close($conn);