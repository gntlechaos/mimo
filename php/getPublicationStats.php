<?php
require_once('connect.php');
require 'session.php';

$author_id = $_SESSION['author_id'];
$admin = $_SESSION['admin'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['pub_ids'])) {
    $pub_ids = filter_var($_GET['pub_ids'], FILTER_UNSAFE_RAW);

    if (empty($pub_ids)) {
        // String do GET request é inválida
        $response = array(
            'success' => false,
            'data' => false,
            'reason'=> "Solicitação inválida."
        );
    
        $json = json_encode($response);
        echo $json;

    } else {

        // Confirma que o parâmetro GET é uma string com apenas números e vírgulas
        if (!preg_match("/^(\\d+,)*\\d+$/", $pub_ids)) {
            $response = array(
                'success' => false,
                'data' => false,
                'reason'=> "Solicitação inválida."
            );
    
            $json = json_encode($response);
            echo $json;
            exit;
        }

        $pdo = connect('interposto');

        // Se o usuário requisitando os dados não for administrador, ele deve ser colaborador nesses projetos.

        if(!$admin){

            $stmt = $pdo->prepare("CALL GetAuthorPubIds(:author_ids);");
            $stmt->bindParam(':author_ids', $author_id);
            $stmt->execute();

            $result = $stmt->fetchAll();
            $stmt->nextRowSet();
            $stmt->closeCursor(); 
            
            
            if ($stmt->rowCount() == 0) {
                
                // O autor não é colaborador em nenhuma publicação.

                $response = array(
                    'success' => false,
                    'data' => false,
                    'reason'=> "Privilégios não permitem a consulta desses dados."
                );

                $json = json_encode($response);
                echo $json;
                exit;
                
            } 
            // Testando se o autor é colaborador em todas as publicações 

            $authorPubIds = $result[0]['pub_ids']; // Publicações nos quais o usuário é colaborador
            $requestedIds = $pub_ids; // Publicações cujos dados foram requisitados
            
            $authorPubIdsArray = explode(",", $authorPubIds);
            $requestedIdsArray = explode(",", $requestedIds);
            
            $commonIds = array_intersect($authorPubIdsArray, $requestedIdsArray);

            if(count($commonIds) !== count($requestedIdsArray)){
               // O autor não é colaborador de uma ou mais publicações
                $response = array(
                    'success' => false,
                    'data' => false,
                    'reason'=> "Privilégios não permitem a consulta desses dados..."
                );

                $json = json_encode($response);
                echo $json;
                exit;
            } 

            
        }

        // Solicitar estatísticas do servidor
    
        $stmt2 = $pdo->prepare("CALL GetPublicationStats(:pub_ids)");
        $stmt2->bindParam(':pub_ids', $pub_ids);
        $stmt2->execute();
        $results = $stmt2->fetchAll();
        $stmt2->closeCursor();
        if ($stmt2->rowCount() > 0) {

            $response = array(
                'success' => true,
                'data' => $results
            );
            
            $json = json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
            
            echo $json;

            
        } else {
            $response = array(
                'success' => false,
                'data' => false,
                'reason' => 'Servidor não encontrou dados solicitados.'
            );
            
            $json = json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
            
            echo $json;
        }

    }
} else {

    // String do GET request é nula
    $response = array(
        'success' => false,
        'data' => false,
        'reason'=> "Solicitação inválida."
    );

    $json = json_encode($response);
    echo $json;

}
