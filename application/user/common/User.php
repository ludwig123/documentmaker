<?php
namespace app\user\common;

use think\Db;

class User{
    private $user;
    public function __construct($id){
        $this->user = Db::name('user')->where('id',$id)->find();
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