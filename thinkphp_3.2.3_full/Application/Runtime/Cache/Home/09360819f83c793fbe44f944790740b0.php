<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
<style type="text/css">
body {
	background-color: #DBDBDB;
}
</style>
</style>
<script src="<?php echo PUB; ?>Public/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="<?php echo PUB; ?>Public/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body>
<?php ?>
<div id="Accordion1" class="Accordion" tabindex="0">
<?php foreach ($arrs as $arr): ?>
	<?php if($arr['p_id']=='0'):?>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab" onclick='window.parent.frames["mainFrame"].location.href="<?php echo PUB.$arr['action']; ?>"'>	
		<?php echo $arr['qx_name'] ?>
	</div>
    <div class="AccordionPanelContent">
	
	
	<?php foreach ($arrs as $childarr): ?>
		<?php if($childarr['p_id']==$arr['id']): ?>
		<div>
			<a href="<?php echo PUB.$childarr['action']; ?>" target="mainFrame"><?php echo $childarr['qx_name']; ?>
			</a>
	
		</div>
	
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
  </div>
	<?php endif; ?>
 <?php endforeach; ?>
  <!-- <div class="AccordionPanel"> 
    <div class="AccordionPanelTab">权限管理</div>
    <div class="AccordionPanelContent">添加权限</div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">标签 3</div>
    <div class="AccordionPanelContent">内容 3</div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">标签 4</div>
    <div class="AccordionPanelContent">内容 4</div>
  </div>-->
</div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>