<?php
$host = "localhost";
$db_port = 3306;
$db_user = "root";
$db_password = "";
$db_name = "wikipizza";

$dsn = 'mysql:host='.$host.';port='.$db_port.';dbname='.$db_name; // Data Source Name

//tu kończył by sie connect

try {
    $pdo = new PDO($dsn, $db_user, $db_password);
} catch(PDOException $e) {
    echo $e->getMessage();
}

try{
$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute(); // wykonuje jakotoako XD
}catch(PDOException $e){
    echo $e->getMessage();
}
foreach($stmt->fetchAll() as $v) {
    var_dump($v);
}
?>