<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials : true");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");

// 资源库接口

class Source extends Controller
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



    //资源列表信息请求接口
    public function getSourceList()
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
        $this->arrData["necessary"]["table"] = "source"; //查询表名
        $this->arrData["arrStatu"]["status"] = 4;  //分页查询
        $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
        $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
        //dump($this->arrData);
        //调用分页查询接口
        $data = $this->DbSearch->search($this->arrData);

        //获取条数
        $count = Db::name('source')->count('id');
        $data = array(
            "code" => 200,
            "description" => "这是后台资源列表请求信息",
            "count" => $count,  //数据条数
            "data" => $data,     //分页数据
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

     

 //搜索资源信息接口
  public function getSearchSource()
  {

    //接收参数
    $title = input('get.title');
    $category = input('get.category');
    $page = input('get.page');
    $eachPageNum = input('get.eachPageNum');

    //查询条件
    $map['title']  = ['like', "%".$title."%"];
    if ($category != "全部") {
        // 是否查询全部
      $map['category']  = ['=', $category];
    }


    $data = Db::name('source')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
    //数据条数
    $count = Db::name('source')->where($map)->count();

    $data = array(
      "code" => 200,
      "description" => "这是后台搜索资源请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }



       // 获取问答资源类别信息
       public function  getSourceCategory(){
       // 获取问答资源类别信息
        $category = Db::name("source")->group('category')->select();

        $category_array = [];
        //遍历数组封装数组对象
        foreach ($category as $key => $item) {
            $category_name="category";
            // 对应分类数量
             $category_count = Db::name('source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }
        $data = array(
            "code" => 200,
            "description" => "这是后台资源分类请求信息",
            'data' =>$category_array  //分类
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
  }

   
     
  //后台问答资源数据删除接口
  public  function delSource()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组

    $result = Db::name('source')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除资源信息",
      "data" => $data
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }
   

  //资源数据请求接口
  public  function getSingleSource()
  {
    //接收post的数据json格式数据
   $id=input('get.id');
   $result = Db::name('source')->where('id', $id)->find();

    $data = array(
      "code" => 200,
      "description" => "这是后台资源请求单个资源",
      "data" => $result
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


    //资源上传请求接口
    public function setSourceData()
    {


        //参数接收
        $data = $_POST;  

        $data["status"] = (int)$data["status"];
         
        $data["update_time"]=date("Y-m-d:h:i:s");
        //  dump($data);
        // 插入数据库中
        $result = Db::name('source')->insert($data);
        
        
        if(!empty($result)){
            // ok
          $data = array(
            "code" => 200,
            "msg" => "上传成功！",
        );
        }else{
            // 接口异常
            $data = array(
            "code" => 300,
            "msg" => "接口异常"
        );
        }
       
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }



      //资源更新请求接口
    public function updateSource()
    {

        //参数接收
        $data = $_POST;  

        $data["status"] = (int)$data["status"];
        // dump($data);
        // 插入数据库中
        $result = Db::name('source')->where("id", $data["id"])->update([
         "title"=>$data["title"],
        "category"=>$data["category"],
         "label"=>$data["label"],
        "download_url"=>$data["download_url"],
        "description"=> $data["description"],
        "use_description"=> $data["use_description"],
        "passwd"=>$data["passwd"],
        "status"=>(int)$data["status"],
        "image_url"=>$data["image_url"],
        "status"=>$data["status"],
        "user_id"=>$data["user_id"], 
        "user_name"=>$data["user_name"],
        "update_time"=>date("Y-m-d:h:i:s")  //修改时间
        ]);
        if(!empty($result)){
            // ok
          $data = array(
            "code" => 200,
            "msg" => "更新成功！",
        );
        }else{
            // 接口异常
            $data = array(
            "code" => 300,
            "msg" => "接口异常"
        );
        }
       
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}
