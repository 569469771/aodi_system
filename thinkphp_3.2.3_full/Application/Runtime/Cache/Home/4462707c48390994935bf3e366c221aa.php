<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台系统</title>
</head>
<frameset rows="122,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo PUB; ?>Home/Index/ftop" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="200,*" framespacing="0" frameborder="no" border="0">
    <frame src="<?php echo PUB; ?>Home/Index/fleft" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="<?php echo PUB; ?>Home/Index/fright" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
</frameset>
<noframes><body>
</body></noframes>
</html>