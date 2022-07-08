<?php
require 'config.php';
require 'models/Auth.php';
require './dao/PostDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$body = filter_input(INPUT_POST, 'body');

if($body){
    $postDao = new PostDaoMysql($pdo);

    $newpost = new Post();
    $newpost->id_user = $userInfo->id;
    $newpost->type = 'text';
    $newpost->created_at = date('Y-m-d H:i:s');
    $newpost->body = $body;
    
    $postDao->insert($newpost);
}

header("Location: ".$base);
exit;