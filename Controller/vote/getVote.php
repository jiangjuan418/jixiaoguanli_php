<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$date = $_POST['date'];
$userId = $_POST['userId'];
$sql = "SELECT dafen.manager_id,`user`.realName,dafen.ability_1,dafen.ability_2,dafen.ability_3,dafen.grade,jixiao.grade as total_grade FROM
dafen,`user`,jixiao WHERE jixiao.manager_id = dafen.manager_id AND jixiao.manager_id = `user`.id AND
QUARTER(jixiao.`data`)=QUARTER('".$date."') AND YEAR(jixiao.`data`) = YEAR('".$date."') AND
QUARTER(dafen.date)=QUARTER('".$date."') AND YEAR(dafen.date) = YEAR('".$date."')AND dafen.user_id = '".$userId."'";
$result=$con->query($sql);
$data= array();
while ($rows = $result->fetch_assoc()) {
    $data[] = array('manager_id' => $rows['manager_id'], 'manager_name' => $rows['realName'],'manager_id' => $rows['manager_id'],
        'ability_1' => $rows['ability_1'],'ability_2' => $rows['ability_2'],'ability_3' => $rows['ability_3'],
        'grade' => $rows['grade'],'total_grade' => $rows['total_grade']);
}
$res = Response::getJson(200,'success',$data);