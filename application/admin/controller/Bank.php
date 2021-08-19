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

class Bank extends Controller
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




    //单一资源列表信息请求接口
    public function getBankSingleList()
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
        $this->arrData["necessary"]["table"] = "single_source"; //查询表名
        $this->arrData["arrStatu"]["status"] = 4;  //分页查询
        $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
        $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
        //dump($this->arrData);
        //调用分页查询接口
        $data = $this->DbSearch->search($this->arrData);

        //获取条数
        $count = Db::name('single_source')->count('id');

        $data = array(
            "code" => 200,
            "description" => "这是后台单一资源列表请求信息",
            "count" => $count,  //数据条数
            "data" => $data
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    // 删除单一资源接口
    public function delBankSingle()
    {

        //接收post的数据json格式数据
        $id = $_POST["id"];
        // dump($id);
        $result = Db::name("single_source")->delete(['id' => $id]);
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


    // 添加单一资源接口
    public function addBankSingle()
    {

        //接收post的数据json格式数据
        $data = $_POST;
        $data["status"] = 1;
        // dump($data);
        $result = Db::name("single_source")->insert($data);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "上传失败！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "上传成功"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }

    // 修改单一资源接口
    public function setBankSingle()
    {

        //接收post的数据json格式数据
        $data = $_POST;
        $data["status"] = (int)$data["status"];
        // dump($data);
        $result = Db::name("single_source")->where('id', $data["id"])->update($data);
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



    // 问答资源接口


      // 获取问答资源类别信息
       public function  getBankAnswerCategory(){
       // 获取问答资源类别信息
        $category = Db::name("answer_source")->group('category')->select();
        //遍历数组封装数组对象
        foreach ($category as $key => $item) {
            $category_name="category";
            // 对应分类数量
             $category_count = Db::name('answer_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }
        $data = array(
            "code" => 200,
            "description" => "这是后台问答资源分类请求信息",
            'data' =>$category_array  //分类
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


    //问答资源列表信息请求接口
    public function getBankAnswerList()
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
        $this->arrData["necessary"]["table"] = "answer_source"; //查询表名
        $this->arrData["arrStatu"]["status"] = 4;  //分页查询
        $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
        $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
        //dump($this->arrData);
        //调用分页查询接口
        $data = $this->DbSearch->search($this->arrData);

        //获取条数
        $count = Db::name('answer_source')->count('id');
          // 获取问答资源类别信息
        $category = Db::name("answer_source")->group('category')->select();

        $category_array  = [];
        //遍历数组封装数组对象
        foreach ($category as $key => $item) {
            $category_name="category";
            // 对应分类数量
             $category_count = Db::name('answer_source')->where($category_name, $item[$category_name])->count();
            //计算分类名总数
             $category_array[$key]=array(
                 "name"=> empty($item[$category_name])?"未分类":$item[$category_name],
                 "count"=>$category_count
             );
        }
      
        $data = array(
            "code" => 200,
            "description" => "这是后台问答资源列表请求信息",
            "count" => $count,  //数据条数
            "data" => $data,     //分页数据
            "category"=>$category_array //分类
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    
  //后台问答资源数据删除接口
  public  function delBankAnswer()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组

    $result = Db::name('answer_source')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除资源信息",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }

   //搜索问答资源信息接口
  public function getSearchBankAnswer()
  {

    //接收参数
    $question = input('get.question');
    $category = input('get.category');
    $page = input('get.page');
    $eachPageNum = input('get.eachPageNum');

    //查询条件
    $map['question']  = ['like', "%" . $question . "%"];
    if ($category != "全部") {
        // 是否查询全部
      $map['category']  = ['=', $category];
    }


    $data = Db::name('answer_source')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
    //数据条数
    $count = Db::name('answer_source')->where($map)->count();

    $data = array(
      "code" => 200,
      "description" => "这是后台搜索问答资源请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  
    // 添加问答资源接口
    public function addBankAnswer()
    {

        //接收post的数据json格式数据
        $data = $_POST;
        $data["status"] = 1;
        // dump($data);
        $result = Db::name("answer_source")->insert($data);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "上传失败！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "上传成功"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }

}
