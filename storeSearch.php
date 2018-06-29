<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/25
 * Time: 22:00
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

//刷新页面需更新各项筛选条件
$storeAddress = "";

if (isset($_SESSION['storeAddress'])){
    $storeAddress = $_SESSION['storeAddress'];
}

//sql查询
mysqli_query($conn, "set names utf8");
if ($storeAddress != ""){
    $sql = "SELECT store.storeID,store.name AS name1,manager.managerID,manager.name AS name2,deputymanager.deputymanagerID,deputymanager.name AS name3,inspector.inspectorID,inspector.name AS name4,purchaser.purchaserID,purchaser.name AS name5,address ".
        "FROM store,manager,deputymanager,inspector,inspect,purchaser,purchase ".
        "WHERE store.storeID = manager.storeID and store.storeID = deputymanager.storeID and store.storeID = inspect.storeID ".
        "and inspect.inspectorID = inspector.inspectorID and store.storeID = purchase.StoreID and purchase.purchaserID = purchaser.purchaserID and address = \"$storeAddress\"";
}
else {
    $sql = "SELECT store.storeID,store.name AS name1,manager.managerID,manager.name AS name2,deputymanager.deputymanagerID,deputymanager.name AS name3,inspector.inspectorID,inspector.name AS name4,purchaser.purchaserID,purchaser.name AS name5,address ".
        "FROM store,manager,deputymanager,inspector,inspect,purchaser,purchase ".
        "WHERE store.storeID = manager.storeID and store.storeID = deputymanager.storeID and store.storeID = inspect.storeID ".
        "and inspect.inspectorID = inspector.inspectorID and store.storeID = purchase.StoreID and purchase.purchaserID = purchaser.purchaserID";
}
//根据查询结果绘制表格
mysqli_select_db($conn,'multipleshop');
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}
echo '<link rel="stylesheet" type="text/css" href="css/demo.css" />';
echo '<div>';
echo '<div><table style="margin-left: auto; margin-right: auto; width: 950px; border-style: solid solid none; border-width: medium;">'.
    '<tr bgcolor="aqua" style="height: 40px"><th width="9%">店铺编号</th>'.
    '<th width="9%">店铺名称</th><th width="9%">经理编号</th><th width="9%">经理姓名</th>'.
    '<th width="9%">副经理编号</th><th width="9%">副经理</th><th width="9%">检查员编号</th><th width="9%">检查员姓名</th>'.
    '<th width="9%">进货员编号</th><th width="9%">进货员姓名</th><th class="firstRow" width="10%">地址</th></tr></table></div>';
echo '<div><table style="margin-left: auto; margin-right: auto; width: 950px; border-style: none solid solid; border-width: medium;">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr style=\"height: 40px\"><td class='key' width='9%'>".$row['storeID']."</td> ".
        "<td class='col2' width='9%'>".$row['name1']."</td> ".
        "<td class='col3' width='9%'>".$row['managerID']."</td> ".
        "<td class='col4' width='9%'>".$row['name2']."</td> ".
        "<td class='col5' width='9%'>".$row['deputymanagerID']."</td> ".
        "<td class='col6' width='9%'>".$row['name3']."</td> ".
        "<td class='col7' width='9%'>".$row['inspectorID']."</td> ".
        "<td class='col8' width='9%'>".$row['name4']."</td> ".
        "<td class='col9' width='9%'>".$row['purchaserID']."</td> ".
        "<td class='col10' width='9%'>".$row['name5']."</td> ".
        "<td class='lastCol' width='10%'>".$row['address']."</td> ".
        "</tr>";
}
echo '</table></div></div>';
mysqli_close($conn);