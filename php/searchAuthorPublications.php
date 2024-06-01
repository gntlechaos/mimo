<?php
require_once('connect.php');
require 'session.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$author_id = $_SESSION['author_id'];

if (isset($_GET['q'])){

    $q = filter_var($_GET['q'], FILTER_UNSAFE_RAW);
    if(empty($_GET['q'])){

        // String do GET request é nula
        $response = array(
            'success' => false,
            'data' => false
        );

        $json = json_encode($response);
        echo $json;

    } else{

        $pdo = connect('interposto');
        $stmt = $pdo->prepare("CALL SearchAuthorPublications(:author_id,:query)");
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':query', $q);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {

            $response = array(
                'success' => true,
                'data' => $results
            );
            
            $json = json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
            
            echo $json;

            
        } else {
            $response = array(
                'success' => false,
                'data' => false
            );
            
            $json = json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
            
            echo $json;
        }


    }
} else{

     // String do GET request é nula
     $response = array(
        'success' => false,
        'data' => false
    );

    $json = json_encode($response);
    echo $json;
}



