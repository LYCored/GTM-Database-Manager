<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/26
 * Time: 16:02
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
$managerkey = $_POST['managerkey'];
$deputymanagerkey = $_POST['deputymanagerkey'];
$inspectorkey = $_POST['inspectorkey'];
$purchaserkey = $_POST['purchaserkey'];
$value = $_POST['value'];

if ($_POST['col'] == "col2"){
    $col = "name";
    $sql = "update store set $col = \"" . $value . "\" where storeID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col4") {
    $col = "name";
    $sql = "update manager set $col = \"" . $value . "\" where managerID = " . $managerkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col6") {
    $col = "name";
    $sql = "update deputymanager set $col = \"" . $value . "\" where deputymanagerID = " . $deputymanagerkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col8") {
    $col = "name";
    $sql = "update inspector set $col = \"" . $value . "\" where inspectorID = " . $inspectorkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "col10") {
    $col = "name";
    $sql = "update purchaser set $col = \"" . $value . "\" where purchaserID = " . $purchaserkey;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}
else if ($_POST['col'] == "lastCol") {
    $col = "address";
    $sql = "update store set $col = \"" . $value . "\" where storeID = " . $key;
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法更新数据: ' . mysqli_error($conn));
    }
}

mysqli_commit($conn);
echo("Update success!");
mysqli_close($conn);