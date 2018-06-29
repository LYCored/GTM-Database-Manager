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

    <link rel="stylesheet" type="text/css" href="css/list.css"/>
    <link rel="stylesheet" type="text/css" href="css/manhuaDate.1.0.css"/>
    <script type="text/javascript" src="js/jquery-1.5.1.js"></script><!--日期控件，JS库版本不能过高否则tab会失效-->
    <script type="text/javascript" src="js/datejs.js"></script>
    <script type="text/javascript" src="js/ui.tab.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var tab = new $.fn.tab({
                tabList:"#demo1 .ui-tab-container .ui-tab-list li",
                contentList:"#demo1 .ui-tab-container .ui-tab-content"
            });
            var tab = new $.fn.tab({
                tabList:"#demo1 .ui-tab-container .ui-tab-list2 li",
                contentList:"#demo1 .ui-tab-container .ui-tab-content2"
            });
        });
    </script>
    <script type="text/javascript">
        $(function (){
            $("input.mh_date").datejs({
                Event : "click",//可选
                Left : 0,//弹出时间停靠的左边位置
                Top : -16,//弹出时间停靠的顶部边位置
                fuhao : "-",//日期连接符默认为-
                isTime : false,//是否开启时间值默认为false
                beginY : 2010,//年份的开始默认为1949
                endY :2015//年份的结束默认为2049
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $("#selectList").find(".more").toggle(function(){
                $(this).addClass("more_bg");
                $(".more-none").show()
            },function(){
                $(this).removeClass("more_bg");
                $(".more-none").hide()
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var taboy_box=$(".lefttable-list");
            taboy_box.children("tbody").find("tr:gt(2)").hide();
            $(".leftbox-morea").toggle(function(){
                    $(this).parent().prev().find("tr").show();
                    $(this).addClass("more-i")
                },function(){
                    $(this).removeClass("more-i");
                    $(this).parent().prev().children("tbody").find("tr:gt(2)").hide();
                }
            );
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#edit").click(function () {
                $(this).hide("slow");
                $("#done").show("slow");
                $("th.firstRow").after("<th><button>添加</button></th>").next().children().addClass("addButton");
                var lastCol = $("td.lastCol");
                lastCol.after("<td><button>删除</button></td>").next().addClass("delCell").children().addClass("delButton");
                var updateCells = lastCol.parents("table").find("td").not(".key").not(".delCell");
                lastCol.parents("table").find(".key").click(function () {
                    alert("编号是数据库的重要标识，请勿改动！");
                });
                updateCells.click(function () {
                    $(this).attr("contenteditable","true");
                    $(this).mouseleave(function () {
                        $(this).attr("contenteditable","false");
                        var key = $(this).parent().children(".key").text();
                        var col = $(this).attr("class");
                        var newValue = $(this).text();
                        $.post("employerUpdate.php",
                            {
                                key: key,
                                col: col,
                                value: newValue
                            },
                            function (data, status) {
                                if (!status){
                                    alert("Error: post is fail!")
                                }
                                else {
                                    alert(data);
                                }
                            });
                        $(this).unbind("mouseleave");
                    });
                });
                //添加添加按钮监听器
                $("button.addButton").click(function () {
                    var firstRow = $(this).parents("div").next().find("tr").first();
                    firstRow.before(
                        "<tr class='newRow'><td width='20%' contenteditable='true'></td><td width='20%' contenteditable='true'></td><td width='20%' contenteditable='true'></td>"
                        + "<td width='20%' contenteditable='true'></td><td width='20%' contenteditable='true'></td><td><button class='okButton'>确认</button></td></tr>");
                    firstRow.prev().find("button").addClass("okButton");
                    $("button.okButton").click(function (){
                        $(this).css({"background-color":"#4CAF50","color":"white"});
                        var newAttr = firstRow.prev().children();
                        newAttr.attr("contenteditable","false");
                        var tag = newAttr.first();
                        var newValue = new Array();
                        for (var i = 0; i < 5; i++){
                            newValue[i] = tag.text();
                            tag = tag.next();
                        }
                        $.post("employerInsert.php",
                            {
                                value0: newValue[0],
                                value1: newValue[1],
                                value2: newValue[2],
                                value3: newValue[3],
                                value4: newValue[4]
                            },
                            function (data, status) {
                                if (!status){
                                    alert("Error: post is fail!")
                                }
                                else {
                                    alert(data);
                                }
                            });
                    });
                });
                //添加删除按钮监听器
                $("button.delButton").click(function () {
                    var key = $(this).parents("tr").children(".key").text();
                    $.post("employerDelete.php",
                        {
                            value: key
                        },
                        function (data, status) {
                            if (!status){
                                alert("Error: post is fail!")
                            }
                            else {
                                alert(data);
                            }
                        });
                    $(this).parents("tr").hide();
                });
            });
            $("#done").click(function () {
                $(this).hide("slow");
                $("#edit").show("slow");
                $("th.firstRow").next().remove();
                $("td.lastCol").next().remove();
                $("div.codrops-content").empty().load("employerSearch.php");
                //todo
            });
        });
    </script>
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

    <div class="w1200">
        <div class="list-screen">
            <div style="padding:10px 30px 10px 10px;"><div class="screen-address">
                    <div class="screen-term">
                        <div class="selectNumberScreen">
                            <div id="selectList" class="screenBox screenBackground">
                                <dl class="listIndex">
                                    <dt>工资</dt>
                                    <dd>
                                        <label><a href="javascript:">不限</a></label>
                                        <label>
                                            <input name="radio2" type="radio" value="" />
                                            <a href="javascript:">3000元以下</a></label>
                                        <label>
                                            <input name="radio2" type="radio" value="" />
                                            <a href="javascript:">3000-4000元</a></label>
                                        <label>
                                            <input name="radio2" type="radio" value="" />
                                            <a href="javascript:">4000-5000元</a></label>
                                        <label>
                                            <input name="radio2" type="radio" value="" />
                                            <a href="javascript:">5000元以上</a></label>
                                        <div class="custom"><span>自定义</span>&nbsp;
                                            <input name="" type="text" id="custext1"/>
                                            &nbsp;-&nbsp;
                                            <input name="" type="text" id="custext2"/>
                                            <input name="" type="button" id="cusbtn" value="Search" style="background-color:#f60;border-radius: 20px/50px; color: white"/>
                                        </div>
                                    </dd>
                                </dl>
                                <dl class=" listIndex">
                                    <dt>性别</dt>
                                    <dd>
                                        <label><a href="javascript:">不限</a> </label>
                                        <label>
                                            <input name="radio3" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">男</a> </label>
                                        <label>
                                            <input name="radio3" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">女</a></label>
                                    </dd>
                                </dl>
                                <dl class="listIndex">
                                    <dt>所属</dt>
                                    <dd>
                                        <label><a href="javascript:">不限</a></label>
                                        <label>
                                            <input name="radio4" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">巴蜀</a></label>
                                        <label>
                                            <input name="radio4" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">北方</a> </label>
                                        <label>
                                            <input name="radio4" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">江东</a> </label>
                                        <label>
                                            <input name="radio4" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">江南</a></label>
                                        <label>
                                            <input name="radio4" type="radio" value="" autocomplete="off"/>
                                            <a href="javascript:">中原</a></label>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="hasBeenSelected clearfix">
                    <div style="float:right;" class="eliminateCriteria">【清空全部】 </div>
                    <dl>
                        <dt>已选条件：</dt>
                        <dd style="DISPLAY: none" class=clearDd>
                            <div class=clearList></div>
                    </dl>
                </div>
                <script type="text/javascript" src="js/employerShaixuan.js"></script>
            </div>
        </div>

    <div class="content-wrap">
        <div class="content">
            <header class="codrops-header">
                <p><span>员工数据库</span>
                    <span id="edit" style="color: #118ecc; float:right; cursor: pointer">edit</span>
                    <span id="done" style="color: limegreen; float:right; cursor: pointer; display: none">done</span>
                </p>
            </header>
            <div class="codrops-content">
                <?php
                mysqli_query($conn, "set names utf8");
                $sql = "SELECT salespersonID,salesperson.name AS name1,sex,salary,store.name AS name2 FROM salesperson,store WHERE salesperson.storeID = store.storeID";
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
                ?>
            </div>
        </div>
    </div><!-- /content-wrap -->

        <div style="height: 80px"></div>

    <script src="js/classie.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
