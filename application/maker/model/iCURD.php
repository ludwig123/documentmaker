<?php
namespace app\maker\model;

interface iCURD
{
    /**返回一个一维数组
     * @param string $id
     */
    public static function getById($id);
    public static function add($dataArr);
    public static function refresh($id, $dataArr);
    public static function remove($id);
}