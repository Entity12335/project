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
    $log = $pdo->prepare('SELECT * FROM users WHERE  `ID` = :ID');
    $log->bindParam(':ID', $ID);
    $ID = $_GET['ID'];
    $log->execute();
    $log->setFetchMode(PDO::FETCH_ASSOC);
    //print_r($log->fetchAll());  :)
    foreach($log->fetchAll() as $k_array => $v_array) {
        // echo $v_array['Email'];
        // echo $v_array['Login'];
        echo ($k_array + 1).'<br>';
        foreach($v_array as $key => $val){
            echo $key.': '.$val.'<br>';
        }
    }

    // $country = 'China';
    // $stmt->execute();
    // $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // foreach($stmt->fetchAll() as $k_array => $v_array) {
    //     echo ($k_array + 1).'<br>';
    //     // echo $v_array['email'];
    //     foreach($v_array as $key => $val) {
    //         echo $key.': '.$val.'<br>';
    //     }
    //     echo '<br>';
    // }
} catch(PDOException $e) {
    echo $e->getMessage();
}
    
?>