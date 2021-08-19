<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;


class PictureIndex extends Controller
{ 

    public function getPictureIndexList(){
        /*
       *@请求参数:
       *@param:page  int  页数
       *@param:eachPageNum  int  每页的数量
       */

        //参数接收
        $page = (int)input('get.page');  //页数
        $eachPageNum = (int)input('get.eachPageNum'); //每页显示数量
        $search=input('get.search'); //搜索内容

        $count= Db::name('upload_file_source')->count();
        if($search == "全部"){
        //   搜索
        // 分页查询
        $data = Db::name('upload_file_source')
                ->order('id desc')
                ->page($page, $eachPageNum)
                ->select(); 
                // 加上域名
        foreach($data as $key=>$item){
            $data[$key]['file_path'] ="http://".$_SERVER["HTTP_HOST"].$item['file_path'];
        }
        
        }else{
       // 分页查询
        $data = Db::name('upload_file_source')
                ->where("user_defined_label", "like", $search)
                ->order('id desc')
                ->page($page, $eachPageNum)
                ->select();
        foreach($data as $key=>$item){
            $data[$key]['file_path'] ="http://".$_SERVER["HTTP_HOST"].$item['file_path'];
        }     
        }

       
        $data = array(
            "code" => 200,
            "description" => "这是前端图片列表请求信息",
            "count"=>$count,   //总数
            "data" => $data,            //分页数据
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);

    }
}