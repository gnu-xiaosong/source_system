<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//规则:('替换名','所在模块名/类名/方法名');
use  think\Route;


//管理员前端模版接口路由配置

//模版首页路由
Route::rule('/','index/Index/index');
//网站配置信息接口路由
Route::rule('getWebsiteInformation','index/Index/getWebsiteInformation');
//题库资源显示路由
Route::rule('getQu','index/Index/getQu');
//文档资源分页显示路由
Route::rule('getDoc','index/Index/getDoc');
//题目查询路由
Route::rule('searchQu','index/Index/searchQu');
//文章详情查询路由
Route::rule('getNewsDetail','index/Index/getNewsDetail');
//资源提交-------问答形式路由
Route::rule('answerSubmit','index/Index/answerSubmit');
//资源提交-------单一资源形式路由
Route::rule('singleSubmit','index/Index/singleSubmit');
//资源提交-------文件资源形式路由
Route::rule('fileSubmit','index/Index/fileSubmit');
//最新题库资源详情页接口路由
Route::rule('getQuSource','index/Index/getQuSource');
//文档资源详情页请求接口
Route::rule('getDocSource','index/Index/getDocSource');
//doc_id验证接口路由
Route::rule('ruler','index/Index/ruler');
//社区动态分页接口路由
Route::rule('getComments','index/Index/getComments');
//社区动态详情页接口路由
Route::rule('getCommunityDetail','index/Index/getCommunityDetail');
//网站幻灯片信息接口路由
Route::rule('getSlide','index/Index/getSlide');
//操作excel文件接口路由
Route::rule('excel','index/Tool/excel');
//图片文字识别接口路由
Route::rule('imageRecogition','index/Tool/imageRecogition');
//图片识别js版iframe接口路由
Route::rule('ImageRecogntionJS','index/Index/ImageRecogntionJS');
// 网站友情链接接口
Route::rule('getIndexFriendUrl','index/FriendIndex/getIndexFriendUrl');
// 获取前端各资源分类
Route::rule('getIndexCategory','index/CategoryIndex/getIndexCategory');
// 获取资讯列表--包含搜索接口
Route::rule('getNewsList','index/News/getNewsList');
// 获取图库列表--包含搜索接口
Route::rule('getPictureIndexList','index/PictureIndex/getPictureIndexList');
// 获取文档列表--包含搜索接口
Route::rule('getDocIndexList','index/DocIndex/getDocIndexList');










//管理员后台模版路由


