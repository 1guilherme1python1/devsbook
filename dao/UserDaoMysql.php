<?php
require_once 'models/User.php';

class UserDaoMysql implements UserDAO{
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    private function generateUser($array){
        $u = new User();
        $u->id = $array['id'] ?? 0;
        $u->email = $array['email'] ?? 0;
        $u->name = $array['name'] ?? 0;
        $u->birthdate= $array['birthdate'] ?? 0;
        $u->city = $array['city'] ?? 0;
        $u->work = $array['work'] ?? 0;
        $u->avatar = $array['avatar'] ?? 0;
        $u->cover = $array['cover'] ?? 0;
        $u->token = $array['token'] ?? 0;
        $u->password = $array['password'] ?? 0;

        return $u;
    }

    public function findByToken($token){
        if(!empty($token)){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE token=:token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            if($sql->rowCount()>0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                //manda como parametro $data 
                $user = $this->generateUser($data);
                return $user;
            }
        }
        return false;
    }

    public function findByEmail($email){
        if(!empty($email)){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if($sql->rowCount()>0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                //manda como parametro $data 
                $user = $this->generateUser($data);
                return $user;
            }
        }
        return false;
    }

    public function findById($id){
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount()>0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                //manda como parametro $data 
                $user = $this->generateUser($data);
                return $user;
            }
        }
        return false;
    }

    public function update(User $u){
        $sql = $this->pdo->prepare("UPDATE users SET 
        email = :email,
        password = :password,
        name = :name,
        birthdate = :birthdate,
        city = :city,
        work = :work,
        avatar = :avatar,
        cover = :cover,
        token = :token
        WHERE id = :id
        ");

        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':city', $u->city);
        $sql->bindValue(':work', $u->work);
        $sql->bindValue(':avatar', $u->avatar);
        $sql->bindValue(':cover', $u->cover);
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':id', $u->id);

        $sql->execute();

        return true;
    }
    public function insert(User $u){
        $sql = $this->pdo->prepare("INSERT INTO users (
            email, password, name, birthdate, token
        ) VALUES (
            :email, :password, :name, :birthdate, :token
        )");

        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':token', $u->token);
        $sql->execute();

        return true;
    }
}