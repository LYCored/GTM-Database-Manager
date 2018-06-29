<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/24
 * Time: 23:36
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

$insGood0 = $_POST['value0'];
$insGood1 = $_POST['value1'];
$insGood2 = $_POST['value2'];
$insGood3 = $_POST['value3'];
$insGood4 = $_POST['value4'];

$sql = "insert into good(goodID,name,brand,kind,price,supplierID) values (\"$insGood0\",\"$insGood1\",\"$insGood2\",\"$insGood3\",$insGood4,null)";

mysqli_select_db($conn,'multipleshop');
$result = mysqli_query($conn,$sql);

if(! $result )
{
    die('无法添加数据: ' . mysqli_error($conn));
}
/*else {
    echo("Insert success!");
}*/

mysqli_commit($conn);
echo("Insert successful!");
mysqli_close($conn);