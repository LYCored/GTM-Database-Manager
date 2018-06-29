<!doctype html>
<html>
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

<style>
    body {
        background: #FFFFFF url("img/LoginBackground.jpg") no-repeat fixed top;
        background-size: 100% auto;
    }
    .wrapper {
        margin: 160px auto auto;
        width: 884px;
    }
    .loginBox {
        background-color: #F0F4F6;
        /*上divcolor*/
        border: 1px solid #BfD6E1;
        border-radius: 5px;
        color: #444;
        font: 14px 'Microsoft YaHei', '微软雅黑';
        margin: 0 auto;
        width: 360px
    }
    .loginBox .loginBoxCenter {
        border-bottom: 1px solid #DDE0E8;
        padding: 24px;
    }
    .loginBox .loginBoxCenter p {
        margin-bottom: 10px
    }
    .loginBox .loginBoxButtons {
        /*background-color: #F0F4F6;*/
        /*下divcolor*/
        border-top: 0 solid #FFF;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        line-height: 28px;
        overflow: hidden;
        padding: 20px 24px;
        vertical-align: center;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
    }
    .loginBox .loginInput {
        border: 1px solid #D2D9dC;
        border-radius: 2px;
        color: #444;
        font: 12px 'Microsoft YaHei', '微软雅黑';
        padding: 8px 14px;
        margin-bottom: 8px;
        width: 310px;
    }
    .loginBox .loginInput:FOCUS {
        border: 1px solid #B7D4EA;
        box-shadow: 0 0 8px #B7D4EA;
    }
    .loginBox .loginBtn {
        background-image: -moz-linear-gradient(to bottom, blue, #85CFEE);
        border: 1px solid #98CCE7;
        border-radius: 20px;
        box-shadow: inset rgba(255, 255, 255, 0.6) 0 1px 1px, rgba(0, 0, 0, 0.1) 0 1px 1px;
        color: #444;
        /*登录*/
        cursor: pointer;
        float: right;
        font: bold 13px Arial;
        padding: 10px 50px;
    }
    .loginBox .loginBtn:HOVER {
        background-image: -webkit-linear-gradient(bottom, blue, #85CFEE);
        background-image: -o-linear-gradient(bottom, blue, #85CFEE);
        background-image: linear-gradient(to top, blue, #85CFEE);
    }
    .loginBox a.forgetLink {
        color: #ABABAB;
        cursor: pointer;
        float: right;
        font: 11px/20px Arial;
        text-decoration: none;
        vertical-align: middle;/*忘记密码*/
    }
    .loginBox a.forgetLink:HOVER {
        color: #000000;
        text-decoration: none;/*忘记密码*/
    }
    .loginBox input#remember {
        vertical-align: middle;
    }
    .loginBox label[for="remember"] {
        font: 11px Arial;
    }
</style>

<body>
<div class="menu-wrap">
    <nav class="menu">
        <div class="icon-list">
            <a href="good.php"><i class="fa fa-fw fa-star-o"></i><span>Goods</span></a>
            <a href="store.php"><i class="fa fa-fw fa-bell-o"></i><span>Stores</span></a>
            <a href="employer.php"><i class="fa fa-fw fa-envelope-o"></i><span>Employers</span></a>
            <a href="salerecord.php"><i class="fa fa-fw fa-bar-chart-o"></i><span>Sale Record</span></a>
            <a href="purchaserecord.php"><i class="fa fa-fw fa-newspaper-o"></i><span>Purchase Record</span></a>
            <a href="changepswdPage.php"><i class="fa fa-fw fa-comment-o"></i><span>Change Password</span></a>
        </div>
    </nav>

    <button class="close-button" id="close-button">Close Menu</button>
</div>
<button class="menu-button" id="open-button">Open Menu</button>

<div class="wrapper">
    <form action="changePassword.php" method="post">
        <div class="loginBox">
            <div class="loginBoxCenter">
                <p>
                    <label for="oldpassword">请输入旧密码：</label>
                </p>
                <!--autofocus 规定当页面加载时按钮应当自动地获得焦点。 -->
                <!-- placeholder提供可描述输入字段预期值的提示信息-->
                <p>
                    <input type="text" id="oldpassword" name="oldpassword" class="loginInput" autofocus required="required" autocomplete="off" placeholder="旧密码"/>
                </p>
                <!-- required 规定必需在提交之前填写输入字段-->
                <p>
                    <label for="newpassword">请输入新密码：</label>
                </p>
                <p>
                    <input type="password" id="newpassword" name="newpassword" class="loginInput" required="required" placeholder="新密码"/>
                </p>
                <p>
                    <label for="ensurepassword">请确认新密码：</label>
                </p>
                <p>
                    <input type="password" id="ensurepassword" name="ensurepassword" class="loginInput" required="required" placeholder="新密码"/>
                </p>
            </div>
            <div class="loginBoxButtons">
                <button class="loginBtn">修改</button>
            </div>
        </div>
    </form>
</div>
<script src="js/classie.js"></script>
<script src="js/main.js"></script>
</body>
</html>