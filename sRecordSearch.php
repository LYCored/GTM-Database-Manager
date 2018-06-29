<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/26
 * Time: 20:57
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
$sRecordPrice = "";
$sRecordName = "";
$sRecordDate1 = "";
$sRecordDate2 = "";
if (isset($_SESSION['sRecordPrice'])){
    if ($_SESSION['sRecordPrice'] == "100元以下")
        $sRecordPrice = "price < 100";
    else if ($_SESSION['sRecordPrice'] == "100-199元"){
        $sRecordPrice = "price >= 100 and price < 200";
    }
    else if ($_SESSION['sRecordPrice'] == "200-299元"){
        $sRecordPrice = "price >= 200 and price < 300";
    }
    else if ($_SESSION['sRecordPrice'] == "300元以上"){
        $sRecordPrice = "price >= 300";
    }
    else if (($index = strpos($_SESSION['sRecordPrice'],"-")) !== false){
        $sRecordPrice = "price >= " . substr($_SESSION['sRecordPrice'],0,$index) . " and price <= "
            . substr($_SESSION['sRecordPrice'],$index + 1, strlen($_SESSION['sRecordPrice']) - $index - 4);
    }
    else{
        $sRecordPrice = "";
    }
}

if (isset($_SESSION['sRecordName'])){
    $sRecordName = $_SESSION['sRecordName'];
}

if (isset($_SESSION['sRecordDate1']) && isset($_SESSION['sRecordDate2'])){
    //$sRecordDate1 = strtotime($_SESSION['sRecordDate1']);
    //$sRecordDate2 = strtotime($_SESSION['sRecordDate2']);
    $sRecordDate1 = $_SESSION['sRecordDate1'];
    $sRecordDate2 = $_SESSION['sRecordDate2'];
}
//sql查询
mysqli_query($conn, "set names utf8");
if ($sRecordPrice != ""){
    if ($sRecordName != ""){
        if ($sRecordDate1 != "" && $sRecordDate2 != ""){
            $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and $sRecordPrice and salesperson.name = \"$sRecordName\" and date >= \"$sRecordDate1\" and date <= \"$sRecordDate2\"";
        }
        else{
            $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and $sRecordPrice and salesperson.name = \"$sRecordName\"";
        }
    }
    else{
        if ($sRecordDate1 != "" && $sRecordDate2 != ""){
            $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and $sRecordPrice and date >= \"$sRecordDate1\" and date <= \"$sRecordDate2\"";
        }
        else{
            $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and $sRecordPrice";
        }
    }
}
else if ($sRecordName != ""){
    if ($sRecordDate1 != "" && $sRecordDate2 != ""){
        $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and salesperson.name = \"$sRecordName\" and date >= \"$sRecordDate1\" and date <= \"$sRecordDate2\"";
    }
    else{
        $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and salesperson.name = \"$sRecordName\"";
    }
}
else if ($sRecordDate1 != "" && $sRecordDate2 != ""){
    $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID and date >= \"$sRecordDate1\" and date <= \"$sRecordDate2\"";
}
else {
    $sql = "select sRecordID,saleRecord.salespersonID,salesperson.name,price,salerecord.date from salesperson,salerecord where salesperson.salespersonID = salerecord.salespersonID";
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
echo '<div><table style="margin-left: auto; margin-right: auto; width: 600px; border-style: solid solid none; border-width: medium;">'.
    '<tr bgcolor="aqua" style="height: 40px"><th width="20%">记录编号</th>'.
    '<th width="20%">售货员编号</th><th width="20%">售货员姓名</th><th width="20%">售价</th><th class="firstRow" width="20%">日期</th></tr></table></div>';
echo '<div>'.
    '<table style="margin-left: auto; margin-right: auto; width: 600px; border-style: none solid solid; border-width: medium;">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr style=\"height: 40px\"><td class='key' width='20%'>".$row['sRecordID']."</td> ".
        "<td class='col2' width='20%'>".$row['salespersonID']."</td> ".
        "<td class='col3' width='20%'>".$row['name']."</td> ".
        "<td class='col4' width='20%'>".$row['price']."</td> ".
        "<td class='lastCol' width='20%'>".$row['date']."</td> ".
        "</tr>";
}
echo '</table></div>';

mysqli_close($conn);