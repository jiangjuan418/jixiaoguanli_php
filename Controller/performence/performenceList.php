<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$data = $_POST['data'];
$sql = "SELECT manager_id,dept_id,dept_name,realName,grade FROM jixiao,`user`,dept 
        WHERE jixiao.manager_id=dept.dept_leader_id AND jixiao.manager_id=`user`.id 
        AND QUARTER(jixiao.`data`)=QUARTER('".$data."') AND YEAR(jixiao.`data`)=YEAR('".$data."') ORDER BY grade";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('dept_id' => $rows['dept_id'], 'dept_name' => $rows['dept_name'],'manager_id' => $rows['manager_id'],
        'managerName' => $rows['realName'],'grade' => $rows['grade']);
}
$res = Response::getJson(200,'success',$data);