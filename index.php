<?php session_start(); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/x-icon" href="icon/title.ico"/>
<title>数据库系统——登录</title>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        function forgetPassword() {
            alert("请联系系统管理员找回密码。\nQQ：2367008157\n微信：1828099019");
        }
    </script>
    <!--<script type="text/javascript">
        $(document).ready(function(e) {
            var isChecked = $("#remeber").attr('checked');
            if (isChecked){
                $("#username").value = $("#username").text();
                $("#password").value = $("#password").text();
            }
        });
    </script>-->
</head>

<style>
body {
    background: #FFFFFF url("img/LoginBackground.jpg") no-repeat fixed top;
	background-size: 100% auto;
    overflow: hidden;
}
.wrapper {
	margin: 140px 50% 140px;
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
	width: 388px
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

</style>

<body>
<div class="wrapper">
  <form action="transmitUserInfor.php" method="post">
    <div class="loginBox">
      <div class="loginBoxCenter">
        <p>
          <label for="oldpassword">用户名：</label>
        </p>
        <!--autofocus 规定当页面加载时按钮应当自动地获得焦点。 -->
        <!-- placeholder提供可描述输入字段预期值的提示信息-->
        <p>
          <input type="text" id="username" name="username" class="loginInput" required="required" autocomplete="off" placeholder="请输入用户名"/>
        </p>
        <!-- required 规定必需在提交之前填写输入字段-->
        <p>
          <label for="newpassword">密码：</label>
        </p>
        <p>
          <input type="password" id="password" name="password" class="loginInput" required="required" placeholder="请输入密码"/>
        </p>
        <p><a class="forgetLink" onclick="forgetPassword()" style="position: relative; cursor: pointer; float: right">忘记密码?</a></p>
        <input id="remember" type="checkbox" name="remember" />
        <label for="remember">记住登录状态</label>
      </div>
      <div class="loginBoxButtons">
        <button class="loginBtn">登录</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>