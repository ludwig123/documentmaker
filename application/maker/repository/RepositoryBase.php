<?php
namespace app\maker\repository;

use app\user\common\User;

abstract class RepositoryBase{
    protected $user;
    final public function __construct(User $user){
        $this->user = $user;
    }
    
    abstract public function getById($id);
    abstract public function add($data);
    abstract public function removeById($id);
    abstract public function refresh($id, $data);
}