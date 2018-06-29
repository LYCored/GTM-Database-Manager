<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/27
 * Time: 16:37
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

$ins0 = $_POST['value0'];
$ins1 = $_POST['value1'];
$ins2 = $_POST['value2'];
$ins3 = $_POST['value3'];
$ins4 = $_POST['value4'];
$ins5 = $_POST['value5'];
$ins6 = $_POST['value6'];
$ins7 = $_POST['value7'];
$ins8 = $_POST['value8'];

$sql = "select name from store where storeID = $ins1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row == null )
{
    $sql = "insert into store(storeID,name,address) values ('$ins1','$ins2',null)";
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法添加数据: ' . mysqli_error($conn));
    }
}
else{
    if ($row['name'] != $ins2){
        echo("Foreign key don't match!");
        return;
    }
}

$sql = "select name from supplier where supplierID = $ins3";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row == null )
{
    $sql = "insert into supplier(supplierID,name,contact,sex,phone,QQ,wechat) values ('$ins3','$ins4',null,null,null,null,null)";
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法添加数据: ' . mysqli_error($conn));
    }
}
else{
    if ($row['name'] != $ins4){
        echo("Foreign key don't match!");
        return;
    }
}

$sql = "select name from good where goodID = $ins5";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row == null )
{
    $sql = "insert into good(goodID,name,supplierID,price,brand,kind) values ('$ins5','$ins6','$ins3',null,null,null)";
    $result = mysqli_query($conn,$sql);
    if(! $result )
    {
        die('无法添加数据: ' . mysqli_error($conn));
    }
}
else{
    if ($row['name'] != $ins6){
        echo("Foreign key don't match!");
        return;
    }
}

$sql = "insert into purchaserecord(pRecordID,storeID,supplierID,price,amount,goodID ) values ('$ins0','$ins1','$ins3','$ins7','$ins8','$ins5')";
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法添加数据: ' . mysqli_error($conn));
}

mysqli_commit($conn);
echo("Insert success!");
mysqli_close($conn);