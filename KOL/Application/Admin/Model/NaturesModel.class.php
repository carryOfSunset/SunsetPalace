<?php
/**
 * NaturesModel:内容属性类，增加，选择内容属性
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/22
 * Time: 15:10
 */
namespace Admin\Model;

use Think\Model;

class NaturesModel extends Model
{
    /**
     * 添加一个内容属性，暂时没有上传logo的空余。。
     */
    public function addNatures($natrues = array())
    {
        $Natures = M('natures');
        $data['name'] = $natrues['name'];
        $result = $Natures->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     *  新增内容属性，编辑内容属性方法
     */
    public function selectNatures($natures = array())
    {
        $RedUser = M('reduser');

        $data['natures'] = implode(',', $natures['natures']);

        //获取KOL相关信息
        $where['ruid'] = $natures['ruid'];
        $result = $RedUser->where($where)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 展示内容属性
     */
    public function getAbilitysList()
    {
        $Natures = M('natures');

        $result = $Natures->select();
        if ($result) {
            return $result;
        }
        return false;
    }
}

?>