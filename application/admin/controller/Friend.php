<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials : true");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");

// 友链接口

class Friend extends Controller
{

    //初始化操作
    var $arrData;
    var $DbSearch;
    function __construct()
    {
        // 允许 发起的跨域请求
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials : true");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");
        $this->DbSearch = new DbSearch();
        $this->arrData = $this->DbSearch->getConfig();
    }




    //友链列表信息请求接口
    public function getFriendList()
    {
        /*
    *@请求参数:
     *@param:page  int  页数
     *@param:eachPageNum  int  每页的数量
     */

        //参数接收
        $page = (int)input('get.page');  //页数
        $eachPageNum = (int)input('get.eachPageNum'); //每页显示数量
        //参数复写
        $this->arrData["necessary"]["table"] = "friend"; //查询表名
        $this->arrData["arrStatu"]["status"] = 4;  //分页查询
        $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
        $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
        //dump($this->arrData);
        //调用分页查询接口
        $data = $this->DbSearch->search($this->arrData);

        //获取条数
        $count = Db::name('friend')->count('id');

        $data = array(
            "code" => 200,
            "description" => "这是后台友链列表请求信息",
            "count" => $count,  //数据条数
            "data" => $data
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    // 修改友链接口
    public function setFriendUrl()
    {

        //接收post的数据json格式数据
        $data = $_POST;
        $data["status"]=(int)$data["status"];
        // dump($data);
        $result = Db::name("friend")->where('id', $data["id"])->update($data);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "修改失败！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "修改成功"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }


    
    // 添加友链接口
    public function addFriendUrl()
    {

        //接收post的数据json格式数据
        $data = $_POST;
        $data["status"]=1;
        // dump($data);
        $result = Db::name("friend")->insert($data);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "添加失败！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "添加成功"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }

     // 删除友链接口
    public function delFriendUrl()
    {

        //接收post的数据json格式数据
        $id = $_POST["id"];
        // dump($data);
        $result = Db::name("friend")->delete(['id'=>$id]);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "删除失败！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "删除成功"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }
}
