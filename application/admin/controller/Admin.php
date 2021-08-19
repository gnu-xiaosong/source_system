<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Session;

class Admin extends Controller
{
   //后台模版接口
  public function admin()
  {
    //模版选择
    $this->redirect('/admin');
  }

}

