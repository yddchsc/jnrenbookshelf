<!doctype html>
<html>
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width,initial=1.0" charset="utf-8" >
  <!--保持页面原有尺寸，将页面调整为设备的可视浏览器空间-->
  <meta name="author" content="LY">
  <title>网联书架—首页</title>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="css/menu.css" media="screen" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../jss/dependents/bootstrap/css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <style type="text/css">
    @viewport{
     width: extend-to-zoom 100%;
     zoom:1.0;
   }
   body{
    background-image: url(images/5.jpg);
  }
  .body-fluid{
    width: auto;
    height: 498px;
    text-align:center;
  }
  .body-fluid h1{
    color:#DCDCDC;
    font-family: "Microsoft YaHei" ! important;
    font-size: 72px;
    position: relative;
    top: 40px;
  }
  a:hover, a:focus {
    color: #c9376e !important; 
    text-decoration: none;
  }
  .menu > li{
    width: 20%;
  }
</style>
</head>
<body>
  <div class="header">
    <ul class="menu boxed clearfix">
      <li><a href="index.php"><i class="menu-icon menu-icon-1"></i>首页</a></li>
      <li><a href="search.php?bookname= &search=查找"><i class="menu-icon menu-icon-5"></i>书架</a></li>
      <li><a href="control.php"><i class="menu-icon menu-icon-4"></i>管理</a></li>
      <li><a href="login.html"><i class="menu-icon menu-icon-8"></i>登录</a></li>
      <li><a href="contact.php"><i class="menu-icon menu-icon-6"></i>联系我们</a></li>
    </ul>
  </div>
  <div class="body-fluid">
    <div class="container-fluid">
     <h1>欢迎来到网联书架</h1>
     <div class="search" style="margin:100px 0">
      <i> </i>
      <div class="s-bar">
        <form action="search.php" method="get">
          <input type="text" name="bookname"  value="请输入书名" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '请输入书名';}">
          <input type="submit"  value="查找"/>
        </form>
      </div>
      <p>输入" "（空格）查找全部</p>
    </div>
  </div>
</div>
<script type="text/javascript" src="../../../jss/dependents/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>