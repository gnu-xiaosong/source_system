<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Session;
use think\View;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;




class Index extends Controller
{

  //初始化操作
  var $arrData;
  var $DbSearch;
  function __construct()
  {
    $this->DbSearch = new DbSearch();
    $this->arrData = $this->DbSearch->getConfig();
  }

  //管理员登陆接口
  public function admin_login()
  {
    header("Content-type: text/html; charset=utf-8");
    $username = $_GET["username"];
    $passwd = $_GET["passwd"];
  

    //获取登陆的地理位置
    //获取访问者ip
    $ip = $_SERVER["REMOTE_ADDR"];

    //获取访问者地理位置
    $url = "http://apis.juhe.cn/ip/ipNew?key=38b0da5079ecabaf71ed56e8d4eff7b4&ip=" . $ip;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回    

    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回    

    $data_location = curl_exec($ch);
    curl_close($ch);
    //转化为数组
    $location = (array)json_decode($data_location);
    if ($location["resultcode"] != 200) {
      $loca = "ip接口异常！";
    }

    //  dump($location);
    $location = (array)$location["result"];
    $loca = $location["Country"] . $location["Province"] . $location["City"] . " " . $location["Isp"];
    // dump($loca);

    $result = Db::name('admin')->where('username', $username)->find();
    //  dump($result);
    if (!$result) {
      //该用户不存在
      $data = array(
        "code" => 1000,
        "msg" => "该账号有误！",
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if ($result["password"] != $passwd) {
      //该用户密码错误
      $data = array(
        "code" => 2000,
        "msg" => "该密码错误！",
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    //验证通过生成token
    $token = base64_encode($username . md5(time()) . $passwd . rand(1000, 90000));
    //保存token在用户表中
    $re = Db::name('admin')->where('username', $username)->update(['token' => $token, 'login_location' => $loca, 'login_ip' => $ip]);

    if ($re == 1) {
      //生成token
      $data = array(
        "code" => 200,
        "msg" => "登陆成功！",
        "token" => $token,
        "username" => $username
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }






  //网站后台配置信息接口
  public function getWebAdminData()
  {

    $re = Db::name('websystem')->find();
    
    $re["web_logo"] = "http://".$_SERVER["HTTP_HOST"].$re["web_logo"] ;

    $data = array(
      "code" => 200,
      "msg" => "获取成功",
      "data" => $re
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  

  //网站配置信息修改页面接口
  public function setWebAdmin()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    // dump($data);
    //连接数据库修改网站配置信息
    $result = Db::name("websystem")->update($data);
    //echo $result;
    //更新
    if ($result == 0) {
      //未修改
      $data = array(
        "code" => 100,
        "msg" => "您未修改配置信息！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if ($result == 1) {
      $data = array(
        "code" => 200,
        "msg" => "修改成功！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      $data = array(
        "code" => 300,
        "msg" => "未知错误！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }




  //上传log接口
  public function updateLog()
  {
    $file = $_FILES["file"];  //为数组0
    $ID = $_POST["ID"];
    //dump( $files);
    //$files再次封装
    $temp = explode(".", $file["name"]);
    $file_type = end($temp); //文件类型

    $file_root_path = $_SERVER['DOCUMENT_ROOT'] . "/upload/logo/";

    //文件名
    $file_name = "slide" . date("YmdHis") . "." . $file_type;
    //保存
    if (move_uploaded_file($file["tmp_name"], $file_root_path . $file_name)) {
      //把文件存储路径存放在数据表中

      //写入数据库表中
      $result = Db::name("websystem")->where("ID", $ID)->update(["web_logo" => "/upload/logo/" . $file_name]);
      if ($result == 1) {
        $data = array(
          "code" => 200,
          "msg" => "上传成功！",
        );
        return  json_encode($data, JSON_UNESCAPED_UNICODE);
      }

      $data = array(
        "code" => 500,
        "msg" => "上传失败！",
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }



  //撰写文章接口
  public function setAdminArticle()
  {
    //接收信息
    $title = input('post.title');   //标题
    $category = input('post.category');   //分类
    $label = input('post.label');   //标签
    $content = input('post.content');   //内容
    $status = input('post.status');   //审核状态(0保存，1发布，2待审核)
    $author = input('post.author');   //作者
    $image_url = input('post.image_url');   //作者

    //插入数据库中
    $data = [
      "title" => $title,
      "content" => $content,
      "author" => $author,
      "status" => $status,
      "label" => $label,
      "category" => $category,
      "hits" => 0,
      "star" => 0,
      "image_url"=>$image_url
    ];
    $result = Db::name('news')->insert($data);
    if ($result == 1) {
      $data = array(
        "code" => 200,
        "msg" => "发布成功！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      $data = array(
        "code" => 300,
        "msg" => "发布失败！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }




  //文章列表信息请求接口
  public function getArticleList()
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
    $this->arrData["necessary"]["table"] = "news"; //查询表名
    $this->arrData["arrStatu"]["status"] = 4;  //分页查询
    $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
    $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
    //dump($this->arrData);
    //调用分页查询接口
    $data = $this->DbSearch->search($this->arrData);

    //获取条数
    $count = Db::name('news')->count('id');

    $data = array(
      "code" => 200,
      "description" => "这是后台文章请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //搜索文章信息接口
  public function getSearchArticleList()
  {

    //接收参数
    $title = input('get.title');
    $status = (int)input('get.status');
    $page = input('get.page');
    $eachPageNum = input('get.eachPageNum');

    //查询条件
    $map['title']  = ['like', "%" . $title . "%"];
    if ($status != 100) {
      $map['status']  = ['=', $status];
    }


    $data = Db::name('news')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
    //数据条数
    $count = Db::name('news')->where($map)->count();

    $data = array(
      "code" => 200,
      "description" => "这是后台文章请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //后台文章页数据删除接口
  public  function delAdminAll()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组

    $result = Db::name('news')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除文章信息",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }

  //后台文章遍历保存接口
  public function getAdminArticle()
  {
    //接受参数(文章id)
    $id = $_GET["id"];
    $data = Db::name('news')->where('id', $id)->find();

    $data = array(
      "code" => 200,
      "msg" => "文章id=" . $id,
      "description" => "这是后台请求文章信息",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }





  //用户修改接口
  public  function setUser()
  {
    //接收post的数据json格式数据
    $data = $_POST;
  
    $result = Db::name('user')->where("id",$data["id"])->update($data);

    if (!empty($result)) {

      $data = array(
        "code" => 200,
        "msg" => "修改成功保存" 
      );

      return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }




  //后台文章编辑修改接口
  public function editAdminArticle()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    // dump($data);
    //连接数据库修改网站配置信息
    $result = Db::name("news")->where('id', $data["id"])->update($data);
    //echo $result;
    //更新
    if ($result == 0) {
      //未修改
      $data = array(
        "code" => 100,
        "msg" => "您未修改！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if ($result == 1) {
      $data = array(
        "code" => 200,
        "msg" => "修改成功！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      $data = array(
        "code" => 300,
        "msg" => "未知错误！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }


  //请求分类类别接口
  public function getCategory()
  {
    
       // 获取问答资源类别信息
        $category = Db::name("news")->group('category')->select();
        //遍历数组封装数组对象
        $category_array  = [];
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
            "description" => "这是后台文章类别请求信息",
            'data' =>$category_array  //分类
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
  }





  //请求用户数据
  public function getAdminUserData()
  {
    //接收参数
    $username = input('get.username');

    //请求管理员
    if ($username == "admin") {
      $result = Db::name("admin")->where('username', $username)->field('username, login_location, creat_time, QQ')->find();
      $data = array(
        "code" => 200,
        "msg" => "请求成功！",
        "data" => $result
      );
    } else {
      //请求其他用户
      $count = Db::name("user")->count();  //次数请求
      $result = Db::name("user")->where('username', $username)->field('username, email, cores, weixin_token, weixin_key, time, token')->find();

      $data = array(
        "code" => 200,
        "msg" => "请求成功！",
        "count" => $count,  //用户总数
        "data" => $result   //用户信息
      );
    }

    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  //后台图表文章数据接口
  public function getArticleCategoryData()
  {
    //接收图表类型------category_count__array
    $category_name_table = input('post.category_name_table');   //数据表名(后缀)
    $category_name = input('post.category_name');     //分组字段名(即分类类别字段名)
    
    $category_count_array =[];
    $category_array = [];
    //查询数据库获取分类数组
    $category = Db::name($category_name_table)->group($category_name)->select();
    //遍历数组封装数组对象
    foreach ($category as $key => $item) {
      $category_array[$key] = $item[$category_name];
      //计算分类名总数
      $category_count = Db::name($category_name_table)->where($category_name, $item[$category_name])->count();

      $category_count_array[$key] = $category_count;  //对应类别数据
    }
    $data = array(
      "code" => 200,
      "msg" => "请求成功！",
      "count" => $category_count_array,  //分类数据总数数组
      "category" => $category_array   //分类类别数组
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //发送邮件路由
  public function sendMail()
  {
    /*
    *参数说明:
    *@param: to string 收件人邮箱
    *@param: title string 邮箱标题
    *@param: content string 邮箱内容
    */
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $to = input('post.to');
      $title = input('post.title');
      $content = input('post.content');
    } else {
      $to = input('get.to');
      $title = input('get.title');
      $content = input('get.content');
    }
    // echo    $to."+". $title."+".$content;


    $result = sendEmail($to, $title, $content);
    if ($result == true) {
      $data = array(
        "code" => 200,
        "msg" => "发送成功！"
      );
    } else {
      $data = array(
        "code" => 300,
        "msg" => "发送失败！"
      );
    }
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  //请求邮件配置信息接口
  public function getEmail()
  {
    //参数接收
    $data = Db::name("email")->find();

    $data = array(
      "code" => 200,
      "msg" => "请求成功！",
      "data" => $data
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }



    //后台资源库分类统计接口
    public function getSourceCategoryData()
    {
        
        $table_name  = "answer_source";
        $field = "time";


        /***************************问答库********************************* */
        // 获取全部问答库
        $all_answer_count =  Db::name($table_name)->count();
        // 获取今天的新增
        $today_answer_count = Db::name($table_name)->whereTime($field, 'today')->count();
        // 获取昨天的新增
        $yesterday_answer_count = Db::name($table_name )->whereTime($field, 'yesterday')->count();
        // 获取本周的新增
        $week_answer_count = Db::name($table_name )->whereTime($field, 'week')->count();
         // 获取上周的新增
        $last_week_answer_count = Db::name($table_name )->whereTime($field, 'last week')->count();
         // 获取本月的新增
        $month_answer_count = Db::name($table_name )->whereTime($field, 'month')->count();

         // 数据封装
         $answer = array(
                "desription" => "这是问答库统计信息",
                "data"=>array(
                    "total"=>array(
                         "label"=>"总的数量",
                         "count"=> $all_answer_count
                    ),
                    "today"=>array(
                          "description"=>"今天的数据",
                          "total"=>array(
                              "label"=>"今日新增数据",
                              "count"=>$today_answer_count
                          ),
                    ),
                   "yesterday"=>array(
                          "description"=>"昨天的数据",
                          "total"=>array(
                              "label"=>"昨天新增数据",
                              "count"=>$yesterday_answer_count
                          ),

                    ),
                    "week"=>array(
                          "description"=>"本周的数据",
                          "total"=>array(
                              "label"=>"本周新增数据",
                              "count"=>$week_answer_count
                          ),
                    ),
                    "last_week"=>array(
                          "description"=>"上周的数据",
                          "total"=>array(
                              "label"=>"上周新增数据",
                              "count"=> $last_week_answer_count
                          ),
                    ),
                    "month"=>array(
                          "description"=>"本月的数据",
                          "total"=>array(
                              "label"=>"本月新增数据",
                              "count"=> $month_answer_count
                          ),
                    ),
                )
            );

      /********************单一资源库*************************** */
        $table_name  = "single_source";
        $field = "time";

       // 获取全部
        $all_single_count =  Db::name($table_name)->count();
        // 获取今天的新增
        $today_single_count = Db::name($table_name)->whereTime($field, 'today')->count();
        // 获取昨天的新增
        $yesterday_single_count = Db::name($table_name )->whereTime($field, 'yesterday')->count();
        // 获取本周的新增
        $week_single_count = Db::name($table_name )->whereTime($field, 'week')->count();
         // 获取上周的新增
        $last_week_single_count = Db::name($table_name )->whereTime($field, 'last week')->count();
         // 获取本月的新增
        $month_single_count = Db::name($table_name )->whereTime($field, 'month')->count();

         // 数据封装
         $single = array(
                "desription" => "这是问答库统计信息",
                "data"=>array(
                    "total"=>array(
                         "label"=>"总的数量",
                         "count"=> $all_single_count
                    ),
                    "today"=>array(
                          "description"=>"今天的数据",
                          "total"=>array(
                              "label"=>"今日新增数据",
                              "count"=>$today_single_count
                          ),
                    ),
                   "yesterday"=>array(
                          "description"=>"昨天的数据",
                          "total"=>array(
                              "label"=>"昨天新增数据",
                              "count"=>$yesterday_single_count
                          ),

                    ),
                    "week"=>array(
                          "description"=>"本周的数据",
                          "total"=>array(
                              "label"=>"本周新增数据",
                              "count"=>$week_single_count
                          ),
                    ),
                    "last_week"=>array(
                          "description"=>"上周的数据",
                          "total"=>array(
                              "label"=>"上周新增数据",
                              "count"=> $last_week_single_count
                          ),
                    ),
                    "month"=>array(
                          "description"=>"本月的数据",
                          "total"=>array(
                              "label"=>"本月新增数据",
                              "count"=> $month_single_count
                          ),
                    ),
                )
            );

          
       /********************文档资源库*************************** */
        $table_name  = "upload_file_source";
        $field = "time";

       // 获取全部
        $all_doc_count =  Db::name($table_name)->count();
        // 获取今天的新增
        $today_doc_count = Db::name($table_name)->whereTime($field, 'today')->count();
        // 获取昨天的新增
        $yesterday_doc_count = Db::name($table_name )->whereTime($field, 'yesterday')->count();
        // 获取本周的新增
        $week_doc_count = Db::name($table_name )->whereTime($field, 'week')->count();
         // 获取上周的新增
        $last_week_doc_count = Db::name($table_name )->whereTime($field, 'last week')->count();
         // 获取本月的新增
        $month_doc_count = Db::name($table_name )->whereTime($field, 'month')->count();

         // 数据封装
         $doc = array(
                "desription" => "这是问答库统计信息",
                "data"=>array(
                    "total"=>array(
                         "label"=>"总的数量",
                         "count"=> $all_doc_count
                    ),
                    "today"=>array(
                          "description"=>"今天的数据",
                          "total"=>array(
                              "label"=>"今日新增数据",
                              "count"=>$today_doc_count
                          ),
                    ),
                   "yesterday"=>array(
                          "description"=>"昨天的数据",
                          "total"=>array(
                              "label"=>"昨天新增数据",
                              "count"=>$yesterday_doc_count
                          ),

                    ),
                    "week"=>array(
                          "description"=>"本周的数据",
                          "total"=>array(
                              "label"=>"本周新增数据",
                              "count"=>$week_doc_count
                          ),
                    ),
                    "last_week"=>array(
                          "description"=>"上周的数据",
                          "total"=>array(
                              "label"=>"上周新增数据",
                              "count"=> $last_week_doc_count
                          ),
                    ),
                    "month"=>array(
                          "description"=>"本月的数据",
                          "total"=>array(
                              "label"=>"本月新增数据",
                              "count"=> $month_doc_count
                          ),
                    ),
                )
            );
      
       // 总的数据封装
       $data=array(
         "code"=>200,
         "decsription"=>"后台数据统计接口信息",
         "data"=>array(
           "answer"=>$answer,
           "single"=>$single,
           "doc"=>$doc
         )
         );
             
        return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }





  //后台邮件配置修改接口
  public function setEmail()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    // dump($data);
    //连接数据库修改网站配置信息
    $result = Db::name("email")->where('id', $data["id"])->update($data);
    //echo $result;
    //更新
    if ($result == 0) {
      //未修改
      $data = array(
        "code" => 100,
        "msg" => "您未修改！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if ($result == 1) {
      $data = array(
        "code" => 200,
        "msg" => "保存成功！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      $data = array(
        "code" => 300,
        "msg" => "未知错误！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }


  //后台请求支付配置信息接口
  public function getPaySettingData()
  {

    $result = Db::name("pay")->find();

    //数据封装返回
    $data = array(
      "code" => 200,
      "msg" => "请求数据successful！",
      "data" => $result
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //后台设置修改支付配置信息接口
  public function setPaySettingData()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    // dump($data);
    //连接数据库修改网站配置信息
    $result = Db::name("pay")->where('ID', $data["ID"])->update($data);
    //echo $result;
    //更新
    if ($result == 0) {
      //未修改
      $data = array(
        "code" => 100,
        "msg" => "您未修改！"
      );
    } else {
      //修改成功
      $data = array(
        "code" => 200,
        "msg" => "修改成功！"
      );
    }
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  //阿里云短信发送接口
  public function sendSms()
  {

    //设置阿里云短信注册阿里云帐户并获取您的凭证
    AlibabaCloud::accessKeyClient('accessKeyId', 'accessKeySecret')->asDefaultClient();

    //发送邮件
  }



  //用户列表信息请求接口
  public function getUserList()
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
    $this->arrData["necessary"]["table"] = "user"; //查询表名
    $this->arrData["arrStatu"]["status"] = 4;  //分页查询
    $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
    $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
    //dump($this->arrData);
    //调用分页查询接口
    $data = $this->DbSearch->search($this->arrData);

    //获取条数
    $count = Db::name('user')->count('id');

    $data = array(
      "code" => 200,
      "description" => "这是后台用户列表请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //搜索用户信息接口
  public function getSearchUserList()
  {

    //接收参数
    $username = input('get.username');
    $status = (int)input('get.status');
    $page = input('get.page');
    $eachPageNum = input('get.eachPageNum');

    //查询条件
    $map['username']  = ['like', "%" . $username . "%"];
    if ($status != 100) {
      $map['status']  = ['=', $status];
    }


    $data = Db::name('user')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
    //数据条数
    $count = Db::name('user')->where($map)->count();

    $data = array(
      "code" => 200,
      "description" => "这是后台搜索用户请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //后台用户数据删除接口
  public  function delUserAll()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组

    $result = Db::name('user')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除用户信息",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //搜索用户信息接口
  public function getUser()
  {

    //接收参数
    $user_id = input('get.id');

    $data = Db::name('user')->where("id", $user_id)->find();

    $data = array(
      "code" => 200,
      "description" => "这是用户信息请求",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }




  //订单列表信息请求接口
  public function getOrderList()
  {
    /*
*@请求参数:
*@param:page  int  页数
*@param:eachPageNum  int  每页的数量
*/

    //参数接收
    $page = (int)input('get.page');  //页数
    $eachPageNum = (int)input('get.eachPageNum'); //每pp页显示数量
    //参数复写
    $this->arrData["necessary"]["table"] = "order"; //查询表名
    $this->arrData["arrStatu"]["status"] = 4;  //分页查询
    $this->arrData["page"]["numPage"] = $page;  //从第几行开始查询
    $this->arrData["page"]["eachPageNum"] = $eachPageNum;  //每页查询数量
    //dump($this->arrData);
    //调用分页查询接口
    $data = $this->DbSearch->search($this->arrData);

    //获取条数
    $count = Db::name('order')->count('id');

    $data = array(
      "code" => 200,
      "description" => "这是后台订单列表请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //搜索订单信息接口
  public function getSearchOrderList()
  {

    //接收参数
    $out_trade_no = input('get.out_trade_no');
    $status = (int)input('get.status');
    $page = input('get.page');
    $eachPageNum = input('get.eachPageNum');

    //查询条件
    $map['out_trade_no']  = ['like', "%" . $out_trade_no . "%"];
    if ($status != 100) {
      $map['status']  = ['=', $status];
    }


    $data = Db::name('order')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
    //数据条数
    $count = Db::name('order')->where($map)->count();

    $data = array(
      "code" => 200,
      "description" => "这是后台搜索订单请求信息",
      "count" => $count,  //数据条数
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //后台订单数据删除接口
  public  function delOrderAll()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组

    $result = Db::name('order')->delete($data);

    $data = array(
      "code" => 200,
      "msg" => "成功删除" . $result . "条",
      "description" => "这是后台删除订单信息",
      "data" => $data
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }



  //获取管理员信息
  public function getAdmin()
  {
    $result = Db::name('admin')->find();
    $data = array(
      "code" => 200,
      "description" => "这是后台管理员信息接口",
      "data" => $result
    );

    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }


  //修改管理员配置信息接口
  public function setAdmin()
  {
    //接收post的数据json格式数据
    $data = file_get_contents('php://input');
    $data = (array)json_decode($data);  //转化为数组
    // dump($data);
    //连接数据库修改网站配置信息
    $result = Db::name("admin")->update($data);
    //echo $result;
    //更新
    if ($result == 0) {
      //未修改
      $data = array(
        "code" => 100,
        "msg" => "您未修改配置信息！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if ($result == 1) {
      $data = array(
        "code" => 200,
        "msg" => "修改成功！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      $data = array(
        "code" => 300,
        "msg" => "未知错误！"
      );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  }


  //获取订单总数接口
  public function getOrderCount()
  {

    //获取总订单数
    $result = Db::name("order")->count();
    //获取未支付订单数
    $result1 = Db::name("order")->where("status", 0)->count();
    //获取已支付订单数
    $result2 = Db::name("order")->where("status", 1)->count();

    $data = array(
      "code" => 200,
      "msg" => "获取订单数情况！",
      "data" => array(
        "order" => $result,
        "paid" => $result1,
        "notPaid" => $result2
      )
    );
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
  }

  
}