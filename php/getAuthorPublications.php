<?php
require_once('connect.php');
require 'session.php';

$pdo = connect('interposto');

$author_id = $_SESSION['author_id'];

$stmt = $pdo->prepare("CALL GetAuthorPublications(:author_id)");
$stmt->bindParam(':author_id', $author_id);
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
