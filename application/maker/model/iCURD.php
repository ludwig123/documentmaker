<?php
namespace app\maker\model;

interface iCURD
{
    /**返回一个一维数组
     * @param string $id
     */
    public static function getById($id, $owner);
    public static function add($dataArr, $owner);
    public static function refresh($id, $dataArr, $owner);
    public static function remove($id, $owner);
}