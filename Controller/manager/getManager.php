<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$sql = "SELECT id,realName,dept_name,dept_id,sex,age,`user`.email,phoneNumber,`user`.adress FROM `user`,dept WHERE id = dept_leader_id";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('manager_id' => $rows['id'], 'manager_name' => $rows['realName'],
        'dept_name' => $rows['dept_name'],'dept_id' => $rows['dept_id'],'manager_sex' => $rows['sex'],
        'manager_age' => $rows['age'],'manager_number'=>$rows['phoneNumber'],
        'manager_address' => $rows['adress'],'manager_email' => $rows['email']);
}
$res = Response::getJson(200,'success',$data);