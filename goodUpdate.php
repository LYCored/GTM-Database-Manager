<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/25
 * Time: 15:40
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

$key = $_POST['key'];
$col = $_POST['col'];
$value = $_POST['value'];

if ($col == "col2")
    $col = "name";
else if ($col == "col3")
    $col = "brand";
else if ($col == "col4")
    $col = "kind";
else if ($col == "lastCol")
    $col = "price";

$sql = "update good set $col = \"" . $value . "\" where goodID = " . $key;

mysqli_select_db($conn,'multipleshop');
$result = mysqli_query($conn,$sql);

if(! $result )
{
    die('无法更新数据: ' . mysqli_error($conn));
}
/*else {
    echo("Update success!");
}*/

mysqli_commit($conn);
echo("Update success!");
mysqli_close($conn);