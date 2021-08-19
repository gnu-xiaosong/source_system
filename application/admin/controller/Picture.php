<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;

class Picture extends Controller{


     
    
    //图库列表信息请求接口
    public function getPictureList()
    {
        /*
       *@请求参数:
       *@param:page  int  页数
       *@param:eachPageNum  int  每页的数量
       */

        //参数接收
        $page = (int)input('get.page');  //页数
        $eachPageNum = (int)input('get.eachPageNum'); //每页显示数量

        // 分页查询
        $data = Db::name('upload_file_source')
                ->where('file_type','png')
                ->whereOr('file_type','jpg')
                ->whereOr('file_type','gif')
                ->whereOr('file_type','bmp')
                ->whereOr('file_type','jpeg')
                ->order('id desc')
                ->page($page, $eachPageNum)
                ->select();
        
        // 加上域名
        foreach($data as $key=>$item){
            $data[$key]['file_path'] ="http://".$_SERVER["HTTP_HOST"].$item['file_path'];
        }
        
        $data = array(
            "code" => 200,
            "description" => "这是后台图片列表请求信息",
            "data" => $data,            //分页数据
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    
    //  请求图片类别信息
    public function   getPictureCategory(){
        // 获取类别信息
        $category = Db::name("upload_file_source")
                   ->where("file_type=:png or file_type=:jpg or file_type=:gif or file_type=:bmp or file_type=:jpeg")
                   ->bind(['png'=>'png','jpg'=>'jpg', 'gif'=>'gif', 'bmp'=>'bmp', 'jpeg'=>'jpeg'])
                   ->group('classify')
                   ->select();

        //遍历数组封装数组对象
        $total = 0;

        $category_array = [];
        foreach ($category as $key => $item) {
            $category_name="classify";
            // 对应分类数量
             $category_count = Db::name('upload_file_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
            //  计算总数
            $total = (int)$total + (int)$category_count;
        }
        
        $data = array(
            "code" => 200,
            "description" => "这是后台问答资源列表请求信息",
            "total" => $total,           //总数据条数
            "category"=>$category_array  //分类数量
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    
   //搜索图库列表信息接口
  public function getSearchPicture()
  {

    //接收参数
    $category = input('get.category');
    $page = (int)input('get.page');
    $eachPageNum = (int)input('get.eachPageNum');

    //查询条件
    if ($category == "全部") {
        // 搜索全部
        $data = Db::name('upload_file_source')
                    ->where("file_type=:png or file_type=:jpg or file_type=:gif or file_type=:bmp or file_type=:jpeg")
                    ->bind(['png'=>'png','jpg'=>'jpg', 'gif'=>'gif', 'bmp'=>'bmp', 'jpeg'=>'jpeg'])
                    ->order('id desc')
                    ->page($page, $eachPageNum)
                    ->select();
    }else{
          // 查询类别
        $data = Db::name('upload_file_source')
                    ->where('classify', $category)
                    ->where("file_type=:png or file_type=:jpg or file_type=:gif or file_type=:bmp or file_type=:jpeg")
                    ->bind(['png'=>'png','jpg'=>'jpg', 'gif'=>'gif', 'bmp'=>'bmp', 'jpeg'=>'jpeg'])
                    ->order('id desc')
                    ->page($page, $eachPageNum)
                    ->select();
    }
    // 加上域名
    foreach($data as $key=>$item){
      $data[$key]['file_path'] ="http://".$_SERVER["HTTP_HOST"].$item['file_path'];
    }

    $data = array(
      "code" => 200,
      "description" => "这是后台搜索图库请求信息",
      "data" => $data
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


   //后台图片数据删除接口
  public  function delPicture()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    
    $result = Db::name('upload_file_source')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除图片信息",
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


}