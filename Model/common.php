<?php
$servername = "localhost";
$username = "root"; //用户名
$password = ""; //密码
$dbname = "jixiaoguanli"; //对应的数据库
 
// 创建连接 连接在脚本执行完后会自动关闭。也可以手动关闭$conn->close();
$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("数据库连接失败: " . $con->connect_error);
}
