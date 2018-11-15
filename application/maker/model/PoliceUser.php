<?php
namespace app\maker\model;

use think\Db;
use think\Model;

class PoliceUser extends Model
{

    protected $table = 'police_user';
    
    /**
     * 登录指定用户   支持用户名 手机 邮箱登陆
     * @param integer $uid用户ID
     * @return boolean ture-登录成功，false-登录失败
     */
    public function login($username, $password, $type = 1)
    {
        /* 检测是否在当前应用注册 */
        $user = db($this->table)->where('username|email|mobile','=',$username)->find();
        
        if (is_array ( $user ) && intval ( $user ['status'] ) > 0)
        {
            /* 验证用户密码 */
            if (think_weiphp_md5 ( $password ) === $user ['password'])
            {
                // 记录行为
                //action_log ( $from, 'user', $user ['uid'], $user ['uid'] );
                
                /* 登录用户 */
                $this->autoLogin ( $user );
                
                // 登录成功，返回用户ID
                return $user ['id'];
            }
            else
            {
                $this->error = '密码错误！';
                return false;
            }
        }
        else
        {
            $this->error = '用户不存在或已被禁用！'; // 应用级别禁用
            return false;
        }
    }
    
    /**
     * 自动登录用户
     *
     * @param integer $user
     *        	用户信息数组
     */
    public function autoLogin($user)
    {
        /* 记录登录SESSION和COOKIES */
        $auth = array (
            'uid' => $user ['id'],
            'username' => $user ['username'],
            'last_login_time' => $user ['last_login']
        );
        
        session ( 'mid', $user ['id'] );
        session ( 'manager_id', $user ['id'] );
        session ( 'manager_nickname', $user ['name'] );
        session ( 'user_auth', $auth );
        session ( 'user_auth_sign', data_auth_sign ( $auth ) );
    }
    
    /**
     * 注销当前用户
     * @return void
     */
    public function logout()
    {
        session ( 'mid', null );
        session ( 'user_auth', null );
        session ( 'user_auth_sign', null );
        session ( 'manager_id', null );
        session ( 'manager_nickname', null );
    }
    
    public function getLists()
    {
        $lists = db($this->table)->select();
        return $lists;
    }
    
    public function forbid($id)
    {
        return db($this->table)->where('id', $id)->update(['status' => '0']);
    }
    
    public function resume($id)
    {
        return db($this->table)->where('id', $id)->update(['status' => '1']);
    }
    
    public function getPoliceName($id)
    {
        $merchat = db($this->table)->field('name')->where ('id','=',$id)->find();
        return $merchat['name'];
    }
}