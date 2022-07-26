<?php require_once "D:/xampp/htdocs/myPhpPro/Model/common.php";?>
<?php require_once "D:/xampp/htdocs/myPhpPro/Controller/Response.php";?>
<?php
header('Content-Type:application/json; charset=utf-8');
$userId = $_POST['userId'];
$managerId = $_POST['managerId'];
$ability_1 = $_POST['ability_1'];
$ability_2 = $_POST['ability_2'];
$ability_3 = $_POST['ability_3'];
$con->autocommit(false);
$data= [];
$sql_dafen = "INSERT INTO dafen(date,manager_id,user_id,ability_1,ability_2,ability_3,grade) 
VALUES (CURDATE(),'$managerId','$userId','$ability_1','$ability_2','$ability_3',('$ability_1'+'$ability_2'+'$ability_3')/3)";

$sql = "SELECT * FROM jixiao WHERE jixiao.manager_id ='".$managerId."' AND QUARTER(jixiao.`data`) = QUARTER(CURDATE()) AND YEAR(jixiao.`data`) = YEAR(CURDATE())";

$result = $con->query($sql);
$msg = '';
if ( $result->num_rows > 0){
    $msg = '$result->num_rows > 0';
    $sql_jixiao = "UPDATE jixiao SET grade = (SELECT AVG(grade) FROM dafen WHERE dafen.manager_id ='".$managerId."' AND QUARTER(dafen.date) = QUARTER(CURDATE()) 
AND YEAR(dafen.date) = YEAR(CURDATE())), `data`=LAST_DAY(MAKEDATE(EXTRACT(YEAR FROM CURDATE()),1) + interval QUARTER(CURDATE())*3-1 month) 
WHERE jixiao.manager_id='".$managerId."' AND QUARTER(jixiao.`data`) = QUARTER(CURDATE())
AND YEAR(jixiao.`data`) = YEAR(CURDATE())";
}else{
    $sql_jixiao = "INSERT INTO jixiao(jixiao.manager_id,jixiao.grade,jixiao.`data`) VALUES('$managerId',(SELECT AVG(grade) FROM dafen WHERE dafen.manager_id ='".$managerId."' AND QUARTER(dafen.date) = QUARTER(CURDATE()) 
AND YEAR(dafen.date) = YEAR(CURDATE())),LAST_DAY(MAKEDATE(EXTRACT(YEAR FROM CURDATE()),1) + interval QUARTER(CURDATE())*3-1 month))";
}
$result_dafen=$con->query($sql_dafen);
$result_jixiao=$con->query($sql_jixiao);

if ($result_dafen  && $result_jixiao) {
    $con->commit();
    $res = Response::getJson(200,$msg,$data);
}
else{
    $con->rollback();
    $res = Response::getJson(333,$result_jixiao,$data);
}