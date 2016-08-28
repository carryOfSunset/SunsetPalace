<?php
/**
 * ReaduserModel.class：网红信息类
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/22
 * Time: 8:58
 */
namespace Admin\Model;

use Think\Model;

class ReduserModel extends Model
{
    /**
     * 添加个人信息
     */
    public function insertRedUser($redUser = array())
    {
        $RedUser = M('reduser');

        //获取城市id
        $data['c_id'] = $redUser['c_id'];

        //获取性别
        $data['sex'] = $redUser['sex'];

        //修改年龄段
        $Age = $redUser['age'];
        $data['age'] = str_replace('S', '后', $Age);

        //获取昵称
        $data['name'] = $redUser['name'];

        //获取身份信息
        #$data['s_id'] = $redUser['s_id'];
        $data['s_id'] = implode(',', $redUser['s_id']);

        //获取简介
        $data['remark'] = $redUser['remark'];

        //真实姓名
        $data['username'] = $redUser['username'];

        //判断手机号，邮箱
        if ($redUser['tel'] == NULL) {
            $data['tel'] = '-';
        } else {
            $data['tel'] = $redUser['tel'];
        }
        if ($redUser['email'] == NULL) {
            $data['email'] = '-';
        } else {
            $data['email'] = $redUser['email'];
        }
        if ($redUser['address'] == NULL) {
            $data['address'] = '-';
        } else {
            $data['address'] = $redUser['address'];
        }

        //获取品牌（权限？）
        $data['brands'] = implode(',', $redUser['brands']);

        //昵称首个字符
        $data['sur_name'] = mb_substr($data['name'], 0, 1, 'utf-8');

        //昵称首个拼音
        $data['en_name'] = getFirstCharter($data['name']);

        if ($lastId = $RedUser->add($data)) {
            return $lastId;
        }
        return false;
    }

    /**
     * 编辑网红信息
     */
    public function updateRedUser($redUser = array())
    {
        $RedUser = M('reduser');

        //获取城市id
        $data['c_id'] = $redUser['c_id'];

        //获取性别
        $data['sex'] = $redUser['sex'];

        //修改年龄段
        $Age = $redUser['age'];
        $data['age'] = str_replace('S', '后', $Age);

        //获取昵称
        $data['name'] = $redUser['name'];

        //获取身份信息
        #$data['s_id'] = $redUser['s_id'];
        $data['s_id'] = implode(',', $redUser['s_id']);

        //获取简介
        $data['remark'] = $redUser['remark'];

        //真实姓名
        $data['username'] = $redUser['username'];

        //判断手机号，邮箱
        if ($redUser['tel'] == NULL) {
            $data['tel'] = '-';
        } else {
            $data['tel'] = $redUser['tel'];
        }
        if ($redUser['email'] == NULL) {
            $data['email'] = '-';
        } else {
            $data['email'] = $redUser['email'];
        }
        if ($redUser['address'] == NULL) {
            $data['address'] = '-';
        } else {
            $data['address'] = $redUser['address'];
        }

        //获取品牌（权限？）
        $data['brands'] = implode(',', $redUser['brands']);

        //昵称首个字符
        $data['sur_name'] = mb_substr($data['name'], 0, 1, 'utf-8');

        //昵称首个拼音
        $data['en_name'] = getFirstCharter($data['name']);

        $condition['ruid'] = $redUser['ruid'];

        if ($RedUser->where($condition)->save($data)) {
            return true;
        }
        return false;
    }

    /**
     * 获取所有城市列表
     */
    public function getCityList()
    {
        $cities = M('cities');
        $result = $cities->select();
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 获取身份信息
     */
    public function getStatusList()
    {
        $status = M('status');
        $result = $status->select();
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * 校验电子邮箱格式
     */
    public function checkEmail($email = '')
    {
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (preg_match($pattern, $email)) {
            return true;
        }
        return false;
    }

    /**
     * 校验手机号码格式
     */
    public function checkTel($tel = '')
    {
        $pattern = "/^1[34578]\d{9}$/";
        if (preg_match($pattern, $tel)) {
            return true;
        }
        return false;
    }

    /**
     * 校验中文姓名
     */
    public function checkUsername($username = '')
    {
        $pattern = "/^[\x7f-\xff]+$/";
        if (preg_match($pattern, $username)) {
            return true;
        }
        return false;
    }

    /**
     * 判断电话号码是否已经存在
     */
    public function checkTelUnique($tel = '')
    {
        $RedUser = M('reduser');
        $condition['tel'] = $tel;
        $new_tel = $RedUser->where($condition)->getField('ruid');
        if ($new_tel) {
            return true;
        }
        return false;
    }

    /**
     * 判断邮箱是否已经存在
     */
    public function checkEmailUnique($email = '')
    {
        $RedUser = M('reduser');
        $condition['email'] = $email;
        $new_email = $RedUser->where($condition)->getField('ruid');
        if ($new_email) {
            return true;
        }
        return false;
    }
}


?>