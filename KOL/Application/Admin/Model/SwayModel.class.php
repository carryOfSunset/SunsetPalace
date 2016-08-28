<?php
/**
 * 平台影响力类
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/22
 * Time: 16:49
 */
namespace Admin\Model;

use Think\Model;

class SwayModel extends Model
{
    /**
     *  根据用户id寻找平台
     */
    public function getSway($data = array())
    {
        $Sway = M('sway');
        $condition['ruid'] = $data['ruid'];
        $result = $Sway->where($condition)->select();
        if ($result != NULL) {
            return $result;
        }
        return NULL;
    }

    /**
     * 添加平台
     */
    public function addSway($sway = array())
    {
        $Sway = M('sway');
        $data['ruid'] = $sway['ruid'];
        $data['n_id'] = $sway['n_id'];
        $data['nick_name'] = $sway['nick_name'];
        $data['url'] = $sway['url'];
        $data['fansnum'] = $sway['fansnum'];
        $data['readnum'] = $sway['readnum'];
        $data['paction'] = $sway['paction'];
        //intel表中获取平台名称
        $Intel = M('intel');
        $condition['id'] = $data['n_id'];
        $data['name'] = $Intel->where($condition)->getField('name');

        $result = $Sway->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 平台编辑
     */
    public function updateSway($sway = array())
    {
        $Sway = M('sway');
        $condition['id'] = $sway['id'];

        $data['n_id'] = $sway['n_id'];
        $data['nick_name'] = $sway['nick_name'];
        $data['url'] = $sway['url'];
        $data['fansnum'] = $sway['fansnum'];
        $data['readnum'] = $sway['readnum'];
        $data['paction'] = $sway['paction'];

        //intel表中获取平台名称
        $Intel = M('intel');
        $where['n_id'] = $data['n_id'];
        $data['name'] = $Intel->where($where)->getField('name');

        $result = $Sway->where($condition)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 删除平台，根据影响力id
     */
    public function deleteSway($data = array())
    {
        $Sway = M('sway');
        $condition['id'] = $data['id'];
        $result = $Sway->where($condition)->delete();
        if ($result) {
            return true;
        }
        return false;
    }
}

?>