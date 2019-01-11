<?php
namespace app\user\common;

use think\Db;

class UserLogin{
    private $user;
    public function __construct(){
        $this->user = session('user');
    }
    
    public function id(){
        return $this->user['id'];
    }
    
    public function updateUserName($name){
        $this->user['username'] = $name;
    }
    
    public function updatePassWord($password){
        $this->user['password'] = $password;
    }
    
}