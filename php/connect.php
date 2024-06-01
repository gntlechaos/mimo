<?php

function connect($target){
    
    if($target == 'mimo'){

        $db = 'u187041469_mimo';
        $user = 'u187041469_mimo_backend';
        $pass = 'sNfj&U%Su&#V9a@*RH&u%67RE';

    } elseif($target == 'interposto') {

        $db = 'u187041469_database';
        $user = 'u187041469_internal';
        $pass = 'sr^ZwMHKj&a^8Qv#im%$#r7sq*T47M';

    }
    
    $host = '45.152.44.204';
    $charset = 'utf8mb4';

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";


    try {
     $pdo = new \PDO($dsn, $user, $pass, $options);
     return $pdo;
    } catch (PDOException $pe) {
        $response = array();
        $response['success'] = false;
        $response['message'] = 'Falha na conexão com o servidor.';
        echo json_encode($response);
        exit();
    }
    return null;
}
