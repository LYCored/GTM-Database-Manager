<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/27
 * Time: 10:06
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
$pRecordPrice = "";
$pRecordStore = "";
$pRecordAmount = "";
$pRecordSupplier = "";
$pRecordName = "";
if (isset($_SESSION['pRecordPrice'])){
    if ($_SESSION['pRecordPrice'] == "100元以下")
        $pRecordPrice = "and purchaserecord.price < 100";
    else if ($_SESSION['pRecordPrice'] == "100-199元"){
        $pRecordPrice = "and purchaserecord.price >= 100 and purchaserecord.price < 200";
    }
    else if ($_SESSION['pRecordPrice'] == "200-299元"){
        $pRecordPrice = "and purchaserecord.price >= 200 and purchaserecord.price < 300";
    }
    else if ($_SESSION['pRecordPrice'] == "300元以上"){
        $pRecordPrice = "and purchaserecord.price >= 300";
    }
    else if (($index = strpos($_SESSION['pRecordPrice'],"-")) !== false){
        $pRecordPrice = "and purchaserecord.price >= " . substr($_SESSION['pRecordPrice'],0,$index) . " and purchaserecord.price <= "
            . substr($_SESSION['pRecordPrice'],$index + 1, strlen($_SESSION['pRecordPrice']) - $index - 4);
    }
    else{
        $pRecordPrice = "";
    }
}

if (isset($_SESSION['pRecordStore'])){
    if ($_SESSION['pRecordStore'] != ""){
        $pRecordStore = $_SESSION['pRecordStore'];
        $pRecordStore = "and store.name = \"$pRecordStore\"";
    }
    else{
        $pRecordStore = "";
    }
}

if (isset($_SESSION['pRecordAmount'])){
    if ($_SESSION['pRecordAmount'] == "40件以下")
        $pRecordAmount = "and amount < 40";
    else if ($_SESSION['pRecordAmount'] == "40-59件"){
        $pRecordAmount = "and amount >= 40 and amount < 60";
    }
    else if ($_SESSION['pRecordAmount'] == "60-79件"){
        $pRecordAmount = "and amount >= 60 and amount < 80";
    }
    else if ($_SESSION['pRecordAmount'] == "80件以上"){
        $pRecordAmount = "and amount >= 80";
    }
    else if (($index = strpos($_SESSION['pRecordAmount'],"-")) !== false){
        $pRecordAmount = "and amount >= " . substr($_SESSION['pRecordAmount'],0,$index) . " and amount <= "
            . substr($_SESSION['pRecordAmount'],$index + 1, strlen($_SESSION['pRecordAmount']) - $index - 4);
    }
    else{
        $pRecordAmount = "";
    }
}

if (isset($_SESSION['pRecordSupplier'])){
    if ($_SESSION['pRecordSupplier'] != ""){
        $pRecordSupplier = $_SESSION['pRecordSupplier'];
        $pRecordSupplier = "and supplier.name = \"$pRecordSupplier\"";
    }
    else{
        $pRecordSupplier = "";
    }
}

if (isset($_SESSION['pRecordName'])){
    if ($_SESSION['pRecordName'] != ""){
        $pRecordName = $_SESSION['pRecordName'];
        $pRecordName = "and good.name = \"$pRecordName\"";
    }
    else{
        $pRecordName = "";
    }
}

//sql查询
mysqli_query($conn, "set names utf8");
$sql = "SELECT pRecordID,store.storeID,store.name AS name1,supplier.supplierID,supplier.name AS name2,good.goodID,good.name AS name3,purchaserecord.price,amount FROM purchaserecord,store,supplier,good WHERE purchaserecord.storeID = store.storeID and purchaserecord.supplierID = supplier.supplierID and purchaserecord.goodID = good.goodID $pRecordPrice $pRecordStore $pRecordAmount $pRecordSupplier $pRecordName";
//根据查询结果绘制表格
mysqli_select_db($conn,'multipleshop');
$result = mysqli_query($conn,$sql);
if(! $result )
{
    die('无法读取数据: ' . mysqli_error($conn));
}

echo '<link rel="stylesheet" type="text/css" href="css/demo.css" />';
echo '<div>';
echo '<div><table style="margin-left: auto; margin-right: auto; width: 900px; border-style: solid solid none; border-width: medium;">'.
    '<tr bgcolor="aqua" style="height: 40px"><th width="12%">记录编号</th>'.
    '<th width="11%">店铺编号</th><th width="11%">店铺名称</th><th width="11%">供应商编号</th><th width="11%">供应商名称</th>'
    .'<th width="11%">商品编号</th><th width="11%">商品名称</th><th width="11%">进价</th>'
    .'<th class="firstRow" width="11%">进货量</th></tr></table></div>';
echo '<div>'.
    '<table style="margin-left: auto; margin-right: auto; width: 900px; border-style: none solid solid; border-width: medium;">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr style=\"height: 40px\"><td class='key' width='12%'>".$row['pRecordID']."</td> ".
        "<td class='col2' width='11%'>".$row['storeID']."</td> ".
        "<td class='col3' width='11%'>".$row['name1']."</td> ".
        "<td class='col4' width='11%'>".$row['supplierID']."</td> ".
        "<td class='col5' width='11%'>".$row['name2']."</td> ".
        "<td class='col6' width='11%'>".$row['goodID']."</td> ".
        "<td class='col7' width='11%'>".$row['name3']."</td> ".
        "<td class='col8' width='11%'>".$row['price']."</td> ".
        "<td class='lastCol' width='11%'>".$row['amount']."</td> ".
        "</tr>";
}
echo '</table></div>';

mysqli_close($conn);