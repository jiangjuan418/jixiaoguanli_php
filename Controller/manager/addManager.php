<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$dept_id = $_POST['dept_id'];
$manager_id = $_POST['manager_id'];
$con->autocommit(false); // 显示地设置非自动提交，在 MySQL 命令行的默认设置下，事务都是自动提交的，即执行 SQL 语句后就会马上执行 COMMIT 操作。
$sql = "UPDATE dept SET dept_leader_id = '".$manager_id."' where dept_id = '".$dept_id."'";
//$sql_jixiao = "INSERT INTO jixiao(manager_id) VALUES('$manager_id')";
$result =$con->query($sql);
//$result_jixiao = $con->query($sql_jixiao);
$newId = mysqli_insert_id($con);
$data= [];
if ($result){
    $con->commit();
    $res = Response::getJson(200,'任命成功',$data);
} else{
    $con->rollback();
    $res = Response::getJson(30004,'任命失败',$data);
}