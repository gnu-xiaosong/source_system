<?php

namespace app\token\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller{
  
    // 模块方法token验证
     public function run(){
        
       header("Access-Control-Allow-Origin: *");
       header("Access-Control-Allow-Credentials : true");
       header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");

        $request = Request::instance();
        // 需要token验证模块
        $require_module_array=[
            "admin"
        ];
        // 忽略action操作名称------都为小写
        $ignore_action_array = [
            "getwebsiteinformation",
            "admin_login",
            "gettemplatelist",
            "admin"
        ];
        
        // 获取当前请求模块
        $module = $request->module();
        $action = $request->action();

         // 忽略action操作方法验证
        if(in_array($action, $ignore_action_array)){
            return true;
        }


        if(in_array($module, $require_module_array)){
            // 模块-------验证token
            $token = $request->header('token');
             
            $is = Db::name("admin")->where("token", $token)->find();
            
            if($is == null || !isset($token)){
                // token验证失败------拦截该请求
                echo "<h4>已拦截非法请求！<h4>";
                exit();
            }
        }    
     }
  
}