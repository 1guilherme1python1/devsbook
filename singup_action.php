<?php
require_once 'config.php';
require_once 'models/Auth.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate');

if($email && $password && $name && $birthdate ){
    $auth = new Auth($pdo, $base);
    $birthdate = explode('/', $birthdate);
    if(count($birthdate) != 3){
        $_SESSION['flash'] = 'Data de nascimento inválida';
        header("Location: ".$base."/singup.php");
        exit; 
    }
    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
        if(strtotime($birthdate)===false){
           $_SESSION['flash'] = 'Data de nascimento inválida';
           header("Location: ".$base."/singup.php");
           exit;
    }
    if($auth->emailExists($email) === false){
        // se nao tiver um email no banco de dados ai sim registro o usuário
        $auth->registerUser($name, $email, $password, $birthdate);
        header("Location: ".$base);
        exit;
    } else {
        $_SESSION['flash'] = 'Esse e email já cadastrado';
        header("Location: ".$base."/singup.php");
        exit;
    }
}
$_SESSION['flash'] = 'Campos não enviados';
header("Location: ".$base."/singup.php");
exit;

