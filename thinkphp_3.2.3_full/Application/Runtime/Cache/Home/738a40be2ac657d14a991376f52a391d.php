<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>


</head>
<script type="text/javascript" language="utf-8">


</script>
<style type="text/css">
	div {
		text-align: center
	}
</style>
<script src="<?php echo PUB; ?>Public/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<body>
<div>
<form id="form1" name="form1" onsubmit="return check();"  method="post" action="<?php echo PUB; ?>Home/Customer/addCus/">
  <p>
    客户名称：
    <input type="text" name="customer_name" id="name" onblur='checkname();' 
	value="<?php echo $customer['customer_name']; ?>" required="required"/>
	<span id="spname" style="color:red" ></span>
	<span id="ckname" style="color:red" ></span>
  </p>
 
  <p>
    客户编号：
    <input type="text" name="customer_code" id="code"  onblur='checktex();' 
	value="<?php echo $customer['customer_code']; ?>" required="required" />
	<span id="spcode" style="color:red" ></span>
	<span id="ckcode" style="color:red" ></span>
	
  </p>
  <p>
    客户地址：
    <input type="text" style="width:300px;" name="customer_adress" id="adress" value="<?php echo $customer['customer_adress']; ?>" />
  </p>
  <p>
    客户全称：
    <input type="text" style="width:300px;" name="customer_fname" id="fname" value="<?php echo $customer['customer_fname']; ?>"  />
  </p>
  <p>是否是删除的：
     <select name="customer_state" >
      <option value="0" <?php echo $customer['customer_state']=='0'?'selected="selected"':''; ?>>不可用</option>
      <option value="1" <?php  if($customer['customer_state']=='1' || $customer['customer_state']==null){ echo 'selected="selected"'; } ?>>可用</option>
      <option value="2" <?php echo $customer['customer_state']=='2'?'selected="selected"':''; ?>>其他</option>

    
     </select>
   
  </p>
  <input type="hidden" id="flagc" value="0">
  <input type="hidden" id="flagn" value="0">
  <p>
    <input type="submit" name="button" id="button" value="提交" />
	<input type="reset" name="button2" id="button2" value="重置" />
	
  </p>
  
</form>
</div>
</body>
<script type="text/javascript">
	function check(){
	    var nval=$("#flagn").val();
	    var cval=$("#flagc").val();
		
		if( checkname() && checktex() && cval!="0" && nval!='0'){
			//console.log('11');
			return true;
		}else{
			//console.log('00');
			return false;
		}
	}
	function checkname(){
		var parm = 'name';
		var cname=$("#name").val();
		var cstrt=cname.match(/\s+/g);
		//console.log(cname);
		//console.log(cstrt);
		ajaxcheck(parm,cname);
		if(cstrt){
			$("#spname").html("不能有空格"); 
			return false;
		}else{
			$("#spname").html("");
			return true;			
		}
	}
	function checktex(){
		var parm = 'code';
		var code=$("#code").val();
		var str=code.match(/^\w+/g);
		var strt=code.match(/\s+/g);
		//console.log(strt);
		//console.log(str[0].length);
		ajaxcheck(parm,str[0]);
		if(strt){
			$("#spcode").html("不能有空格"); 
			return false;
		}
		if(str){
		$("#spcode").html("");
			return true;
		}
	}
	function ajaxcheck(parm,val){ 
		$.ajax({
			type: "POST",
			url: "<?php echo PUB ; ?>Home/Ajax/checkcode",
			data: parm+"="+val,
			success: function(msg){
				//console.log( "Data Saved: " + msg ); 
				if(msg=='name'){
					//console.log(msg);
					//$("#apimg").html(""); 
					$("#ckname").html(""); 
					$("#flagn").attr("value","0");
					$("#ckname").html("系统中该客户名称存在"); 				
				}
				if(msg=='code'){
					//console.log(msg);
					$("#ckcode").html(""); 
					$("#flagc").attr("value","0");
					$("#ckcode").html("系统中该编码已存在"); 			
				}
				if(msg=='name1'){
					//console.log(msg);
					$("#flagn").attr("value","1");
					$("#ckname").html(""); 		
				}
				if(msg=='code1'){
					//console.log(msg);
					$("#ckcode").html(""); 
					$("#flagc").attr("value","1");			
				}
			}
		});
		

	}

</script>
</html>