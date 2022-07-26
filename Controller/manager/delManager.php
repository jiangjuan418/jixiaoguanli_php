<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$dept_id = $_POST['dept_id'];
$manager_id = $_POST['manager_id'];
$sql = "UPDATE dept SET dept_leader_id=NULL WHERE dept_id = '".$dept_id."'";
$sql_check_dafen = "DELETE FROM dafen WHERE dafen.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$dept_id."')";
$sql_check_jixiao = "DELETE FROM jixiao WHERE jixiao.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$dept_id."')";
$con->autocommit(false); // 设置非自动提交
$result_dafen =$con->query($sql_check_dafen);
$result_jixiao =$con->query($sql_check_jixiao);
$result =$con->query($sql);
$data= [];
if ($result && $result_jixiao && $result_dafen){
    mysqli_commit($con);
    $res = Response::getJson(200,'卸任成功',$data);
} else{
    //回滚事务
    mysqli_rollback($con);
    $res = Response::getJson(30004,'卸任失败',$data);
}