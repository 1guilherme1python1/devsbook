<?php
class UserRelation{
    public $id;
    public $user_from;
    public $user_to;
}

interface UserRelationDAO{
    public function insert(UserRelation $r);
    public function getRelationFrom($id);
}
