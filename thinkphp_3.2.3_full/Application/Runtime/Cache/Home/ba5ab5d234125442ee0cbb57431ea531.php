<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<script src="<?php echo PUB; ?>Public/js/jquery-1.4.4.min.js"></script> 
</head>
<style type="text/css">
	div {
		text-align: center;
	}
</style>
<body>
<div>
<form id="form1" name="form1" method="post" action="<?php echo PUB; ?>Home/User/uadd/">
	所属公司：<select name="company_id" id="select2">
	<?php foreach($com as $co):?>
    <option <?php echo $info['company_id']== $co['id']?'selected=selected':''; ?> value="<?php echo $co['id']; ?>"><?php echo $co['company_name']; ?></option>
	<?php endforeach; ?>
    </select>
  <p>
    用户名：
    <input type="text" required="required" name="name" id="textfield" value="<?php echo $info['u_name']; ?>" />
  </p>
  <p>
    用户真名：
    <input required="required" type="text" name="full_name" id="textfield" required="required" value="<?php echo $info['full_name']; ?>" />
  </p>
  <p>
 
    密码：&nbsp;  
    <input type="password" name="psw1" id="textfield3" required="required" />
  </p>
  <p>
 
    重复密码：  
    <input type="password" name="psw2" id="textfield4" required="required" onblur='checktex();'/><span id='psw2' style='color:red;' >&nbsp; </span>
  </p>
  <p>
  所属工作组：
    <select name="group_id" id="select2">
	<?php foreach($gp as $gp1): ?>
		<option <?php echo $info['group_id']== $gp1['id']?'selected=selected':''; ?> value="<?php echo $gp1['id']; ?>"><?php echo $gp1['name']; ?></option>
	<?php endforeach; ?>	
    </select>
  </p>
  <p>
  是否是删除的：
    <select name="user_state" id="select2">
	
		<option <?php echo $info['user_state']== '0'?'selected=selected':''; ?> value='0'>删除的</option>
		<option value='1' <?php echo $info['user_state']!= '0'?'selected=selected':''; ?> >可用的</option>
		
    </select>
  </p>
  <p>
	<input type="submit" name="button" id="button" value="提交" />
    <input type="reset" name="button2" id="button2" value="重置" />
    
  </p>
</form>
</div>
<script type="text/javascript" >
	function checktex(){
		var psw1=$("#textfield3").val();
		var psw2=$("#textfield4").val();
		var str=psw2.match(/\d+\w+/g)
		if(psw1!=psw2 || psw1==null){
			$("#psw2").html('&nbsp;重复密码错误');
		}else{
		    $("#psw2").html('&nbsp;');
		}
		<!-- console.log(str); -->


	}
 

</script> 
</body>
</html>