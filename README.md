# 资源管理系统

## 说明

资源管理系统，是一款集中前后端配套的资源管理系统。集成文档，题库，图片，资讯，文章等多功能的场景式系统管理，能适应多种业务场景需求。
采用前后端分离全栈开发，模块化开发。前端模版式开发，社区正在积极建设开发中，欢迎开发者入驻开发模版及插件。

## 技术栈

- vue
- php
- nodejs
- 模块化
- thinkphp
- vue-cli
- mysql

## 目录结构

├─application 接口目录
│ ├─index 首页接口目录
│ ├─admin 管理员后台接口目录
│ ├─user 用户接口目录
│ ├─pay 支付接口目录
│ ├─token token 验证接口目录
│ ├─api 公共接口目录
│ └─route.php 路由配置文件
├─admin 后台管理文件目录
│  
├─upload 文件上传目录
│ ├─image 图片保存目录
│ ├─logo logo 图片保存目录
│ ├─other 文件保存目录
│ ├─slide 幻灯片保存目录
│ ├─tmp 临时存放目录——可以定期删除,节省空间
│
│
├─template 前端模版目录
│ ├─m1 模版一
│ └─ ....
├─tool 工具目录
│
├─public WEB 目录（对外接口访问目录）
│ ├─index.php 入口文件
│ ├─router.php 快速测试文件
│ ├─install 系统程序安装引导文件目录
│ │ ├─config.db.php 系统数据库配置文件(修改数据库信息在这里修改)
│ │ └─install.lock 安装锁文件(需要重新安装程序时删除该文件和 config.db.php 文件即可)
│
├─thinkphp thinkphp 核心类库源码目录
│
├─vendor 第三方类库文件目录
├─extend 扩展类库目录
├─runtime 应用的运行时目录（可写，可定制）
├─build.php 自动生成定义文件（参考）
├─composer.json composer 定义文件
├─LICENSE.txt 授权说明文件
├─README.md README 文件
├─index.phhp 项目入口文件

## 新添功能特性

- 模版化管理
- 文档管理
- 图库管理
- 题库管理
- 资讯管理

## 体验地址

[体验地址](http://zy.xskj.store)

## 项目截图

- 首页:
  [![yoXVtP.jpg](https://s3.ax1x.com/2021/02/21/yoXVtP.jpg)](https://imgchr.com/i/yoXVtP)
  [![yoXZff.jpg](https://s3.ax1x.com/2021/02/21/yoXZff.jpg)](https://imgchr.com/i/yoXZff)
- 后台:
  [![yoOqm9.jpg](https://s3.ax1x.com/2021/02/21/yoOqm9.jpg)](https://imgchr.com/i/yoOqm9)
  [![yoXimd.jpg](https://s3.ax1x.com/2021/02/21/yoXimd.jpg)](https://imgchr.com/i/yoXimd)

## 下载地址----请下载新版本

- v1.0 程序下载:[下载](https://fusong.lanzous.com/b01c4sc8b)密码:69kz
- v2.0 程序下载:[下载](https://fusong.lanzous.com/b01c9c2gd)密码:a0ym
- v2.0.1 程序下载: [下载](https://fusong.lanzoui.com/iicr5qtgegb)
- v2.1.. 程序下载: [下载](https://fusong.lanzoui.com/iagPTqx8fuh)
- v3.0 程序下载: [下载](https://fusong.lanzoui.com/inwUBsut4pg)
- 资源包:[下载](https://fusong.lanzous.com/b01c4vzkj)密码:6hvm

## 安装说明

- 注意：安装成功后如果发现数据库表中没有
  xs_user 表，需要在 sql 中执行以下 sql 语句添加 xs_user 表

```sql
CREATE TABLE `xs_user` (
  `id` int(11) NOT NULL COMMENT '用户id值',
  `username` varchar(30) NOT NULL COMMENT '用户账号',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `level` int(1) NOT NULL COMMENT '用户级别(0:超级管理员;1:中级用户;2:普通用户)',
  `QQ` varchar(255) NOT NULL COMMENT 'QQ账号',
  `email` varchar(30) NOT NULL COMMENT '用户注册邮箱',
  `status` int(11) NOT NULL COMMENT '用户状态',
  `cores` int(11) NOT NULL COMMENT '用户积分',
  `ip` varchar(20) NOT NULL COMMENT '用户登录ip',
  `number` int(11) NOT NULL COMMENT '用户登录次数',
  `weixin_token` varchar(30) NOT NULL COMMENT '用户微信公众号调用token',
  `weixin_key` varchar(30) NOT NULL COMMENT '用户微信公众号调用安全秘钥',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `token` varchar(255) NOT NULL COMMENT '用户token'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息表';
```

### 环境

- php>7.0(建议 php7.4)
- 安装相关拓展:
- 给 template 目录读写权限

### 安装方法

- 把源码包解压放到网站跟目录，然后访问域名即可进入安装页面。根据页面操作填写数据库信息即可。
  注意:_如果安装后发现进入数据库中查看没有 xs_user 表，将/public/install/localhost.sql 自己导入到相应数据即可_
- 后台地址为:http://域名/public/index.php/admin
  (默认管理员账号:admin,密码:xskj,请安装装后自行修改管理员信息)

## 目录结构

## 日志更新

- 2021-4-03 修复导入 excel 文件 bug
- 2021-4-06 添加微信公众号查题接口，修复后台管理登陆 bug,修复 logo 上传,幻灯片上传 bug,优化数据库表结构。
- 2021-4-06 修复微信公众号接口 bug,支持文本，图片，链接，地图接口功能，
- 2021-6-29 整合优化了数据表，修复了查题 bug
- 2021-7-02 添加驾校题库，中小学题库等 40 万(由于我也是花钱买的，所以此资源付费，需要的联系我)
