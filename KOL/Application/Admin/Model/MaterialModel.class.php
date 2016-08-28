<?php
/**
 * 图片上传类 批量保存
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/25
 * Time: 13:13
 */
namespace Admin\Model;

use Think\Model;

class MaterialModel extends Model
{
    /**
     * KOL logo设置
     */
    public function manageImg($img = array())
    {
        $Material = M('material');
        $data['ruid'] = $img['ruid'];
        $data['type'] = $img['type'];
        $data['obj_path'] = $img['obj_path'];
        $data['add_time'] = date('y-m-d h:i:s', time());
        //使用次数
        $data['usenum'] = 1;

        //  ?
        $data['name'] = '0';
        $data['sha1'] = '0';

        //从数据库查找原来的记录，如果存在KOL的记录就把它删掉
        $condition['ruid'] = $data['ruid'];
        if ($Material->where($condition)->find()) {
            $Material->where($condition)->delete();
            return $Material->add($data);
        } else
            return $Material->add($data);
    }
}

?>