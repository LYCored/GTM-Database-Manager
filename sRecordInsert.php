<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/26
 * Time: 23:18
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

$sql = "select name from salesperson where salespersonID = $ins1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if($row == null )
{
    $sql = "insert into salesperson(salespersonID,name,sex,salary,storeID) values ('$ins1','$ins2',null,0,null)";
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

$sql = "insert into salerecord(sRecordID,salespersonID,price,date) values ('$ins0','$ins1','$ins3','$ins4')";
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法添加数据: ' . mysqli_error($conn));
}

mysqli_commit($conn);
echo("Insert success!");
mysqli_close($conn);