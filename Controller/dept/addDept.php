<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$deptName = $_POST['deptName'];
$deptLeader = $_POST['deptLeader']==='' ? null : $_POST['deptLeader'];
$deptPhone = $_POST['deptPhone']==='' ? null : $_POST['deptPhone'];
$deptEmail = $_POST['deptEmail']==='' ? null : $_POST['deptEmail'];
$deptAddress = $_POST['deptAddress']==='' ? null : $_POST['deptAddress'];
$deptDescribe = $_POST['deptDescribe']==='' ? null : $_POST['deptDescribe'];
$con->autocommit(false); // 设置非自动提交
if ($deptLeader===null){ // 外键约束
    $sql = "INSERT INTO dept (dept_name,dept_leader_id,dept_phone,dept_email,`describe`,address) 
VALUES ('$deptName',null,'$deptPhone','$deptEmail','$deptDescribe','$deptAddress')";
}else{
    $sql = "INSERT INTO dept (dept_name,dept_leader_id,dept_phone,dept_email,`describe`,address) 
VALUES ('$deptName','$deptLeader','$deptPhone','$deptEmail','$deptDescribe','$deptAddress')";
}
$result =$con->query($sql);
$newId = mysqli_insert_id($con);
$sql_2 = "UPDATE `user` SET user_dept_id = '".$newId."' where id='".$deptLeader."'";
$result_2 =$con->query($sql_2);
$data= [];
if ($result && $result_2){
    $con->commit();
    $res = Response::getJson(200,'添加成功',$data);
} else{
    $con->rollback();
    $res = Response::getJson(30004,'添加失败',$data);
}