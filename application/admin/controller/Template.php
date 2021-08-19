<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Template extends Controller{
  

    // 获取前端模版列表
    public function getTemplateList(){
         
        $dir = $_SERVER['DOCUMENT_ROOT']."/template/";
        $dir1 = scandir($dir);

        $temList = [];
        foreach($dir1 as $key => $temp){
            if( !preg_match('/^\..*/' ,$temp)&&is_dir($dir.$temp)){
                // echo $temp;
                // 模版
                $temList[$key] = array(
                    "name"=>$temp,       
                    "image"=>"http://".$_SERVER["HTTP_HOST"]."/template/".$temp."/read.jpg",
                    "description"=>file_get_contents($dir.$temp."/read.txt")
                );
            }
        }
        $data=array(
          "code"=>200,
          "description"=>"这是后台模版列表信息",
          "data"=>$temList
         );
       return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    // 模版修改接口
    public function setTemplate(){

        $data = input('get.name');

        $result = Db::name("websystem")->find();
        
        $result = Db::name("websystem")->where("id",  2)->update([
            "template"=> $data
        ]);

        if($result!=null){
            $data=array(
          "code"=>200,
          "msg"=>"安装成功",
         );
       return  json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }
   

}