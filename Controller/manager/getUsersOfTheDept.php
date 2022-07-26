<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$deptId = $_POST['deptId'];
$sql = "SELECT id,realName FROM `user` WHERE user_dept_id ='".$deptId."'";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('id' => $rows['id'], 'realName' => $rows['realName']);
}
$res = Response::getJson(200,'success',$data);
