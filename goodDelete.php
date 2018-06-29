<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/23
 * Time: 22:31
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

$sql = "delete from good where goodID = " . $_POST['value'];
mysqli_select_db($conn,'multipleshop');

$result = mysqli_query($conn,$sql);

if(! $result )
{
    die('无法删除数据: ' . mysqli_error($conn));
}
/*else {
    echo("Delete success!");
}*/

mysqli_commit($conn);
echo("Delete success!");
mysqli_close($conn);