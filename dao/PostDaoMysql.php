<?php
require_once './models/Post.php';
require_once './dao/UserRelationDaoMysql.php';
require_once './dao/UserDaoMysql.php';


class PostDaoMysql implements PostDAO{
    private $pdo;
    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }
    public function insert(Post $p){
        $mysql = $this->pdo->prepare("INSERT INTO posts (
            id_user, type, created_at, body
        ) VALUES (
            :id_user, :type, :created_at, :body
        )");
        $mysql->bindValue(':id_user', $p->id_user);
        $mysql->bindValue(':type', $p->type);
        $mysql->bindValue(':created_at', $p->created_at);
        $mysql->bindValue(':body', $p->body);
        $mysql->execute();
    }
    public function getHomeFeed($id_user){
        $array = [];
        // lista dos usuários que eu sigo;
        $urDao = new UserRelationDaoMysql($this->pdo);
        $userlist = $urDao->getRelationFrom($id_user);

        // pegar os pots que estão nessa lista ordenado pela data
        $sql = $this->pdo->query("SELECT * FROM posts 
        WHERE id_user IN (".implode(',', $userlist).")
        ORDER BY created_at DESC");
        if($sql->rowCount()>0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            // transformar o resultado em objetos  
            $array = $this->_postListToObject($data, $id_user);
        }
        return $array; 
    }
    private function _postListToObject($post_list, $id_user){   
        $posts = [];
        $userDao = new UserDaoMysql($this->pdo);

        foreach($post_list as $post_item){
            $newPost = new Post();
            $newPost->id = $post_item['id'];
            $newPost->type = $post_item['type'];
            $newPost->created_at = $post_item['created_at'];
            $newPost->body = $post_item['body'];
            $newPost->mine = false;

            if($post_item['id_user']===$id_user){
                $newPost->mine = true; 
            }

            //pegar informações do usuário
            $newPost->user = $userDao->findById($post_item['id_user']);

            //informações sobre link
            $newPost->linkCount = 0;
            $newPost->liked = false;
            //informações sobre comments
            $newPost->commets = [];


            $posts[] = $newPost;
        }

        return $posts;
    }

}