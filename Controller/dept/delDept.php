<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$dept_id = $_POST['dept_id'];
$dept_leader_id = $_POST['dept_leader_id'];
$sql_1 = "UPDATE `user` SET user_dept_id=NULL WHERE user_dept_id = '".$dept_id."'"; // 外键处理
$sql = "DELETE FROM dept WHERE dept_id = '".$dept_id."'";
$sql_del_dafen = "DELETE FROM dafen WHERE manager_id = '".$dept_leader_id."'";
$sql_del_jixiao = "DELETE FROM jixiao WHERE manager_id = '".$dept_leader_id."'"; // 将表中已不是经理的记录删掉
$con->autocommit(false); // 设置非自动提交
$result_dafen =$con->query($sql_del_dafen);
$result_jixiao =$con->query($sql_del_jixiao);
$result_1 =$con->query($sql_1);
$result =$con->query($sql);
$data= [];
if ($result && $result_1 && $result_dafen && $result_jixiao){
    mysqli_commit($con);
    $res = Response::getJson(200,'删除成功',$data);
} else{
    //回滚事务
    mysqli_rollback($con);
    $res = Response::getJson(30004,'删除失败',$data);
}