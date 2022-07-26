<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$dept_id = $_POST['dept_id'];
$manager_id = $_POST['manager_id'];
$selected_manager_id = $_POST['selected_manager_id'];
$sql_2 = "UPDATE dept SET dept_leader_id='".$selected_manager_id."' where dept_id = '".$dept_id."'";
$sql_check_dafen = "DELETE FROM dafen WHERE dafen.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$dept_id."')";
$sql_check_jixiao = "DELETE FROM jixiao WHERE jixiao.manager_id = (SELECT dept_leader_id FROM dept WHERE dept_id = '".$dept_id."')";
$result_dafen =$con->query($sql_check_dafen);
$result_jixiao =$con->query($sql_check_jixiao);
$result_2 =$con->query($sql_2);
$data= [];
if ($result_2 && $result_dafen && $result_jixiao){
    mysqli_commit($con);
    $res = Response::getJson(200,'修改成功',$data);
} else{
    mysqli_rollback($con);
    $res = Response::getJson(30004,'修改失败',$data);
}