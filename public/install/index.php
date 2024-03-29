<?php

?>

<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>安装向导-小松科技</title>
<link rel="icon" href="favicon.ico" type="image/ico">
<meta name="keywords" content="开源免费的程序安装框架">
<meta name="description" content="便捷，快速，高效，微小">
<meta name="author" content="yinqi">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/materialdesignicons.min.css" rel="stylesheet">
<link href="css/style.min.css" rel="stylesheet">
</head>
  <style>
    body{
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }
      .w {
            width: 1000px;
            margin: 20px auto;
        }
        
        .main {
          background-color: #ffffff;
            box-shadow: 2px 2px 2px 2px #c8c8d0;
        }

        .title{
          text-align: center;
        }
        
        .content{
          padding: 10px 70px;

        }
       
        .content input{
          width: 500px;
        }

        .form-group1{
          text-align: center;
        }
  </style>
<body>
<div class="main w">
   <div class="title">
      <h3><center>安装配置</center></h3>
   </div>
   <div class="content">
                <div class="tab-content">
                <div class="tab-pane active">
                  
                  <form action="get.php" method="post" name="edit-form" class="edit-form">
                    <div class="form-group">
                      <label for="web_site_title">数据库地址</label>
                      <input class="form-control" type="text" id="web_site_title" name="db_host" value="localhost"  >
                      <small class="help-block">本机地址默认：<code>localhost</code></small>
                    </div>
                    
                                      
                    <div class="form-group">
                      <label for="web_site_title">数据库端口</label>
                      <input class="form-control" type="text" id="web_site_title" name="db_port" value="3306" >
                        <small class="help-block">端口号默认：<code>3306</code></small>
                    </div>
                    
                     <div class="form-group">
                      <label for="web_site_title">数据库名</label>
                      <input class="form-control" type="text" id="web_site_title" name="db_name" value="question" >
                        <small class="help-block"><code>填写指定的数据库</code></small>
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="web_site_title">数据库用户名</label>
                      <input class="form-control" type="text" id="web_site_title" name="db_user" value="" >
                    </div>
                    
                    <div class="form-group">
                      <label for="web_site_title">数据库密码</label>
                      <input class="form-control" type="text" id="web_site_title" name="db_password" value="" >
                    </div>
                    
                                        <div class="form-group">
                      <label for="web_site_title">网站名称</label>
                      <input class="form-control" type="text" id="web_site_title" name="web_title" value=""  >
                  
                    </div>
                    
                    <div class="form-group">
                      <label for="web_site_title">网站域名</label>
                      <input class="form-control" type="text" id="web_site_title" name="web_url" value='<?php echo $_SERVER["HTTP_HOST"]?>'>
                  <small class="help-block"><code>系统已默认检测到您的域名</code></small>
                    </div>
                    
                                      
                    <div class="form-group">
                      <label for="web_site_title">网站关键词</label>
                      <input class="form-control" type="text" id="web_site_title" name="web_keyword" value="" >
                      
                    </div>
                    <div class="form-group">
                      <label for="web_site_description">站点描述</label>
                      <textarea class="form-control" id="web_site_description" rows="5" name="web_description" placeholder="请输入站点描述" ></textarea>
                      <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
                    </div>
                       <small class="help-block"><code>管理员设置</code></small>
                     <div class="form-group">
                      <label for="web_site_title">管理员账号</label>
                      <input class="form-control" type="text" id="web_site_title" name="admin_user" value="" >
                    </div>
                    
                    <div class="form-group">
                      <label for="web_site_title">管理员密码</label>
                      <input class="form-control" type="text" id="web_site_title" name="admin_password" value="" >
                    </div>
                    <div class="form-group">
                      <label for="web_site_title">管理员QQ</label>
                      <input class="form-control" type="text" id="web_site_title" name="admin_qq" value="" >
                    </div>
                    <div class="form-group">
                      <label for="web_site_title">管理员邮箱</label>
                      <input class="form-control" type="text" id="web_site_title" name="admin_email" value="" >
                    </div>
                    <div class="form-group1">
                      <button type="submit" class="btn btn-primary m-r-5" >开始安装</button>
                 
                    </div>
                 
                  </form>
                  
                </div>
              </div>
   </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>