<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$date = $_POST['date'];
$userId = $_POST['userId'];
$sql = "SELECT `user`.realName,dept.dept_leader_id,dept.dept_name FROM `user`,dept WHERE `user`.id = dept.dept_leader_id AND dept.dept_leader_id NOT IN 
(SELECT dafen.manager_id FROM dafen WHERE QUARTER(date)=QUARTER('".$date."') and YEAR(date)=YEAR('".$date."') AND dafen.user_id='".$userId."')";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('manager_id' => $rows['dept_leader_id'], 'manager_name' => $rows['realName'],'dept_name' => $rows['dept_name']);
}
$res = Response::getJson(200,'success',$data);