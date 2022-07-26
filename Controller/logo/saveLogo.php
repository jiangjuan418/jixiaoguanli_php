<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$file = $_FILES['file'];
$f="E:/my_vue_project/jixiaoguanli/static/".$file['name'];
$data= [];

try {
    if ($file['error']==0) { //上传图像文件到指定目录
        move_uploaded_file($file['tmp_name'],$f);
        $data = ['file'=>$f];
    }
    $res = Response::getJson(200,'success',$data);
} catch (Exception $e) {
    $res = Response::getJson(200,$e->getMessage(),$data);
}