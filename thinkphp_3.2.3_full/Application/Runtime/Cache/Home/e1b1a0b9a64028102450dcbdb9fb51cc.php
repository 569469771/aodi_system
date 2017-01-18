<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>


</head>
<style type="text/css">
	div {
		text-align: center;
	}
</style>
<script src="<?php echo PUB; ?>Public/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<body>
<div>
<form id="form1" name="form1" method="post" action="<?php echo PUB; ?>Home/Qxian/qxadd/">
  <p>
    权限名称：
    <input type="text" name="qxname" id="textfield" />
  </p>
  <p>
    
    所属父类ID：<select name="p_id" id="select1">
	<?php foreach($qx_name as $name): ?>
	<?php if($name['p_id']=='0'): ?>
		<option value="<?php echo $name['id']; ?>"><?php echo $name['qx_name']; ?></option>
    <?php endif; ?>
	<?php endforeach; ?>
	
    </select>
  </p>
  <p>
    反问路径：
    <input type="text" name="action" id="textfield2" />
  </p>
   <p>
    
    状态ID：<select name="state" id="select2">
    <option value="0">不显示</option>
	<option selected='selected' value="1">显示</option>
	<option value="2">其他</option>
    </select>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="提交" />
	<input type="reset" name="button2" id="button2" value="重置" />
  </p>
</form>
</div>
</body>
</html>