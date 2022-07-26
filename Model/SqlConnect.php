<!--
    草稿 :P
-->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
// echo "连接成功";