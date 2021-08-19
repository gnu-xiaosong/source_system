<?php
//微信公众号函数调用

//回复函数
function responseMsg()
    {
		//获取微信服务器以get方式以xml数据格式推送过来的数据
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//全局变量

      	//对推送数据进行判断
		if (!empty($postStr)){
                /* 于防止XML外部实体注入，
                    最好的方法是自己检查xml的有效性*/
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//把xml参数数据分离
              	
              	//xml数据分离后进行变量声明
                $fromUsername = $postObj->FromUserName;//用户名
                $toUsername = $postObj->ToUserName;//接收者
                $keyword = trim($postObj->Content);//微信用户发送的消息
                $time = time();//设置时间
                
                
                //xml数据设置
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";         
							
			       //微信用户发送的消息判断
				if(!empty( $keyword ))
                {
              		$msgType = "text";//回复形式
                	$contentStr = "Welcome to wechat world!";//回复文本
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);//xml变量替换
                	echo $resultStr;//输出xml信息，用于微信服务器接受
                }else{
                	echo "Input something...";//否则回复
                }

        }else {
        	echo "";
        	exit;
        }
    }
    
    
//校验函数
function cheakToken()
    {
    //设置微信token
    $token='weixin';
    //获取微信用GET以xml推送的信息，
    $signature = $_GET['signature'];//
    $timestamp = $_GET['timestamp'];
    $nonce = $_GET['nonce'];
    $echostr = $_GET['echostr'];
    
    //把参数组装成数组
    $tmpArr = array($token,$timestamp,$nonce);
    //使用sort进行字典排序
    sort($tmpArr,SORT_STRING);
    $tmpArr = implode($tmpArr);//数据参数黏在一起
    $tmpArr = sha1($tmpArr);//对其数据进行加密
    if($tmpArr == $signature && $echostr){//比对成功，echo出返回给微信服务器
        echo $echostr;
    }
}


?>