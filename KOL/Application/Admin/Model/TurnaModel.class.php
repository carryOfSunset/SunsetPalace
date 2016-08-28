<?php
/**
 * 黑历史持久层
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 10:12
 */
namespace Admin\Model;

use Think\Model;

class TurnaModel extends Model
{
    /**
     * 新增KOL时添加黑历史
     */
    public function insertTurna($turna = array())
    {
        $data['ruid'] = $turna['ruid'];
        $data['rtime'] = $turna['rtime'];
        $data['l_id'] = $turna['l_id'];
        $data['url'] = $turna['url'];
        $data['remark'] = $turna['remark'];

        //从labels表中获取黑标签名称
        $Labels = M('labels');
        $condition['l_id'] = $data['l_id'];
        $data['name'] = $Labels->where($condition)->getField('name');

        //添加进数据库
        $Turna = M('turna');
        $result = $Turna->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 编辑黑历史
     */
    public function updateTurna($turna = array())
    {
        $data['id'] = $turna['id'];
        $data['rtime'] = $turna['rtime'];
        $data['l_id'] = $turna['l_id'];
        $data['url'] = $turna['url'];
        $data['remark'] = $turna['remark'];

        //从labels表中获取黑标签名称
        $Labels = M('labels');
        $condition['l_id'] = $data['l_id'];
        $data['name'] = $Labels->where($condition)->getField('name');

        //添加进数据库
        $Turna = M('turna');
        $where['id'] = $data['id'];
        $result = $Turna->where($where)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 删除黑历史
     */
    public function deleteTurna($turna = array())
    {
        $data['id'] = $turna['id'];

        $Turna = M('turna');
        $result = $Turna->where($data)->delete();
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 新增标签
     */
    public function insertLabel($label = array())
    {
        $data['name'] = $label['name'];
        $data['type'] = 1;

        $Label = M('labels');
        $result = $Label->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 查找标签
     */
    public function searchLabel($label = array())
    {
        $data['id'] = $label['id'];

        $Label = M('labels');
        $result = $Label->where($data)->getField('name');
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 显示黑历史标签
     */
    public function getLabelList()
    {
        $Label = M('labels');
        $result = $Label->select();
        if ($result) {
            return $result;
        }
        return false;
    }
}

?>