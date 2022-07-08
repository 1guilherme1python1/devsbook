<?php
require 'dao/UserDaoMysql.php';
class Auth{
    private $pdo;
    private $base;
    private $dao;

    public function __construct(PDO $pdo, $base) {
        $this->pdo  = $pdo;
        $this->base = $base;
        $this->dao = new UserDaoMysql($this->pdo);

    }
    // vai retirnar o usuario logado caso noa ache o token retornará para login
    public function checkToken(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $user = $this->dao->findByToken($token);
            if($user){
                return $user;
            }
        }
        header("Location: ".$this->base."/login.php");
        exit;
    }
    public function validateLogin($email, $password){
        $user = $this->dao->findByEmail($email);
        if($user){
            //password_varify vai bater(senha que a pessoa mandou, senha que esta no banco)
            if(password_verify($password, $user->password)){
                $token = (md5(time().rand(0, 99999)));
                //gera um toke e salva no bando de dados
                //logo apos salva o token no session;
                $_SESSION['token'] = $token;
                $user->token = $token;
                $this->dao->update($user);

                return true;
            }
        }
        return false;
    }

    public function emailExists($email){
        return $this->dao->findByEmail($email) ? true : false;
    }
    public function registerUser($name, $email, $password, $birthdate){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $token = md5(time().rand(0, 9999));

        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $hash;
        $newUser->birthdate = $birthdate;
        $newUser->token = $token;

        $this->dao->insert($newUser);

        $_SESSION['token'] = $token;
    }
}