<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$deptName = $_POST['deptName'];
$deptId = $_POST['deptId'];
$deptLeader = $_POST['deptLeader'];
$deptPhone = $_POST['deptPhone'];
$deptEmail = $_POST['deptEmail'];
$deptAddress = $_POST['deptAddress'];
$deptDescribe = $_POST['deptDescribe'];
$con->autocommit(false); // 设置非自动提交
$sql = "UPDATE dept SET dept_name='".$deptName."',dept_leader_id='".$deptLeader."',dept_phone='".$deptPhone.
    "',dept_email='".$deptEmail."',`describe`='".$deptDescribe."',address='".$deptAddress."' where dept_id='".$deptId."'";
$sql_check_dafen = "DELETE FROM dafen WHERE dafen.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$deptId."')";
$sql_check_jixiao = "DELETE FROM jixiao WHERE jixiao.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$deptId."')";
$result_dafen =$con->query($sql_check_dafen);
$result_jixiao =$con->query($sql_check_jixiao);
$result =$con->query($sql);
$data= [];
if ($result_jixiao && $result_dafen && $result){
    mysqli_commit($con);
    $res = Response::getJson(200,'修改成功',$data);
} else{
    mysqli_rollback($con);
    $res = Response::getJson(30004,'修改失败',$data);
}