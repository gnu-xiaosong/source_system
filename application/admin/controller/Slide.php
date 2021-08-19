<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Session;
use think\View;

class Slide extends Controller
{

//上传幻灯片图片接口

public function upload_admin_slide(){
     
    $file=$_FILES["file"];
    //接收传来的数据流文件
    if($_FILES["file"]["error"] > 0)
    {
       //出现错误
     $data=array(
      "code"=>100,
      "msg"=>$_FILES["file"]["error"]
     );
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
   //上传ok
   
   //保存图片
    $temp = explode(".", $file["name"]);
    $file_type=end($temp);//文件类型

    $file_root_path= $_SERVER['DOCUMENT_ROOT']."/upload/slide/";   

    //文件名
    $file_name="slide".date("YmdHis").".".$file_type;
    //保存
    if(move_uploaded_file($file["tmp_name"], $file_root_path.$file_name)){
    //把文件存储路径存放在数据表中
   //写入数据库表中
   $result=Db::table("xs_web_slide")->insert(["img_path"=>"/upload/slide/".$file_name,"description"=>"幻灯片","tip_word"=>"幻灯片"]);
   if($result==1){
      $data=array(
      "code"=>200,
      "msg"=>"上传成功！",
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     $data=array(
      "code"=>300,
      "msg"=>"插入数据库失败！",
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   }
}



//删除幻灯片接口
public function delete_admin_slide(){
//获取id值
$id=(int)$_GET["id"];

//删除
$slide=Db::table("xs_web_slide")->delete($id);
if(empty($slide)){
//删除失败
$data=array(
      "code"=>100,
      "msg"=>"删除失败！"
     );
   return  json_encode($data, JSON_UNESCAPED_UNICODE);
}

$data=array(
      "code"=>200,
      "msg"=>"删除成功！"
     );
 return  json_encode($data, JSON_UNESCAPED_UNICODE);
}


//获取幻灯片信息
public  function get_admin_slide(){

$slide=Db::table("xs_web_slide")->select();
for($i = 0; $i < count($slide); $i++){
  
  $slide[$i]["img_path"] ="http://".$_SERVER["HTTP_HOST"].$slide[$i]["img_path"];
}

if(empty($slide)){
//出现错误
 $data=array(
      "code"=>100,
      "msg"=>"slide不存在！",
      "data"=>$slide
     );
   return  json_encode($data, JSON_UNESCAPED_UNICODE);
}

$data=array(
      "code"=>200,
      "description"=>"这是后台幻灯片信息",
      "data"=>$slide
     );
   return  json_encode($data, JSON_UNESCAPED_UNICODE);
}

}

