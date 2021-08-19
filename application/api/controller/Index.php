<?php
namespace app\api\controller;
use think\Controller;
class Index extends Controller
{

//后台模板主页
public function index()
{
    return $this->fetch('/index');
}

}


