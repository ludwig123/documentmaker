<?php
namespace app\user\controller;

use app\maker\controller\BaseController;
use service\LogService;
use service\NodeService;
use think\Controller;
use think\Db;
use think\Validate;
use app\user\common\User;

class Login extends Controller
{

    public function index(){
        if ($this->request->isGet()) {
            return $this->fetch('', ['title' => '用户登录']);
        }
        // 输入数据效验
        $validate = Validate::make([
            'username' => 'require|min:4',
            'password' => 'require|min:4',
            //'captcha|验证码'=>'require|captcha'
        ], [
            'username.require' => '登录账号不能为空！',
            'username.min'     => '登录账号长度不能少于4位有效字符！',
            'password.require' => '登录密码不能为空！',
            'password.min'     => '登录密码长度不能少于4位有效字符！',
//             'captcha' => '验证码错误！',
        ]);
        $temp = $this->request->post();
        $data = [
            'username' => $temp['username'],
            'password' => $temp['password'],
            'captcha' => $temp['captcha'],
        ];
        $validate->check($data) || $this->error($validate->getError());
        // 用户信息验证
        $user = Db::name('user')->where(['username' => $data['username'], 'is_deleted' => '0'])->find();
        empty($user) && $this->error('登录账号不存在，请重新输入!');
        empty($user['status']) && $this->error('账号已经被禁用，请联系管理员!');
        $user['password'] !== $data['password'] && $this->error('登录密码错误，请重新输入!');
        // 更新登录信息
        Db::name('user')->where(['id' => $user['id']])->update([
            'login_at'  => Db::raw('now()'),
            'login_num' => Db::raw('login_num+1'),
        ]);
        session('user', $user);
        //!empty($user['authorize']) && NodeService::applyAuthNode();
        LogService::write('页面打印', '用户登录系统成功');
        $this->success('登录成功，正在进入系统...', '@maker/index/recordslist');
    }
    
    /**
     * 退出登录
     */
    public function out()
    {
        session('user') && LogService::write('系统管理', '用户退出系统成功');
        !empty($_SESSION) && $_SESSION = [];
        [session_unset(), session_destroy()];
        $this->success('退出登录成功！', '@index/index');
    }
}

