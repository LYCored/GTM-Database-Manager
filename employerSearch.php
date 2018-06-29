<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/26
 * Time: 16:46
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
$employerSalary = "";
$employerSex = "";
$employerStore = "";
if (isset($_SESSION['employerSalary'])){
    if ($_SESSION['employerSalary'] == "3000元以下")
        $employerSalary = "salary < 3000";
    else if ($_SESSION['employerSalary'] == "3000-4000元"){
        $employerSalary = "salary >= 3000 and salary < 4000";
    }
    else if ($_SESSION['employerSalary'] == "4000-5000元"){
        $employerSalary = "salary >= 4000 and salary < 5000";
    }
    else if ($_SESSION['employerSalary'] == "5000元以上"){
        $employerSalary = "salary >= 5000";
    }
    else if (($index = strpos($_SESSION['employerSalary'],"-")) !== false){
        $emp1oyerSalary = "salary >= " . substr($_SESSION['employerSalary'],0,$index) . " and salary <= "
            . substr($_SESSION['employerSalary'],$index + 1, strlen($_SESSION['employerSalary']) - $index - 4);
    }
    else{
        $employerSalary = "";
    }
}

if (isset($_SESSION['employerSex'])){
    $employerSex = $_SESSION['employerSex'];
}

if (isset($_SESSION['employerStore'])){
    $employerStore = $_SESSION['employerStore'];
}
//sql查询
mysqli_query($conn, "set names utf8");
if ($employerSalary != ""){
    if ($employerSex != ""){
        if ($employerStore != ""){
            //todo:sql语句！！！！！！！！！！！！！！！！！！！！！！！！！！！！！
            $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and $employerSalary and sex = \"$employerSex\" and store.name = \"$employerStore\"";
        }
        else{
            $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and $employerSalary and sex = \"$employerSex\"";
        }
    }
    else{
        if ($employerStore != ""){
            $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and $employerSalary and store.name = \"$employerStore\"";
        }
        else{
            $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and $employerSalary";
        }
    }
}
else if ($employerSex != ""){
    if ($employerStore != ""){
        $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and sex = \"$employerSex\" and store.name = \"$employerStore\"";
    }
    else{
        $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and sex = \"$employerSex\"";
    }
}
else if ($employerStore != ""){
    $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID and store.name = \"$employerStore\"";
}
else {
    $sql = "select salespersonID,salesperson.name as name1,sex,salary,store.name as name2 from salesperson,store where salesperson.storeID = store.storeID";
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
    '<tr bgcolor="aqua" style="height: 40px"><th width="20%">员工编号</th>'.
    '<th width="20%">姓名</th><th width="20%">性别</th><th width="20%">工资</th><th class="firstRow" width="20%">所属店铺</th></tr></table></div>';
echo '<div>'.
    '<table style="margin-left: auto; margin-right: auto; width: 600px; border-style: none solid solid; border-width: medium;">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr style=\"height: 40px\"><td class='key' width='20%'>".$row['salespersonID']."</td> ".
        "<td class='col2' width='20%'>".$row['name1']."</td> ".
        "<td class='col3' width='20%'>".$row['sex']."</td> ".
        "<td class='col4' width='20%'>".$row['salary']."</td> ".
        "<td class='lastCol' width='20%'>".$row['name2']."</td> ".
        "</tr>";
}
echo '</table></div></div>';

mysqli_close($conn);