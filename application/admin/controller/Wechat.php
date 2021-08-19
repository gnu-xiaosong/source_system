<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Session;
use think\View;




class Wechat extends Controller
{
  
  
  //获取微信公众号配置信息
  public function get_wechat_public(){
  
  
   //获取微信对接token
   $result=Db::name("websystem")->find();
   $token=$result["wechat_token"];
   $subscribe=$result["subscribe"];
   $wechat_public_switch=$result["wechat_public_switch"];
   
   //获取微信公众号关键词自动回复
   $reply=Db::name("wechat_public")->select();
   
   //封装数据返回
   $data=array(
      "code"=>200,
      "description"=>"这是后台微信公众号配置信息",
      "data"=>array(
        "id"=>$result["ID"],
        "token"=>$token,
        "wechat_public_switch"=>$wechat_public_switch,
        "subscribe"=>$subscribe,   //关注回复
        "keyword"=>$reply
      )
     );
   return  json_encode($data, JSON_UNESCAPED_UNICODE);
  
  }
  
  
  
  
  
  //修改微信公众号接口
  public function set_wechat_public(){
  
   //接收post的数据json格式数据
    $data=file_get_contents('php://input');
    $data=(array)json_decode($data);  //转化为数组
  //  dump($data);
    
    
    //更新数据
   $result1=Db::name("websystem")->where("ID", $data["id"])->update(["wechat_token"=>$data["token"],"subscribe"=>$data["subscribe"], "wechat_public_switch"=>$data["wechat_public_switch"]]);
   
   foreach($data["keyword"] as $value){
   $value=(array)$value;  //转化为数组
 //  dump($value);
   //循环更新
   $result2=Db::name("wechat_public")->where("id", $value["id"])->update($value);
   }
    $data=array(
      "code"=>200,
      "msg"=>"保存成功！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
  
  }
  
  
  
 }