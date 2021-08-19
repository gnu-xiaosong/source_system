<?php
/*
*作者:小松科技
*时间:2020.7.17
*myBlog:http://www.xskj.store
*文档:设置token,api填写该类路由，请使用thinkphp框架定义控制器
*微信公众号操作类
*thinkphp建立api模块Wechat类
*微信配置url:http://你的域名/index.php/tokenApi【说明:如果你把public作为根目录则url为:http://你的域名/tokenApi
*/
namespace  app\api\controller;
use think\Controller;
use think\Db;
class Wechat extends Controller
{



public function wechat()//主入口
{
 //token验证
 if(isset($_GET['echostr']))//微信服务器发送来的
 {

    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    
    //读取数据库获取token值
    		
    $web=Db::name('websystem')->find();
    
    $token = $web["wechat_token"];
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr);
    $tmpStr = sha1( $tmpStr );
    // return $_GET['echostr'];
   
    
    if( $tmpStr == $signature ){
        // return true;
      return $_GET['echostr'];
   
    }else{
        return false;
    }
  }
  
  //自动回复操作
        $postStr = file_get_contents('php://input');//php7.0以上用这个接收参数
        //extract post data
        if(!empty($postStr)){
         
            //解析post来的XML为一个对象$postObj
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
 
            $fromUsername = $postObj->FromUserName; //请求消息的用户
            $toUsername = $postObj->ToUserName; //"我"的公众号id
            $Content = trim($postObj->Content); //消息内容
            $time = time(); //时间戳
            $msgtype = 'text'; //消息类型：文本
            $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>"; 
            
            
            //订阅公众号自动回复
            if(strtolower($postObj->MsgType == 'event' )){ //如果XML信息里消息类型为event
                if($postObj->Event == 'subscribe'){ //如果是订阅事件
                
                    //回复内容       
                   $subscribe=Db::name('websystem')->find();			
			       if(empty($subscribe)){
			       //默认
			         $contentStr="欢迎使用！";
			       }else{
			         $contentStr=$subscribe["subscribe"];
			       }
                    $resultStrq = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgtype, $contentStr);
                    echo $resultStrq;
                    exit();
                }
            }
            
            
           //文本信息
           if(strtolower($postObj->MsgType == 'text' )){ 
            //关键词回复
	       $keyword=Db::name('wechat_public')->where('keywords', $Content)->find();			
		   if(!empty($keyword)){
			 //关键词存在\\\关键词自动回复
			  $contentStr=$keyword["reply_word"];
			}else{
			 //关键词不存在(默认调用自动回复答案默认)
			 $contentStr=$this->search($Content);
			}
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgtype, $contentStr);
            return $resultStr;
            }
            
            
            
            //图片信息
           if(strtolower($postObj->MsgType == 'image' )){ 
                //获取图片url
                $PicUrl=$postObj->PicUrl; 
                //这里进行业务处理逻辑↓↓↓↓↓↓(可以对该图片进行业务处理)
                
                //默认回复文本
                $contentStr="图片链接为:".$PicUrl;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgtype, $contentStr);
                return $resultStr;
            }
            
          //链接信息
         if(strtolower($postObj->MsgType == 'link' )){ 
                //获取链接url
                $Url=$postObj->Url; //消息链接url
                $Title=$postObj->Title; //消息标题
                $Description=$postObj->Description;  //消息描述
                //这里进行业务处理逻辑↓↓↓↓↓↓(可以对该url链接进行业务处理)
                
                //默认回复文本
                $contentStr="链接地址为:".$Url;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgtype, $contentStr);
                return $resultStr;
         }
         
         //地理信息
         if(strtolower($postObj->MsgType == 'location' )){ 
                
                $Location_X=$postObj->Location_X; //地理纬度
                $Location_Y=$postObj->Location_Y; //地理经度
                $Scale=$postObj->Scale;            //地图缩放大小
                $Label=$postObj->Label;           //地理位置信息
                //这里进行业务处理逻辑↓↓↓↓↓↓(可以对该地理信息进行业务处理)
                
                //默认回复文本
                $contentStr="您当前位于:\n纬度:".$Location_X."\n经度:".$Location_Y."\n地图缩放:".$Scale."\n地理位置信息:".$Label;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgtype, $contentStr);
                return $resultStr;
           }
         
         
            
        }else {
            echo "error";
            exit();
        }
}





//搜索题目答案函数
public  function  search($question){

//查询数据
$data=Db::name('answer_source')->where('question','like', "%".$question."%")->find();
if(!empty($data)){
return "问题:".$data["question"]."\n答案:".$data["answer"];
}


//调用第三方接口↓↓↓↓↓

//咩有查询到
return "抱歉！未能查询到！";
}


}

?>