<?php
/*
*说明:这是聚合支付接口类
*
*
*/
namespace app\pay\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
 
  var  $alipay;
  var  $wechat;
  var  $thirdpay;
  
  public function __construct(){
   //实例化各支付类↓↓↓↓↓
   
   //实例化支付宝支付类
   $this->alipay=new Alipay();
   //实例化微信支付类
  // $this->wechat=new WechatPay();
   //实例化第三方支付类
 //  $this->thirdpay=new Thirdpay();
  }
  
  
  
  //生成订单接口(写入数据库)
  public function pay(){
    /*
    *说明:该接口为集成支付接口方法(聚合支付接口)
    *methods:GET
    *@param: token string  用户登陆token值 [必传]
    *@param: out_trade_no string  订单编号  [必传]
    *@param: total_amount string  支付金额  [必传]
    *@param: subject  商品名   [必传]
    *@param: description string  订单描述   [必传]
    *@param: remark string  订单备注   [必传]
    *@param: category string  商品类别  [必传]
    *@param: pay_type int  支付方式(1:支付宝(默认);2:微信;3:易支付;4:码支付)   [必传]
    *@param: pay_methods string  支付方法(部分接口参数)  [可选]
    */
    
    //接收公共参数信息(必传)
    $token=input('get.token');  
    $out_trade_no=input('get.out_trade_no');  
    $total_amount=input('get.total_amount');  
    $subject=input('get.subject');  
    $description=input('get.description'); 
    $remark=input('get.remark');  
    $category=input('get.category');  
    $pay_type=input('get.pay_type');  
    //可传
    $pay_methods=input('get.pay_methods');
   // $pay_methods=isset($pay_methods)==true?input('post.pay_methods'):"wap";  
     
       
       
    
    //验证账户真实性
    $result=Db::name('user')->where('token', $token)->find();

    if(empty($result)){
    $data=array(
      "code"=>400,
      "msg"=>"用户校验失败，请重新登陆后操作！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    //用户校验通过，生成订单写入数据库中
    $insert=[
    "user"=>$result["username"],
    "out_trade_no"=>$out_trade_no,
    "total_amount"=>$total_amount,
    "subject"=>$subject,
    "description"=>$description,
    "remark"=>$remark,
    "category"=>$category,
    "status"=>0
    ];
    
    $insertResult=Db::name('order')->insert($insert);
    
    if(empty($insertResult)){
      //插入失败
     $data=array(
      "code"=>300,
      "msg"=>"生成订单失败！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    //调用不同支付接口方法↓↓↓↓↓↓↓↓(这里暂时为alipay)后续会添加其他支付接口
    if($pay_type==2){
    //微信支付↓↓↓↓
        //封装数据调用alipay支付接口(ok)
   $order = [
    'out_trade_no' => $out_trade_no,
    'total_amount' => $total_amount,
    'subject'      => $subject
    ];
   $this->wechat($pay_methods, $order);
    }else if($pay_type==3){
    //第三方支付↓↓↓↓↓
    
    }else if($pay_type==4){
    //码支付支付↓↓↓↓↓
          
          
    }else{
    //默认支付宝支付↓↓↓↓↓
    //封装数据调用alipay支付接口(ok)
   $order = [
    'out_trade_no' => $out_trade_no,
    'total_amount' => $total_amount,
    'subject'      => $subject
    ];
   return  $this->alipay->alipay($pay_methods, $order);
    }
  }
  
}