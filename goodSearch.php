<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/23
 * Time: 13:18
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
$goodPrice = "";
$goodBrand = "";
$goodKind = "";
if (isset($_SESSION['goodPrice'])){
    if ($_SESSION['goodPrice'] == "100元以下")
        $goodPrice = "price < 100";
    else if ($_SESSION['goodPrice'] == "100-199元"){
        $goodPrice = "price >= 100 and price < 200";
    }
    else if ($_SESSION['goodPrice'] == "200-299元"){
        $goodPrice = "price >= 200 and price < 300";
    }
    else if ($_SESSION['goodPrice'] == "300元以上"){
        $goodPrice = "price >= 300";
    }
    else if (($index = strpos($_SESSION['goodPrice'],"-")) !== false){
        $goodPrice = "price >= " . substr($_SESSION['goodPrice'],0,$index) . " and price <= "
            . substr($_SESSION['goodPrice'],$index + 1, strlen($_SESSION['goodPrice']) - $index - 4);
    }
    else{
        $goodPrice = "";
    }
}

if (isset($_SESSION['goodBrand'])){
    $goodBrand = $_SESSION['goodBrand'];
}

if (isset($_SESSION['goodKind'])){
    $goodKind = $_SESSION['goodKind'];
}
//sql查询
mysqli_query($conn, "set names utf8");
if ($goodPrice != ""){
    if ($goodBrand != ""){
        if ($goodKind != ""){
            $sql = "select goodID,name,brand,kind,price from good where $goodPrice and brand = \"$goodBrand\" and kind = \"$goodKind\"";
        }
        else{
            $sql = "select goodID,name,brand,kind,price from good where $goodPrice and brand = \"$goodBrand\"";
        }
    }
    else{
        if ($goodKind != ""){
            $sql = "select goodID,name,brand,kind,price from good where $goodPrice and kind = \"$goodKind\"";
        }
        else{
            $sql = "select goodID,name,brand,kind,price from good where $goodPrice";
        }
    }
}
else if ($goodBrand != ""){
    if ($goodKind != ""){
        $sql = "select goodID,name,brand,kind,price from good where brand = \"$goodBrand\" and kind = \"$goodKind\"";
    }
    else{
        $sql = "select goodID,name,brand,kind,price from good where brand = \"$goodBrand\"";
    }
}
else if ($goodKind != ""){
    $sql = "select goodID,name,brand,kind,price from good where kind = \"$goodKind\"";
}
else {
    $sql = "select goodID,name,brand,kind,price from good";
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
    '<tr bgcolor="aqua" style="height: 40px"><th width="20%">商品编号</th>'.
    '<th width="20%">名称</th><th width="20%">品牌</th><th width="20%">种类</th><th class="firstRow" width="20%">价格</th></tr></table></div>';
echo '<div>'.
    '<table style="margin-left: auto; margin-right: auto; width: 600px; border-style: none solid solid; border-width: medium;">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr style=\"height: 40px\"><td class='key' width='20%'>".$row['goodID']."</td> ".
        "<td class='col2' width='20%'>".$row['name']."</td> ".
        "<td class='col3' width='20%'>".$row['brand']."</td> ".
        "<td class='col4' width='20%'>".$row['kind']."</td> ".
        "<td class='lastCol' width='20%'>".$row['price']."</td> ".
        "</tr>";
}
echo '</table></div></div>';

mysqli_close($conn);