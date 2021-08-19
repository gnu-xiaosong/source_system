<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

class News extends Controller
{
  
    // 请求资讯列表接口
    public function getNewsList(){

        //参数接收
        $page = (int)input('get.page');  //页数
        $eachPageNum = (int)input('get.eachPageNum'); //每页显示数量
        $search = input('get.search');


        if($search == "全部"){
            // 没有搜索内容
        $data = Db::name('news')
                ->order('id desc')
                ->page($page, $eachPageNum)
                ->select();
        }else{
       //有搜索内容
        $data = Db::name('news')
                ->where("title", "like", $search)
                ->order('id desc')
                ->page($page, $eachPageNum)
                ->select();
        }

        $count = Db::name('news')->count();

         $data = array(
            "code" => 200,
            "description" => "这是前端资讯列表请求信息",
            "data" => $data,            //分页数据
            "count"=>$count    //数量
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}