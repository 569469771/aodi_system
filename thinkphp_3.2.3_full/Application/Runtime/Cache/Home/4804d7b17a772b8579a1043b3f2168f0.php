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

<div id='div1' >
  <p align="center">公司：
    <select name="" >
      <option value="" >安庆</option>
      <option value="" >宁波</option>

    </select>

  </p>
<table width="80%" height="" border="0" align="center">
  <tr width="" bgcolor="#CCCCCC">
    <th width="" scope="col">客户编码</th>
    <th width="" scope="col" >客户名称</th>
    <th width="" scope="col">客户信用额</th>
    <th width="" scope="col">客户地址</th>
    <th width="" scope="col">客户是否可用</th>
	<th width="" scope="col">操作</th>
    
  </tr><?php $i=0;?>
  <?php foreach($list as $arr): ?>
   <?php $i++ ?>
   
  <tr style="text-align: center;" bgcolor="<?php echo $i%2==0?'#CCCCCC':''; ?>">
    <th scope="row"><?php echo $arr['customer_code']; ?></th>
    <td><?php echo $arr['customer_name']; ?></td>
    <td><?php echo $arr['customer_credit']; ?></td>
    <td><?php echo $arr['customer_adress']; ?></td>
    <td><?php echo $arr['customer_state']; ?></td>
	<td>
	<a href='<?php echo PUB; ?>Home/Customer/addCus/id/<?php echo $arr['id']; ?>'>
	
	修改</a>
	</td>
    
  </tr>
	<?php endforeach; ?>
</table>
<?php echo $page; ?>
</div>
</body>
</html>