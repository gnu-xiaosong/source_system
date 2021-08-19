<?php
//表单验证码发送提交

include"common.php";
//随机产生6位的随机数
$rand_ident_code=rand(100000,999999);
//网站名称
$web_name="小松科技";
//对验证码进行校验
if(!$_GET["email"]){
echo "<script>alert(\"邮箱不能为空!\");</script>";
exit;
}
//验证邮箱格式
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_GET["email"])) {
               echo "<script>alert(\"邮箱格式不正确!\");</script>";
               exit;
      }

//发送邮箱验证码通知用户

//调用公共函数文件sendMail()方法
$result=sendMail($_GET["email"],$rand_ident_code,$web_name);

//检测邮箱是否发送成功
if($result)
{
    //返回值，发送成功！
      echo "<script>alert(\"验证码发送成功!\");</script>";
      //利用session存储验证码用于程序调用验证码校验
   
        session_start();//打开session
        $_SESSION = array();//删除session值
        $_SESSION['code']=$rand_ident_code;//存储验证码session值
        $_SESSION['email']=$_GET["email"];
       
}else{
    //返回值，发送失败
      echo "<script>alert(\"验证码发送失败!\");</script>";
    exit();
}

?>