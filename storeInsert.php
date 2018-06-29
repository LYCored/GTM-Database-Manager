<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/25
 * Time: 23:30
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

$storeID = $_POST['value0'];
$storeName = $_POST['value1'];
$managerID = $_POST['value2'];
$managerName = $_POST['value3'];
$deputymanagerID = $_POST['value4'];
$deputymanagerName = $_POST['value5'];
$inspectorID = $_POST['value6'];
$inspectorName = $_POST['value7'];
$purchaserID = $_POST['value8'];
$purchaserName = $_POST['value9'];
$address = $_POST['value10'];

$sql = "insert into store(storeID,name,address) values ('$storeID','$storeName','$address')";
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法添加数据: ' . mysqli_error($conn));
}
mysqli_commit($conn);
//判断manager是否符合外码约束
if ($managerID != null){
    $sql = "select name from manager where managerID = $managerID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == null) {
        $sql = "insert into manager(managerID,name,sex,salary,storeID) values ('$managerID','$managerName',null,0,'$storeID')";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
    }
    else{
        if ($row['name'] != $managerName){
            echo("Foreign key don't match!");
            return;
        }
    }
}
//判断deputymanager是否符合外码约束
if ($deputymanagerID != null){
    $sql = "select name from deputymanager where deputymanagerID = $deputymanagerID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == null) {
        $sql = "insert into deputymanager(deputymanagerID,name,sex,salary,storeID) values ('$deputymanagerID','$deputymanagerName',null,0,'$storeID')";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
    }
    else{
        if ($row['name'] != $deputymanagerName){
            echo("Foreign key don't match!");
            return;
        }
    }
}
//判断inspector是否符合外码约束
if ($inspectorID != null){
    $sql = "select name from inspector where inspectorID = $inspectorID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == null) {
        $sql = "insert into inspector(inspectorID,name,sex,salary) values ('$inspectorID','$inspectorName',null,0)";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
        $sql = "insert into inspect(inspectorID,storeID,income) values ('$inspectorID','$storeID',0)";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
    }
    else{
        if ($row['name'] != $inspectorName){
            echo("Foreign key don't match!");
            return;
        }
    }
}
//判断purchaser是否符合外码约束
if ($purchaserID != null){
    $sql = "select name from purchaser where purchaserID = $purchaserID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == null) {
        $sql = "insert into purchaser(purchaserID,name,sex,salary) values ('$purchaserID','$purchaserName',null,0)";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
        $sql = "insert into purchase(purchaserID,storeID) values ('$purchaserID','$storeID')";
        $result = mysqli_query($conn,$sql);
        if(! $result )
        {
            die('无法添加数据: ' . mysqli_error($conn));
        }
    }
    else{
        if ($row['name'] != $purchaserName){
            echo("Foreign key don't match!");
            return;
        }
    }
}

mysqli_commit($conn);
echo("Insert successful!");
mysqli_close($conn);