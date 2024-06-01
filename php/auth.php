<?php
require_once('connect.php');

session_start();

$pdo = connect('mimo');

$stmt = $pdo->prepare('SELECT users.*, GROUP_CONCAT(user_author.author_id) AS "author_id" FROM users JOIN user_author ON users.id = user_author.user_id WHERE email = :email GROUP BY users.id;');
$stmt->bindParam(':email', $_POST['email']);
$stmt->execute();

$response = array();

if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Verify the password.
    if (password_verify($_POST['password'], $user['password_hash'])) {
        // Login successful.
        $response['success'] = true;
        $response['message'] = 'Autenticação bem-sucedida.';

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
		$_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];
		$_SESSION['user_id'] = $user['id'];
        $_SESSION['author_id'] = $user['author_id'];
        $_SESSION['admin'] = $user['author_id'];

    } else {

        // Login failed, wrong password.
        $response['success'] = false;
        $response['message'] = 'Credenciais de login inválidas.';
    }
} else {

    // Login failed, no matching email.
    $response['success'] = false;
    $response['message'] = 'Credenciais de login inválidas.';
}

echo json_encode($response);