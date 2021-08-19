<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials : true");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");




class FriendIndex extends Controller
{

    // 获取前台友情链接
    public  function getIndexFriendUrl(){
     
        $data=Db::name("friend")->select();

        $result = array(
            "code"=>200,
            "description"=>"这是前端友情链接请求信息",
            "data"=>$data
        );
        return json_encode($result ,JSON_UNESCAPED_UNICODE);

    }
}