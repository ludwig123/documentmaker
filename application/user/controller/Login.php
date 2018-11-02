<?php
namespace app\user\controller;

use service\LogService;
use service\NodeService;
use think\Controller;
use think\Db;
use think\Validate;

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
        ], [
            'username.require' => '登录账号不能为空！',
            'username.min'     => '登录账号长度不能少于4位有效字符！',
            'password.require' => '登录密码不能为空！',
            'password.min'     => '登录密码长度不能少于4位有效字符！',
        ]);
        $data = [
            'username' => $this->request->post('username', ''),
            'password' => $this->request->post('password', ''),
        ];
        $validate->check($data) || $this->error($validate->getError());
        // 用户信息验证
        $user = Db::name('SystemUser')->where(['username' => $data['username'], 'is_deleted' => '0'])->find();
        empty($user) && $this->error('登录账号不存在，请重新输入!');
        empty($user['status']) && $this->error('账号已经被禁用，请联系管理员!');
        $user['password'] !== md5($data['password']) && $this->error('登录密码错误，请重新输入!');
        // 更新登录信息
        Db::name('SystemUser')->where(['id' => $user['id']])->update([
            'login_at'  => Db::raw('now()'),
            'login_num' => Db::raw('login_num+1'),
        ]);
        session('user', $user);
        !empty($user['authorize']) && NodeService::applyAuthNode();
        LogService::write('页面打印', '用户登录系统成功');
        $this->success('登录成功，正在进入系统...', '@admin');
    }
}
