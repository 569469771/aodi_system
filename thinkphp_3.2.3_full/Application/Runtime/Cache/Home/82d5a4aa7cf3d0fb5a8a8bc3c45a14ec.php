<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script language="javascript">
	function showtime()
	{
	var today,hour,second,minute,year,month,date;
	var strDate ;
	today=new Date();
	var n_day = today.getDay();
	switch (n_day)
	{
		case 0:{
		  strDate = "星期日"
		}break;
		case 1:{
		  strDate = "星期一"
		}break;
		case 2:{
		  strDate ="星期二"
		}break;
		case 3:{
		  strDate = "星期三"
		}break;
		case 4:{
		  strDate = "星期四"
		}break;
		case 5:{
		  strDate = "星期五"
		}break;
		case 6:{
		  strDate = "星期六"
		}break;
		case 7:{
		  strDate = "星期日"
		}break;
	}
	year = today.getFullYear();  //getYear();
	month = today.getMonth()+1;
	date = today.getDate();
	hour = today.getHours();
	minute =today.getMinutes();
	second = today.getSeconds();
	document.getElementById('time').innerHTML = year + "年" + month + "月" + date + "日" + strDate +" " + hour + ":" + minute + ":" + second; //显示时间
	setTimeout("showtime();", 1000); //设定函数自动执行时间为 1000 ms(1 s)
	}
</script>
<style type="text/css">

body,td,th {
	color: #000;
}
.topys01 {
	font-weight: bold;
	text-align: center;
	font-size: 14px;
}

.topys02 {
	text-align: right;
}
.topys03 {
	color: #F00;
	text-align: right;
	margin-top: -10px
}
.topys01 {
	font-size: 18px;
}
body {
	background-color: #CCC;
}
</style>
</head>

<body class="topys01">
<p class="topys01">奥迪斯丹-----包装公司后台系统 </p>
<p class="topys02">

<span id="time"></span>
<script language="javascript"> showtime();</script>
管理员-----<?php  echo $usname; ?></p>
<p class="topys03"> <a href="<?php echo PUB ; ?>Home/Login/latOut" target="_parent">退出登录 </a></p>
</body>
</html>