<?php
//这是公共接口类
namespace app\admin\controller;

use think\Controller;
use think\Db;



class Common extends Controller
{

//封面图上传接口
public function publicUploadFile(){
    /*
    *request :
    *@param: file  FormData 数据流对象
    *retrun :
    *@param: data string 识别文字

    */

    //参数接收
    $file=$_FILES["common"];

    //存放文件根路径
    $tmp_path=$_SERVER['DOCUMENT_ROOT']."/upload/tmp";   //文件存放目录
    $date=date("YmdHis");


    //获取图片后缀
    $file_type_arr=explode(".", $file["name"]);
    $file_type=end($file_type_arr);
    //保存文件路径---前缀cover
    $image_path=$tmp_path.'/image/'.'cover'.$date.'.'.$file_type;


    if (move_uploaded_file($file["tmp_name"], $image_path)) {
        //echo "文件上传成功！";

        $data=[
   'file_path'=>"/upload/tmp/image/".'cover'.$date.'.'.$file_type,
   'classify'=>"公共库",
   'file_type'=>$file_type,
   'status'=>1,
   'user'=>"未知",
   'file_size'=>$file["size"],   //b为单位
   'description'=>"这是公共库文件上传文件",
   'user_defined_label'=>"公共库",
   'doc_id'=>1
   ];
        //添加数据
        $result=Db::name("upload_file_source")->insert($data);
        if ($result==1) {
            //返回数据封装
            $data=array(
            "code"=>200,
            "message"=>"文件上传成功！",
             "data"=>array(
                   "url"=>"http://".$_SERVER["HTTP_HOST"]."/upload/tmp/image/".'cover'.$date.'.'.$file_type
             ));

            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }
}
}