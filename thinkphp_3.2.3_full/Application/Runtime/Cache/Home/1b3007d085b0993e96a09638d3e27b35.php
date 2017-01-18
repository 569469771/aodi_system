<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>


</head>
<style type="text/css">
	
</style>
<script src="<?php echo PUB; ?>Public/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<body>

<div id='div1' align="center">
<table width="60%" height="" border="0" align="center">
  <tr width="12%" bgcolor="#CCCCCC">
    <th width="12%" scope="col">用户名</th>
    <th width="12%" scope="col" >名称</th>
    <th width="12%" scope="col">组id</th>
    <th width="12%" scope="col">所属公司id</th>
    <th width="12%" scope="col">用户状态</th>
	<th width="12%" scope="col">操作</th>
    
  </tr><?php $i=0;?>
  <?php foreach($list as $arr): ?>
   <?php $i++ ?>
   
  <tr style="text-align: center;" bgcolor="<?php echo $i%2==0?'#CCCCCC':''; ?>">
    <th scope="row"><?php echo $arr['u_name']; ?></th>
    <td><?php echo $arr['full_name']; ?></td>
    <td><?php echo $arr['group_id']; ?></td>
    <td><?php echo $arr['company_id']; ?></td>
    <td><?php echo $arr['user_state']; ?></td>
	<td><a href='<?php echo PUB; ?>Home/User/uadd/id/<?php echo $arr['id']; ?>'>修改</a>&nbsp
	<a href='<?php echo PUB; ?>Home/User/udel/id/<?php echo $arr['id']; ?>'>
	
	删除</a>
	</td>
    
  </tr>
	<?php endforeach; ?>
</table>
<?php echo $page; ?>
</div>
</body>
</html>