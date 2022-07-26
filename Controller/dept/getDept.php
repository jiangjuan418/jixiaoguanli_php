<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$sql = "select dept_id,dept_name,id,realName,dept_phone,dept_email,dept.creation_time,
       dept.`describe`,address from dept,`user` WHERE dept.dept_leader_id = `user`.id";
$sql_1 = "SELECT * from dept WHERE dept_leader_id is NULL";
$result=$con->query($sql);
$result_1=$con->query($sql_1);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('dept_id' => $rows['dept_id'], 'dept_name' => $rows['dept_name'],'dept_leader_id' => $rows['id'],
        'dept_leader' => $rows['realName'],'dept_phone' => $rows['dept_phone'],
        'dept_email' => $rows['dept_email'],'creation_time'=>$rows['creation_time'],
        'describe' => $rows['describe'], 'address' => $rows['address']);
}
while ($rows = $result_1->fetch_assoc()) {
    $data[] = array('dept_id' => $rows['dept_id'], 'dept_name' => $rows['dept_name'],'dept_leader_id' => null,
        'dept_leader' => null,'dept_phone' => $rows['dept_phone'],
        'dept_email' => $rows['dept_email'],'creation_time'=>$rows['creation_time'],
        'describe' => $rows['describe'], 'address' => $rows['address']);
}
$res = Response::getJson(200,'success',$data);