//后台模版接口路由
Route::rule('admin','admin/Admin/admin');
//管理员登陆接口路由
Route::rule('admin_login','admin/Index/admin_login');
//网站配置信息显示接口路由
Route::rule('getWebAdminData','admin/Index/getWebAdminData');
//修改网站配置信息接口路由
Route::rule('setWebAdmin','admin/Index/setWebAdmin');
//上传log路由
Route::rule('updateLog','admin/Index/updateLog');
//撰写文章路由
Route::rule('setAdminArticle','admin/Index/setAdminArticle');
//请求文章列表路由
Route::rule('getArticleList','admin/Index/getArticleList');
//请求文章搜索列表路由
Route::rule('getSearchArticleList','admin/Index/getSearchArticleList');
//请求删除文章路由
Route::rule('delAdminAll','admin/Index/delAdminAll');
//请求删除文章路由
Route::rule('getAdminArticle','admin/Index/getAdminArticle');
//编辑文章路由
Route::rule('editAdminArticle','admin/Index/editAdminArticle');
//请求类别路由
Route::rule('getCategory','admin/Index/getCategory');
//请求用户信息接口路由
Route::rule('getAdminUserData','admin/Index/getAdminUserData');
//请求分类信息接口路由
Route::rule('getArticleCategoryData','admin/Index/getArticleCategoryData');
//修改资源库信息路由
Route::rule('getSourceCategoryData','admin/Index/getSourceCategoryData');
//请求邮件配置信息接口路由
Route::rule('getEmail','admin/Index/getEmail');
//修改邮件配置信息接口路由
Route::rule('setEmail','admin/Index/setEmail');
//发送邮件路由
Route::rule('sendMail','admin/Index/sendMail');
//请求支付配置信息路由
Route::rule('getPaySettingData','admin/Index/getPaySettingData');
//修改支付配置信息路由
Route::rule('setPaySettingData','admin/Index/setPaySettingData');
//请求后台用户列表信息路由
Route::rule('getUserList','admin/Index/getUserList');
//请求后台搜索用户列表信息路由
Route::rule('getSearchUserList','admin/Index/getSearchUserList');
//请求后台删除用户列表信息路由
Route::rule('delUserAll','admin/Index/delUserAll');
//请求用户信息路由
Route::rule('getUser','admin/Index/getUser');
//编辑保存用户信息路由
Route::rule('setUser','admin/Index/setUser');
//请求订单信息路由
Route::rule('getOrderList','admin/Index/getOrderList');
//搜索订单信息路由
Route::rule('getSearchOrderList','admin/Index/getSearchOrderList');
//批量删除订单信息路由
Route::rule('delOrderAll','admin/Index/delOrderAll');
//请求管理员信息路由
Route::rule('getAdmin','admin/Index/getAdmin');
//修改管理员信息路由
Route::rule('setAdmin','admin/Index/setAdmin');
//获取订单情况数接口路由
Route::rule('getOrderCount','admin/Index/getOrderCount');
//修改微信公众号信息配置路由
Route::rule('set_wechat_public','admin/Wechat/set_wechat_public');
//获取微信公众号信息配置路由
Route::rule('get_wechat_public','admin/Wechat/get_wechat_public');
//获取网站幻灯片路由
Route::rule('get_admin_slide','admin/Slide/get_admin_slide');
//删除网站幻灯片路由
Route::rule('delete_admin_slide','admin/Slide/delete_admin_slide');
//上传网站幻灯片路由
Route::rule('upload_admin_slide','admin/Slide/upload_admin_slide');
//获取友链列表
Route::rule('getFriendList','admin/Friend/getFriendList');
//修改友链
Route::rule('setFriendUrl','admin/Friend/setFriendUrl');
//添加友链
Route::rule('addFriendUrl','admin/Friend/addFriendUrl');
//添加友链
Route::rule('delFriendUrl','admin/Friend/delFriendUrl');
//单一资源请求列表接口
Route::rule('getBankSingleList','admin/Bank/getBankSingleList');
//单一资源删除资源接口
Route::rule('delBankSingle','admin/Bank/delBankSingle');
//单一资源添加资源接口
Route::rule('addBankSingle','admin/Bank/addBankSingle');
//单一资源修改资源接口
Route::rule('setBankSingle','admin/Bank/setBankSingle');
//问答资源请求列表接口
Route::rule('getBankAnswerList','admin/Bank/getBankAnswerList');
//获取问答资源类别信息请求列表接口
Route::rule('getBankAnswerCategory','admin/Bank/getBankAnswerCategory');
//删除问答资源接口
Route::rule('delBankAnswer','admin/Bank/delBankAnswer');
//搜索问答资源接口
Route::rule('getSearchBankAnswer','admin/Bank/getSearchBankAnswer');
//提交文本问答资源接口
Route::rule('addBankAnswer','admin/Bank/addBankAnswer');
//用户动态文章列表接口
Route::rule('getCommitList','admin/Commit/getCommitList');
//用户动态文章删除接口
Route::rule('delCommit','admin/Commit/delCommit');
//用户动态文章状态改变接口
Route::rule('commitPassAudit','admin/Commit/commitPassAudit');
//用户动态文章统计接口
Route::rule('commitStatistics','admin/Commit/commitStatistics');
//资源库分类请求接口
Route::rule('getSourceCategory','admin/Source/getSourceCategory');
//公共文件上传接口
Route::rule('publicUploadFile','admin/Common/publicUploadFile');
//资源上传请求接口
Route::rule('setSourceData','admin/Source/setSourceData');
//资源更新请求接口
Route::rule('updateSource','admin/Source/updateSource');
//资源分页请求接口
Route::rule('getSourceList','admin/Source/getSourceList');
//资源搜索请求接口
Route::rule('getSearchSource','admin/Source/getSearchSource');
//资源删除请求接口
Route::rule('delSource','admin/Source/delSource');
//资源数据单个请求接口
Route::rule('getSingleSource','admin/Source/getSingleSource');
//图片分类请求接口
Route::rule('getPictureList','admin/Picture/getPictureList');
//图片类别请求接口
Route::rule('getPictureCategory','admin/Picture/getPictureCategory');
//图片搜索请求接口
Route::rule('getSearchPicture','admin/Picture/getSearchPicture');
//图片删除请求接口
Route::rule('delPicture','admin/Picture/delPicture');
// 文档列表请求接口
Route::rule('getDocList','admin/Doc/getDocList');
// 文档类别请求接口
Route::rule('getDocCategory','admin/Doc/getDocCategory');
// 搜索文档列表请求接口
Route::rule('getSearchDoc','admin/Doc/getSearchDoc');
// 删除文档请求接口
Route::rule('delDoc','admin/Doc/delDoc');
// 修改文档请求接口
Route::rule('setDocSingle','admin/Doc/setDocSingle');
// 请求模版列表接口
Route::rule('getTemplateList','admin/Template/getTemplateList');
// 请求模版修改接口
Route::rule('setTemplate','admin/Template/setTemplate');





//微信公众号接口
Route::rule('wechat','api/Wechat/wechat');
//文件接口
Route::rule('file','api/File/file');

//支付接口路由

//聚合支付接口路由
Route::rule('pay','pay/Index/pay');  
//微信支付路由
Route::rule('WechatPay','pay/WechatPay/WechatPay');  //微信支付接口路由
Route::rule('wechatPay_notify','pay/WechatPay/wechatPay_notify');  //微信支付异步通知地址路由
Route::rule('wechatPay_return','pay/WechatPay/wechatPay_return');  //微信支付同步通知地址路由
//支付宝支付
Route::rule('alipay','pay/Alipay/alipay');   //支付宝支付接口路由
Route::rule('alipay_notify','pay/Alipay/alipay_notify');  //支付宝异步通知地址
Route::rule('alipay_return','pay/Alipay/alipay_return');    //支付同步通知地址
Route::rule('AlipayOperationRefund','pay/Alipay/AlipayOperationRefund');    //支付宝退款操作接口
Route::rule('AlipayOperationCheck','pay/Alipay/AlipayOperationCheck');    //请求查询订单操作接口


//用户路由配置

//用户注册接口路由
Route::rule('register','user/Index/register');   
//用户注册信息校验接口路由
Route::rule('isValid','user/Index/isValid');   
//用户登陆接口路由
Route::rule('user_login','user/Index/user_login');   
//用户动态发表接口路由
Route::rule('announce','user/Index/announce');   
//操作用户积分规则接口路由
Route::rule('CoinRuler','user/Index/CoinRuler');   
//获取qq信息接口路由
Route::rule('getQQ','user/Index/getQQ');   
//获取qq信息接口路由
Route::rule('getUserData','user/Index/getUserData');   
//订单信息查询接口路由
Route::rule('getIndexOrder','user/Index/getIndexOrder');










