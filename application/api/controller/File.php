<?php
namespace app\api\controller;
use think\Controller;
class File extends Controller
{

//文件下载
public function file()
{
    
    $filename =$_SERVER['DOCUMENT_ROOT']."/test.docx";
    $handle= fopen($filename, "r");

    $contents = fread($handle, filesize($filename));
    fclose($handle);

    echo $contents;
}
}


