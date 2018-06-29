<?php session_start(); ?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>数据库系统</title>
    <link rel="icon" type="image/x-icon" href="icon/title.ico" />

    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/menu_sideslide.css" />
    <!--[if IE]>
    <script src="js/html5.js"></script>
    <![endif]-->
    <link href="css/leftstyle.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js"></script>
</head>

<body>

<?php
if (isset($_SESSION['server']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $conn = mysqli_connect($_SESSION['server'],$_SESSION['username'],$_SESSION['password']);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        header("location:index.php");
    }
}
else
    die("error!");
?>

<div class="wrapper">
    <div class="header-wrap">
        <p class="header-content">GTU连锁店管理系统</p>
    </div>

    <div class="menu-wrap">
        <nav class="menu">
            <div class="icon-list">
                <a href="good.php"><i class="fa fa-fw fa-star-o"></i><span>Goods</span></a>
                <a href="store.php"><i class="fa fa-fw fa-bell-o"></i><span>Stores</span></a>
                <a href="employer.php"><i class="fa fa-fw fa-envelope-o"></i><span>Employers</span></a>
                <a href="supplier.php"><i class="fa fa-fw fa-comment-o"></i><span>Suppliers</span></a>
                <a href="salerecord.php"><i class="fa fa-fw fa-bar-chart-o"></i><span>Sale Record</span></a>
                <a href="purchaserecord.php"><i class="fa fa-fw fa-newspaper-o"></i><span>Purchase Record</span></a>
            </div>
        </nav>

        <button class="close-button" id="close-button">Close Menu</button>
    </div>

    <button class="menu-button" id="open-button">Open Menu</button>

    <div class="filter-wrap">
        <p class="fillter">

        </p>
    </div>

    <div class="content-wrap">
        <div class="content">
            <header class="codrops-header">
                数据库
            </header>
            <div class="codrops-content">
                <?php
                mysqli_query($conn, "set names utf8");
                $sql = "SELECT sRecordID,salespersonID,name,price,date FROM salerecord,salesperson WHERE salerecord.salespersonID = salesperson.salespersonID";
                mysqli_select_db($conn,'multipleshop');
                $result = mysqli_query($conn,$sql);
                if(! $result )
                {
                    die('无法读取数据: ' . mysqli_error($conn));
                }
                echo '<table align="center" width="700" border="1" ><tr bgcolor="aqua"><th width="20%">记录编号</th>'.
                    '<th width="20%">售货员编号</th><th width="20%">售货员姓名</th><th width="20%">售价</th><th width="20%">日期</th></tr></table>';
                echo '<div style="height: 540px;width: 100%;overflow: auto;"><table align="center" width="700" border="1" >';
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<tr><td width='20%'>".$row['sRecordID']."</td> ".
                        "<td width='20%'>".$row['salespersonID']."</td> ".
                        "<td width='20%'>".$row['name']."</td> ".
                        "<td width='20%'>".$row['price']."</td> ".
                        "<td width='20%'>".$row['date']."</td> ".
                        "</tr>";
                }
                echo '</table></div>';
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div><!-- /content-wrap -->

    <script src="js/classie.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
