<?php
/**
 * 网红特殊日，特殊信息，黑历史，特殊信息操作,特殊日提示
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/22
 * Time: 17:41
 */
namespace Admin\Model;

use Think\Model;

class SpedaysModel extends Model
{
    /**
     * 更新特殊信息
     */
    public function insertSpeInfo($speInfo = array())
    {
        //个人信息
        $data['ruid'] = $speInfo['ruid'];
        $data['bday'] = $speInfo['bday'];
        $data['hobbys'] = $speInfo['hobbys'];
        $data['dye'] = $speInfo['dye'];
        $data['rank'] = $speInfo['rank'];

        //先把个人信息加入到数据库(更新)
        $RedUser = M('reduser');
        $condition['ruid'] = $data['ruid'];
        $result = $RedUser->where($condition)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 新增特殊日，关联表spedays
     */
    public function insertSpecialDays($spedays = array())
    {
        $data['ruid'] = $spedays['ruid'];
        $data['rtime'] = $spedays['rtime'];
        $data['name'] = $spedays['name'];

        $SpeDays = M('spedays');
        $result = $SpeDays->add($data);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 删除特殊日
     */
    public function deleteSpecialDay($spedays = array())
    {
        $Spedays = M('spedays');
        $condition['id'] = $spedays['id'];
        $result = $Spedays->where($condition)->delete();
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * 显示特殊日期
     */
    public function getSpecialDay($spedays = array())
    {
        $Spedays = M('spedays');
        $condition['ruid'] = $spedays['ruid'];
        $result = $Spedays->where($condition)->select();
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 获取等级信息
     */
    public function getRankList()
    {
        $vip = M('vip');
        $result = $vip->select();
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 获取颜值信息
     */
    public function getDyeList()
    {
        $faceval = M('faceval');
        $result = $faceval->select();
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 生日提醒
     */
    public function notifyBirthDay()
    {
        $BirthDay = M('spedays');
        $data['sign_type'] = 1;
        $data['type'] = 0;
        $result = $BirthDay->where($data)->select();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    /**
     * 特殊日提醒
     */
    public function notifySpecialDay()
    {
        $SpecialDay = M('spedays');
        $data['sign_type'] = 1;
        $data['type'] = 1;
        $result = $SpecialDay->where($data)->select();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}

?>