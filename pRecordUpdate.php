<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/27
 * Time: 16:59
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
$storekey = $_POST['storekey'];
$supplierkey = $_POST['supplierkey'];
$goodkey = $_POST['goodkey'];
$col = $_POST['col'];
$value = $_POST['value'];

if ($_POST['col'] == "col3"){
    $col = "name";
    $sql = "update store set $col = \"" . $value . "\" where storeID = " . $storekey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col5") {
    $col = "name";
    $sql = "update supplier set $col = \"" . $value . "\" where supplierID = " . $supplierkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col7") {
    $col = "name";
    $sql = "update good set $col = \"" . $value . "\" where goodID = " . $goodkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col8") {
    $col = "price";
    $sql = "update purchaserecord set $col = \"" . $value . "\" where pRecordID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "lastCol") {
    $col = "amount";
    $sql = "update purchaserecord set $col = \"" . $value . "\" where pRecordID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}

mysqli_commit($conn);
echo("Update success!");
mysqli_close($conn);