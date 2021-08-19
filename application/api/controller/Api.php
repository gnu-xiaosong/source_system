<?php
namespace app\api\controller;
use think\Controller;
class Api extends Controller
{

//后台模板主页
public function api($y)
{
echo $y;
 //接收请求的数据
 //$question=input('post.question');
 echo "<script>alert('测试成功！');</script>";
 exit;
 //判断请求数据
 if(empty($question)){
 $this->error('查询数据不能为空！');
 }
 //连接数据库开始查询
 $data=Db::name('bank1')->where('question',$question)->select();
 //模糊查询
// $data=Db::name('bank1')->where('question','like','%{$question}%')->select();
 echo json_encode($data, JSON_UNESCAPED_UNICODE);  // 不编码中文
 echo '测试成功！';
}
public function t($question)
{
echo $question;
}

}


