<?php
namespace app\user\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
  
    //初始化操作
    var $arrData;
    var $DbSearch;
    function __construct(){
    $this->DbSearch=new DbSearch();
    $this->arrData=$this->DbSearch->getConfig();
    }
    
    //用户注册路由
    public function register(){
     //插入数据库中
    $data=[
     "username"=>$_POST["name"],
     "password"=>md5($_POST["password"]),
     "email"=>$_POST["email"],
     "QQ"=>$_POST["QQ"],
     "level"=>2,  //用户级别:(0:超级管理员;1:中级用户;2:普通用户)
     "status"=>1,
     "cores"=>100,  //注册赠送100
     "number"=>0
     ];

     $re=Db::name('user')->where("email",  $data["email"])->find();  //重复注册
     
     if(!empty($re)){
    $data=array(
      "code"=>400,
      "msg"=>"该邮箱已被注册，注册失败！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     $result=Db::name('user')->insert($data);
     
     if($result!=1){
     $data=array(
      "code"=>300,
      "msg"=>"注册失败！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     $data=array(
      "code"=>200,
      "msg"=>"注册成功！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    //用户注册信息校验接口
    public function isValid(){
    
    $result=Db::name('user')->where($_POST["col"], $_POST["data"])->find();
    if(!empty($result)){
      //已经存在
     $data=array(
      "code"=>true,
      "msg"=>$_POST["err"]
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
    $data=array(
      "code"=>false,
      "msg"=>"可以使用！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     
    }
    
    
    
    //用户登陆接口
    public function user_login(){
    
    //接收参数
    $username=input('post.username');
    $password=input('post.password');
    
    
    //验证用户
    $result=Db::name('user')->where('username', $username)->find();
    if(empty($result)){
    //用户不存在
    $data=array(
      "code"=>300,
      "msg"=>"该用户不存在！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    //用户账号验证
   if($result["status"]==0){
    //用户不存在
    $data=array(
      "code"=>100,
      "msg"=>"该用户暂时被冻结！暂时不能登陆！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    //验证密码
    if(md5($password)!=$result["password"]){
     $data=array(
      "code"=>400,
      "msg"=>"密码错误！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    //验证成功返回用户id值和token
    
    //生成token
    $id =  $result["id"];
    $key = mt_rand();
    $hash = md5($key . $id . mt_rand() . time());
    $token = base64_encode($hash);
    
    //更新token
    $re=Db::name('user')->where("id",  $id)->update(["token"=> $token]);  //重复注册
     
   if($re==1){
    //封装数据返回
    $data=array(
      "code"=>200,
      "data"=>array(
      "id"=>$id,
      "token"=>$token
      ),
      "msg"=>"登陆成功！"
    );
    }else{
    $data=array(
      "code"=>200,
      "msg"=>"更新token失败！数据库异常"
    );
    }
    
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
 
 
   //用户动态发表接口
   public function announce(){
    //参数接收
    $title=input('post.title');
    $content=input('post.editor');
    $id=input('post.id');   //用户id
    
    //插入数据库
   $data=[
     "user_id"=>$id,
     "title"=>$title,
     "content"=>$content,
     "user_name"=>"测试"
     ];
    $re=Db::name('community')->insert($data);  
   
   if($re!=1){
    $data=array(
      "code"=>300,
      "msg"=>"动态信息插入数据库失败！"
    );
   }else{
   $data=array(
      "code"=>200,
      "msg"=>"动态信息插入数据库成功！"
    );
   }
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
 
 
   //用户松币规则接口
   public function CoinRuler(){
   //接收参数
   $ruler=$_GET["ruler"];  //积分规则:+或- string
   $token=$_GET["token"];   //操作积分对象(用户token) string 
   $coin_count=$_GET["coin_count"];  //积分操作数目(松币为单位) int
   
   
   //判断积分规则
   
   //查询积分规则表
  //$re=Db::name('ruler')->where("ruler_id",  0)->find();  
   //获取操作对象用户积分数
  $reg=Db::name('user')->where("token", $token)->find();  
//  dump( $reg);
   //加积分
   if($ruler==1){
     $cores=(int)$reg["cores"]+(int)$coin_count;
          
     //积分不足
     if($cores<1){
      $data=array(
      "code"=>400,
      "msg"=>"积分不足！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     // dump("积分:".$cores);
   //插入数据库中
     $reg=Db::name('user')->where("token",  $token)->update(["cores"=>(int)$cores]);
    // dump($reg);
     if($reg==1){
       $data=array(
      "code"=>200,
      "msg"=>"操作用户积分成功！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
    $data=array(
      "code"=>300,
      "msg"=>"操作用户积分失败！",
      "cores"=> $cores
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   
   //减积分
   if($ruler==0){
     $cores=(int)$reg["cores"]-(int)$coin_count;
     
     //积分不足
     if($cores<0){
      $data=array(
      "code"=>400,
      "msg"=>"积分不足！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     
   //插入数据库中
     $reg=Db::name('user')->where("token",  $token)->update(["cores"=>(int)$cores]);
     if($reg==1){
       $data=array(
      "code"=>200,
      "msg"=>"操作用户积分成功！",
      "cores"=> $cores
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
    $data=array(
      "code"=>300,
      "msg"=>"操作用户积分失败！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   }
 
 
   //获取qq信息
   public function getQQ(){
     header("Content-type: text/html; charset=utf-8");
     $qq = $_GET['qq'];
    // $is=$_GET['is'];
     ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
    $get_info = file_get_contents('http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
     //正则匹配
     $ruler='/portraitCallBack\((.*)\)/';
     preg_match($ruler,$get_info,$result);
    
     //dump($this->gzdecode($get_info));
     //正则匹配昵称
     $ruler1='/,"(.*)",/';
     preg_match($ruler1,$result[1],$name);
     $name=$name[1];
     
     if(isset($_GET['is'])){
     
      $reg=Db::name('user')->where("QQ", $qq)->find();
      return $reg["username"];
     }
     
     
    // echo $name;
    // echo mbconvertencoding($name, "utf-8", "GBK");
     //匹配获取头像url
     //$ruler2='/\["(.*?)"/';
   //  preg_match($ruler2,$result[1],$header);

    // $name = urldecode($data["nickname"]);
     $txurl = 'http://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=640';

     $info =array(
      "code"=>200,
      "imgurl"=>$txurl
    );
     return json_encode($info, JSON_UNESCAPED_UNICODE);
   }
   
   
   //获取用户信息
   public function getUserData(){
   //注意:修改php.ini，把allow_url_fopen给启用，改成allow_url_fopen = On
   //接收参数
   $token=input('get.token');
   
   $reg=Db::name('user')->where("token", $token)->find();
   
   if(empty($reg)){
     //token不正确，或者已实现，
    $data=array(
      "code"=>300,
      "msg"=>"token已失效，请重新登陆！"
    );
   }else{
   //返回相关信息
     $data=array(
      "code"=>200,
      "msg"=>"获取信息成功！",
      "cores"=>$reg["cores"],
      "qq"=>$reg["QQ"],
      "username"=>$reg["username"]
    );
   }
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   
   
//用户订单查询接口
public function getIndexOrder(){
//接收参数
$order_no=input('get.order_no');

//查询
$result=Db::name('order')->where('out_trade_no', $order_no)->find();

if(empty($result)){
$data=array(
"code"=>300,
"msg"=>"未查询到该订单信息!",
);
}else{
 $data=array(
"code"=>200,
"msg"=>"该订单信息查询成功!",
"data"=>$result
);
}
return json_encode($data, JSON_UNESCAPED_UNICODE);
}


}