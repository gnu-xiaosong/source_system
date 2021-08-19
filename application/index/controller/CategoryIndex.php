<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials : true");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");




class CategoryIndex extends Controller
{

    // 获取前端各资源分类
    public  function getIndexCategory(){
     
        // 问答库
        $category = Db::name("answer_source")->group('category')->select();
        //遍历数组封装数组对象
        foreach ($category as $key => $item) {
            $category_name="category";
            // 对应分类数量
             $category_count = Db::name('answer_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array_answer[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }


        // 资源库
        $category = Db::name("source")->group('category')->select();
        //遍历数组封装数组对象
        foreach ($category as $key => $item) {
            $category_name="category";
            // 对应分类数量
             $category_count = Db::name('source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array_source[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }


        // 图片库
        $category = Db::name("upload_file_source")
                   ->where("file_type=:png or file_type=:jpg or file_type=:gif or file_type=:bmp or file_type=:jpeg")
                   ->bind(['png'=>'png','jpg'=>'jpg', 'gif'=>'gif', 'bmp'=>'bmp', 'jpeg'=>'jpeg'])
                   ->group('classify')
                   ->select();
        foreach ($category as $key => $item) {
            $category_name="classify";
            // 对应分类数量
             $category_count = Db::name('upload_file_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array_picture[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }

        // 文档库
        $category = Db::name("upload_doc_source")
                   ->group('classify')
                   ->select();
        foreach ($category as $key => $item) {
            $category_name="classify";
            // 对应分类数量
             $category_count = Db::name('upload_doc_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array_doc[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }

        $result = array(
            "code"=>200,
            "description"=>"这是前端资源分类信息",
            "data"=>array(
                "answer"=>array(
                    "description"=>"问答库分类",
                    "data"=>$category_array_answer
                ),
                "source"=>array(
                    "description"=>"资源库分类",
                    "data"=>$category_array_source
                ),
                 "doc"=>array(
                    "description"=>"文档库分类",
                    "data"=>$category_array_doc
                ),
                 "picture"=>array(
                    "description"=>"图片库分类",
                    "data"=>$category_array_picture
                ),
            )
        );
        return json_encode($result ,JSON_UNESCAPED_UNICODE);

    }
}