<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$dept_id = $_POST['dept_id'];
$data = $_POST['data'];
$sql = "SELECT `user`.user_dept_id,`user`.realName,ability_1,ability_2,ability_3,dafen.grade FROM dept,`user`,dafen WHERE dept.dept_leader_id = dafen.manager_id AND dafen.user_id = `user`.id 
        AND QUARTER(dafen.date)=QUARTER('".$data."') AND YEAR(dafen.date) = YEAR('".$data."') AND dept.dept_id = '".$dept_id."'";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('dept_id' => $rows['user_dept_id'], 'realName' => $rows['realName'],'ability_1' => $rows['ability_1'],
        'ability_2' => $rows['ability_2'],'ability_3' => $rows['ability_3'],'grade' => $rows['grade']);
}
$res = Response::getJson(200,'success',$data);