<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$sql = "SELECT dept_id,dept_name FROM dept WHERE dept_leader_id IS NULL";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('dept_id' => $rows['dept_id'], 'dept_name' => $rows['dept_name']);
}
$res = Response::getJson(200,'success',$data);