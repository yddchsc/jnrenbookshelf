<?php
if(!isset($_COOKIE['username'])){
	header("Location: login.html");
}
else{
	$username=$_COOKIE['username'];
	$password=$_COOKIE['password'];
	include("connection.php");
	$result=mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$password'",$conn);
	if(!$result)
		header("Location: login.html");
}
$keyword=$_GET["booknumber"];
include("connection.php");
if ($keyword == " ")
	$sql=mysql_query("SELECT * from book");  
else
	$sql=mysql_query("SELECT * from book where booknumber='$keyword'");
if($sql==false){
	echo "<script>alert('亲……臣妾找不到啊……');history.go(-1);</script>";
} 
else{
	$res=mysql_fetch_array($sql);
	?>
	<!doctype html>
	<html>
	<head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width,initial=1.0" charset="utf-8" >
		<!--保持页面原有尺寸，将页面调整为设备的可视浏览器空间-->
		<meta name="author" content="LY">
		<title>书籍管理</title>
		<link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css">
		<link href="http://www.francescomalagrino.com/BootstrapPageGenerator/3/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
		<!--<link rel="stylesheet" type="text/css" href="wlsj.css">-->
		<link href="css/menu.css" media="screen" rel="stylesheet">
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<!-- jQuery -->
		<script type="text/javascript" src="../../../jss/dependents/jquery/jquery.min.js"></script>
		<!-- bootstrap -->
		<script type="text/javascript" src="../../../jss/dependents/bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../../../jss/dependents/bootstrap/css/bootstrap.min.css" />
<!--[if lt IE 9]>
	<script src="../../../jss/dependents/bootstrap/plugins/ie/html5shiv.js"></script>
	<script src="../../../jss/dependents/bootstrap/plugins/ie/respond.js"></script>
	<![endif]-->
<!--[if lt IE 8]>
	<script src="../../../jss/dependents/bootstrap/plugins/ie/json2.js"></script>
	<![endif]-->
	<!-- font-awesome -->
	<link rel="stylesheet" type="text/css" href="../../../jss/dependents/fontAwesome/css/font-awesome.min.css" media="all" />
	<!-- dtGrid -->
	<script type="text/javascript" src="../../../jss/jquery.dtGrid.js"></script>
	<script type="text/javascript" src="../../../jss/i18n/en.js"></script>
	<script type="text/javascript" src="../../../jss/i18n/zh-cn.js"></script>
	<link rel="stylesheet" type="text/css" href="../../../jss/jquery.dtGrid.css" />
	<!-- datePicker -->
	<script type="text/javascript" src="../../../jss/dependents/datePicker/WdatePicker.js" defer="defer"></script>
	<link rel="stylesheet" type="text/css" href="../../../jss/dependents/datePicker/skin/WdatePicker.css" />
	<link rel="stylesheet" type="text/css" href="../../../jss/dependents/datePicker/skin/default/datepicker.css" />
	<style type="text/css">
		html, body {
			margin: 0;
			padding: 0;
			background-color: #F2F2F2;
			font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
		}
		.menu > li{
			width: 25%;
		}
		a:hover, a:focus {
			color: #c9376e !important; 
			text-decoration: none;
		}
		form{
			padding: 0;
			margin: 0 5px;
			float: left;
		}
		.fa-fw {
			width: 1.28571429em;
			text-align: center;
		}
		.fa-li {
			position: absolute;
			left: -2.14285714em;
			width: 2.14285714em;
			top: 0.14285714em;
			text-align: center;
		}
		.fa-stack-2x {
			position: absolute;
			left: 0;
			width: 100%;
			text-align: center;
		}
	</style>
</head>
<body>
	<ul class="menu boxed clearfix">
		<li><a href="index.php"><i class="menu-icon menu-icon-1"></i>首页</a></li>
		<li><a href="control.php"><i class="menu-icon menu-icon-4"></i>管理</a></li>
		<li><a href="info.php"><i class="menu-icon menu-icon-9"></i>借阅登记</a></li>
		<li><a href="add.php"><i class="menu-icon menu-icon-9"></i>添加书籍</a></li>
	</ul>
	<script type="text/javascript">
	//映射内容
	var status1 = {0:'已借出', 1:'可借阅'};
	var type1 = {1:'小学', 2:'初中', 3:'高中', 4:'中专', 5:'大学', 6:'硕士', 7:'博士', 8:'其他'};
	var datas = new Array();
	<?php
	do{
		echo "var book = new Object();
		book.booknumber = '".$res['booknumber']."';
		book.bookname = '".$res['bookname']."';
		book.author = '".$res['author']."';
		book.status1 = ".$res['status'].";
		book.type1 = ".$res['type'].";
		datas.push(book);
		";
	}while($res=mysql_fetch_array($sql));
}
?>
var dtGridColumns_2_1_2 = [
{id:'booknumber', title:'书号', type:'string', columnClass:'text-center'},
{id:'bookname', title:'书名', type:'string', columnClass:'text-center'},
{id:'author', title:'作者', type:'string', columnClass:'text-center', hideType:'md|sm|xs'},
{id:'type1', title:'类型', type:'string', codeTable:type1, columnClass:'text-center', hideType:'sm|xs'},
{id:'status1', title:'状态', type:'string', codeTable:status1, columnClass:'text-center', resolution:function(value, record, column, grid, dataNo, columnNo){
	var content = '';
	if(value==1){
		content += '<span style="background:#00a2ca;padding:2px 10px;color:white;">可借阅</span>';
	}else{
		content += '<span style="background:#c447ae;padding:2px 10px;color:white;">已借出</span>';
	}
	return content;
}},
{id:'operation', title:'操作', type:'string', columnClass:'text-center', resolution:function(value, record, column, grid, dataNo, columnNo){
	var content = '';
	content += '<form action="bookchange.php" method="post"><input type="hidden" name="bookname" value="'+record.bookname+'"/><input type="hidden" name="booknumber" value="'+record.booknumber+'"/><input type="hidden" name="author" value="'+record.author+'"/><input type="hidden" name="type" value="'+record.type1.toString()+'"/><input type="hidden" name="status" value="'+record.status1.toString()+'"/><button class="btn btn-xs btn-default" type="submit"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button></form>';
	content += '&nbsp;&nbsp;';
	content += '<form action="bookdel.php" method="post"><input type="hidden" name="booknumber" value="'+record.booknumber+'"/><button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;删除</button></form>';
	return content;
}}

];
var dtGridOption_2_1_2 = {
	lang : 'zh-cn',
	ajaxLoad : false,
	exportFileName : '书籍列表',
	datas : datas,
	columns : dtGridColumns_2_1_2,
	gridContainer : 'dtGridContainer_2_1_2',
	toolbarContainer : 'dtGridToolBarContainer_2_1_2',
	tools : '',
	pageSize : 10,
	pageSizeLimit : [10, 20, 50]
};
var grid_2_1_2 = $.fn.DtGrid.init(dtGridOption_2_1_2);
$(function(){
	grid_2_1_2.load();
});
</script>
<p><h4>搜索结果：<h4></p>
<div id="dtGridContainer_2_1_2" class="dt-grid-container"></div>
<div id="dtGridToolBarContainer_2_1_2" class="dt-grid-toolbar-container"></div>
</body>
</html>