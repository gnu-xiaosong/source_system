<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials : true");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");

// 用户动态文章接口

class Commit extends Controller
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




    //用户动态文章列表信息请求接口
    public function getCommitList()
    {
        /*
    *@请求参数:
     *@param:page  int  页数
     *@param:eachPageNum  int  每页的数量
     */

        //参数接收
        $page = (int)input('get.page');  //页数
        $eachPageNum = (int)input('get.eachPageNum'); //每页显示数量
        $status = isset($_GET["status"]) ? (int)$_GET["status"] : 100;  //100 代表全部
        if ($status != 100) {
            $map['status']  = ['=', $status];
            $data = Db::name('community')->where($map)->order('id desc')->page($page, $eachPageNum)->select();
        } else {
            $data = Db::name('community')->order('id desc')->page($page, $eachPageNum)->select();
        }

        //dump($this->arrData);

        //获取条数
        $count = Db::name('community')->count('id');

        $data = array(
            "code" => 200,
            "description" => "这是用户动态文章列表请求信息",
            "count" => $count,  //数据条数
            "data" => $data
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    // 删除用户动态接口
    public function delCommit()
    {

        //接收post的数据json格式数据
        $id = (int)$_POST["id"];
        // dump($data);
        $result = Db::name("community")->delete(['id' => $id]);
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

    // 改变用户动态状态接口
    public function commitPassAudit()
    {

        //接收post的数据json格式数据
        $id = (int)$_POST["id"];
        $status = (int)$_POST["status"];
        // dump($data);
        $result = Db::name("community")->where("id", $id)->update(['status' => $status]);
        if (empty($result)) {
            $re = array(
                "code" => 500,
                "msg" => "状态改变成功！"
            );
        } else {
            $re = array(
                "code" => 200,
                "msg" => "状态改变失败！"
            );
        }

        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }


    // 改变用户动态统计接口
    public function commitStatistics()
    {
        
        $table_name  = "community";// 查询表名后缀
        $field = "time";

        // 获取全部用户动态数量
        $all_count =  Db::name($table_name )->count();
        // 获取未审核的数目
        $not_pass_data =  Db::name($table_name )->where('status', 0)->select();
        $not_pass_count =  count($not_pass_data);

        // 获取今天的用户动态
        $today_data = Db::name($table_name )->whereTime($field, 'today')->select();
        $pass_today_data = Db::name($table_name )->whereTime($field, 'today')->where('status', 1)->select();
        // 获取昨天的用户动态
        $yesterday_data = Db::name($table_name )->whereTime($field, 'yesterday')->select();
        $pass_yesterday_data = Db::name($table_name )->whereTime($field, 'yesterday')->where('status', 1)->select();
        // 获取本周的用户动态
        $week_data = Db::name($table_name )->whereTime($field, 'week')->select();
        $pass_week_data = Db::name($table_name )->whereTime($field, 'week')->where('status', 1)->select();
         // 获取上周的用户动态
        $last_week_data = Db::name($table_name )->whereTime($field, 'last week')->select();
        $pass_last_week_data = Db::name($table_name )->whereTime($field, 'last week')->where('status', 1)->select();


         // 获取本月的
        $month_data = Db::name($table_name )->whereTime($field, 'month')->select();
        $pass_month_data = Db::name($table_name )->whereTime($field, 'month')->where('status', 1)->select();

        //  // 获取上月
        //  $last_month_data = Db::name($table_name )->whereTime($field, 'last month')->select();
        //  $last_month_count = count($last_month_data);
        //  // 获取今年
        //  $year_data = Db::name($table_name )->whereTime($field, 'year')->select();
        //  $year_count = count($year_data);
        //  // 获取去年
        //  $last_year_data = Db::name($table_name )->whereTime($field, 'last year')->select();
        //  $last_year_count = count($last_year_data);
        

        // 数据封装
         $re = array(
                "code" => 200,
                "desription" => "这是后台用户动态统计信息",
                "data"=>array(
                    "total"=>array(
                         "label"=>"总的数量",
                         "count"=>$all_count
                    ),
                    "not_pass_audit_total"=>array(
                         "label"=>"总的还未审核数量",
                         "data"=>$not_pass_data,
                         "count"=>$not_pass_count 
                    ),
                    "today"=>array(
                          "description"=>"今天的数据",
                          "total"=>array(
                              "label"=>"今日新增数据",
                              "data"=>$today_data,
                              "count"=>count($today_data)
                          ),
                         "pass_audit"=>array(
                              "label"=>"今日新增通过审核数",
                              "data"=>$pass_today_data,
                              "count"=>count($pass_today_data)
                          ),

                    ),
                   "yesterday"=>array(
                          "description"=>"昨天的数据",
                          "total"=>array(
                              "label"=>"昨天新增数据",
                              "data"=>$yesterday_data,
                              "count"=>count( $yesterday_data)
                          ),
                         "pass_audit"=>array(
                              "label"=>"昨天新增通过审核",
                              "data"=> $pass_yesterday_data,
                              "count"=>count($pass_yesterday_data)
                          ),

                    ),
                    "week"=>array(
                          "description"=>"本周的数据",
                          "total"=>array(
                              "label"=>"本周新增数据",
                              "data"=>$week_data,
                              "count"=>count($week_data)
                          ),
                         "pass_audit"=>array(
                              "label"=>"本周新增通过审核数",
                              "data"=>$pass_week_data,
                                "count"=>count($pass_week_data)
                          ),

                    ),
                    "last_week"=>array(
                          "description"=>"上周的数据",
                          "total"=>array(
                              "label"=>"上周新增数据",
                              "data"=>$last_week_data,
                              "count"=>count($last_week_data)
                          ),
                         "pass_audit"=>array(
                              "label"=>"上周新增通过审核数",
                              "data"=>$pass_last_week_data,
                              "count"=>count($pass_last_week_data)
                          ),
                    ),
                    "month"=>array(
                          "description"=>"本月的数据",
                          "total"=>array(
                              "label"=>"本月新增数据",
                              "data"=>$month_data,
                                "count"=>count($month_data)
                          ),
                         "pass_audit"=>array(
                              "label"=>"本月新增通过审核数",
                              "data"=>$pass_month_data,
                              "count"=>count($pass_month_data)
                          ),

                    ),
                )
            );
        return  json_encode($re, JSON_UNESCAPED_UNICODE);;
    }
}





// 留存

//    $re = array(
            //     "code" => 200,
            //     "desription" => "这是后台用户动态统计信息",
            //     "data"=>array(
            //         "total"=> $all_count,
            //         "today"=>array(
            //               "description"=>"今天的数据",
            //               "total"=>array(
            //                   "label"=>"今日新增数据",
            //                   "data"=>111
            //               ),
            //              "pass_audit"=>array(
            //                   "label"=>"今日新增通过审核数",
            //                   "data"=>1111
            //               ),

            //         ),
            //        "yesterday"=>array(
            //               "description"=>"昨天的数据",
            //               "total"=>array(
            //                   "label"=>"昨天新增数据",
            //                   "data"=>111
            //               ),
            //              "pass_audit"=>array(
            //                   "label"=>"昨天新增通过审核数",
            //                   "data"=>1111
            //               ),

            //         ),
            //         "week"=>array(
            //               "description"=>"本周的数据",
            //               "total"=>array(
            //                   "label"=>"本周新增数据",
            //                   "data"=>111
            //               ),
            //              "pass_audit"=>array(
            //                   "label"=>"本周新增通过审核数",
            //                   "data"=>1111
            //               ),

            //         ),
            //         "last_week"=>array(
            //               "description"=>"上周的数据",
            //               "total"=>array(
            //                   "label"=>"上周新增数据",
            //                   "data"=>111
            //               ),
            //              "pass_audit"=>array(
            //                   "label"=>"上周新增通过审核数",
            //                   "data"=>1111
            //               ),

            //         ),
            //         "month"=>array(
            //               "description"=>"本月的数据",
            //               "total"=>array(
            //                   "label"=>"本月新增数据",
            //                   "data"=>111
            //               ),
            //              "pass_audit"=>array(
            //                   "label"=>"本月新增通过审核数",
            //                   "data"=>1111
            //               ),

            //         ),
            //         "last_month"=>array(

            //         ),
            //         "year"=>array(

            //         ),
            //         "last_year"=>array(

            //         )
            //     )
            // );