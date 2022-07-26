<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$account = $_POST['username'];
$password = $_POST['password'];
$role= $_POST['role'];
$data= [];
$sql = "SELECT realName,id FROM `user` WHERE account='"."$account"."' AND `password`='".$password."' AND isAdmin='".$role."'";
$result =$con->query($sql);
if ($result->num_rows > 0){
    $rows = $result->fetch_assoc();
    $data = array("realName" => $rows["realName"],'userId' => $rows['id']);
    $res = Response::getJson(200,'success',$data);
}else{
//    $data = array("realName" => null,'userId' => null);
    $res = Response::getJson(333,'登陆失败',$data);
}
//echo json_encode($res);