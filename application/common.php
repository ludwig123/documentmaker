<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

use service\DataService;
use service\NodeService;
use think\Db;

/**
 * 打印输出数据到文件
 * @param mixed $data 输出的数据
 * @param bool $force 强制替换
 * @param string|null $file
 */
function p($data, $force = false, $file = null)
{
    is_null($file) && $file = env('runtime_path') . date('Ymd') . '.txt';
    $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . PHP_EOL;
    $force ? file_put_contents($file, $str) : file_put_contents($file, $str, FILE_APPEND);
}

/**
 * RBAC节点权限验证
 * @param string $node
 * @return bool
 */
function auth($node)
{
    return NodeService::checkAuthNode($node);
}

/**
 * 设备或配置系统参数
 * @param string $name 参数名称
 * @param bool $value 默认是null为获取值，否则为更新
 * @return string|bool
 * @throws \think\Exception
 * @throws \think\exception\PDOException
 */
function sysconf($name, $value = null)
{
    static $config = [];
    if ($value !== null) {
        list($config, $data) = [[], ['name' => $name, 'value' => $value]];
        return DataService::save('SystemConfig', $data, 'name');
    }
    if (empty($config)) {
        $config = Db::name('SystemConfig')->column('name,value');
    }
    return isset($config[$name]) ? $config[$name] : '';
}

/**
 * 日期格式标准输出
 * @param string $datetime 输入日期
 * @param string $format 输出格式
 * @return false|string
 */
function format_datetime($datetime, $format = 'Y年m月d日 H:i:s')
{
    return date($format, strtotime($datetime));
}

/**
 * UTF8字符串加密
 * @param string $string
 * @return string
 */
function encode($string)
{
    list($chars, $length) = ['', strlen($string = iconv('utf-8', 'gbk', $string))];
    for ($i = 0; $i < $length; $i++) {
        $chars .= str_pad(base_convert(ord($string[$i]), 10, 36), 2, 0, 0);
    }
    return $chars;
}

/**
 * UTF8字符串解密
 * @param string $string
 * @return string
 */
function decode($string)
{
    $chars = '';
    foreach (str_split($string, 2) as $char) {
        $chars .= chr(intval(base_convert($char, 36, 10)));
    }
    return iconv('gbk', 'utf-8', $chars);
}

/**
 * 下载远程文件到本地
 * @param string $url 远程图片地址
 * @return string
 */
function local_image($url)
{
    return \service\FileService::download($url)['url'];
}



//判断商户是否登陆
function is_merchant_login($token=null)
{
    $user = session ( 'user_auth' );
    if (empty ( $user ))
    {
        return false;
    }
    else
    {
    	if(empty($token)){
        	return session ( 'user_auth_sign' ) == data_auth_sign ( $user ) ? $user ['uid'] : false;
    	}else{
    		return ($token == data_auth_sign ( $user ) && session ( 'user_auth_sign' ) == data_auth_sign ( $user )) ? $user ['uid'] : false;
    	}
    }
}

/**
 * 系统非常规MD5加密方法
 *
 * @param string $str
 *        	要加密的字符串
 * @return string
 */
function think_weiphp_md5($str, $key = '')
{
    empty ( $key ) && $key = config ( 'data_auth_key' );
    return '' === $str ? '' : md5 ( sha1 ( $str ) . $key );
}

/**
 * 数据签名认证
 *
 * @param array $data
 *        	被认证的数据
 * @return string 签名
 */
function data_auth_sign($data) {
    // 数据类型检测
    if (! is_array ( $data )) {
        $data = ( array ) $data;
    }
    ksort ( $data ); // 排序
    $code = http_build_query ( $data ); // url编码并生成query字符串
    $sign = sha1 ( $code ); // 生成签名
    return $sign;
}


function get_cur_domain()
{
   // return is_http_secure() ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'];
}

function get_cur_url($is_domain = false)
{
    if($is_domain)
        return get_cur_domain()  . $_SERVER['REQUEST_URI'];
        
        return $_SERVER['REQUEST_URI'];
}


function is_police_login(){
    $user = session ( 'user' );
    if (empty ( $user ))
    {
        return false;
    }
    
    return true;
}

//模板套装
function setCurrentRecordId($id){
    session('nowReadRecord', $id);
    return ;
}

function getCurrentRecordId(){
   return session('nowReadRecord');
}

function clearCurrentRecordId(){
    session('nowReadRecord', null);
    return ;
}

//模板
function setCurrentTempletId($id){
    session('nowReadRecord', $id);
    return ;
}

function getCurrentTempletId(){
    return session('nowReadRecord');
}

function clearCurrentTempletId(){
    session('nowReadRecord', null);
    return ;
}

//文件卷宗
function setCurrentArchiveSuitId($id){
    session('nowReadArchiveSuit', $id);
    return ;
}

function getCurrentArchiveSuitId()
{
    return session('nowReadArchiveSuit');
}

function clearCurrentArchiveSuitId(){
    session('nowReadArchiveSuit', null);
    return ;
}

//文件
function setCurrentArchiveId($id){
    session('nowReadArchive', $id);
    return ;
}

function getCurrentArchiveId(){
    return session('nowReadArchive');
}

function clearCurrentArchiveId(){
    session('nowReadArchive', null);
    return ;
}

function setCurrentTempletSuitId($id){
    session('nowReadTempletSuit', $id);
    return ;
}

function getCurrentTempletSuitId(){
    return session('nowReadTempletSuit');
}

function clearCurrentTempletSuitId(){
    session('nowReadTempletSuit', null);
    return ;
}

/**
 * 返回档当前登陆用户的Id
 */
function getUserId(){
    $user = session('user');
    return $user['id'];
}