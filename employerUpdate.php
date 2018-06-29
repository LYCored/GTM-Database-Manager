<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/26
 * Time: 18:54
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
$col = $_POST['col'];
$value = $_POST['value'];

if ($col == "col2")
    $col = "name";
else if ($col == "col3")
    $col = "sex";
else if ($col == "col4")
    $col = "salary";
else if ($col == "lastCol")
    $col = "storeID";

if($col == "storeID"){
    $sql = "select storeID from store where store.name = '$value'";
    $result = mysqli_query($conn,$sql);
    if(! $result ){
        die('无法更新数据: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $value = $row['storeID'];
}

$sql = "update salesperson set $col = \"" . $value . "\" where salespersonID = " . $key;

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