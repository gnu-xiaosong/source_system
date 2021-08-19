<?php
session_start();//打开session
echo $_SESSION['code'];

//post数据参数接收
$code=$_GET["code"];

//验证码校验
if($_SESSION["code"]!=$code){
echo "<script>alert(\"验证码错误！\");</script>";
exit;
}

//验证码正确↓↓↓
echo "<script>alert(\"验证码正确！\");</script>";

?>