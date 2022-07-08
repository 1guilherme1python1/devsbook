<?php
class Post{
    public $id;
    public $id_user;
    public $type; //text / photo
    public $created_at;
    public $body;
}

interface PostDAO{
    public function insert(Post $p);
    //mandar o id do usuário que está logado naquele momento
    public function getHomeFeed($id_user);
}
