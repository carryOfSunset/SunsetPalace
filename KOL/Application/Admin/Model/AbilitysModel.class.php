<?php
/**
 * 个人能力信息类
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/22
 * Time: 15:23
 */
namespace Admin\Model;

use Think\Model;

class AbilitysModel extends Model
{
    /**
     * 添加一个能力属性，和内容属性一样暂时没有上传logo的空余。。
     */
    public function addAbilitys($abilitys = array())
    {
        $Abilitys = M('abilitys');
        $data['name'] = $abilitys['name'];
        $result = $Abilitys->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     *  添加个人能力，编辑个人能力方法
     */
    public function selectAbilitys($abilitys = array())
    {
        $RedUser = M('reduser');

        $data['abilitys'] = implode(',', $abilitys['abilitys']);

        //获取KOL相关信息x
        $where['ruid'] = $abilitys['ruid'];
        $result = $RedUser->where($where)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 展示能力属性
     */
    public function getAbilitysList()
    {
        $Abilitys = M('abilitys');

        $result = $Abilitys->select();
        if ($result) {
            return $result;
        }
        return false;
    }
}

?>