<?php
/**
 * KOL单一控制类，用于修改信息等
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 16:40
 */
namespace Admin\Controller;

use Admin\Model\ReduserModel;
use Think\Controller;

class ReduserController extends Controller
{
    /**
     * 编辑KOL，个人信息编辑
     */
    public function updateKOL()
    {
        I_J('');
        if (IS_POST) {
            //获取POST基本信息（数组）
            $KOLBasicInfoPOST = $_POST['basicInfo'];

            //初始化返回数据
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = 'ERROR';

            //将获取到的基本信息重新封装成KOLBasicInfo
            $KOLBasicInfo = array(
                'ruid'=>$KOLBasicInfoPOST['ruid'],                                      //ruid
                'name' => $KOLBasicInfoPOST['name'],                                    //昵称
                'c_id' => $KOLBasicInfoPOST['c_id'],                                    //所在城市
                'sex' => $KOLBasicInfoPOST['sex'],                                      //性别
                'age' => $KOLBasicInfoPOST['age'],                                      //年龄段
                's_id' => $KOLBasicInfoPOST['s_id'],                                    //身份
                'username' => $KOLBasicInfoPOST['username'],                           //真实姓名
                'tel' => $KOLBasicInfoPOST['tel'],                                       //电话
                'email' => $KOLBasicInfoPOST['email'],                                   //邮箱
                'address' => $KOLBasicInfoPOST['address'],                              //地址
                'remark' => $KOLBasicInfoPOST['remark'],                                 //简介
                'brands' => $KOLBasicInfoPOST['brands']                                  //展示平台
            );

            //调用redUser->insertKOL先把个人信息加入数据库，获取新增用户的id
            $RedUser = new ReduserModel();
            if (!($RedUser->checkUsername($KOLBasicInfoPOST['username']))) {
                $res_data['errormsg'] = '用户名格式不正确';
                $this->ajaxReturn($res_data);
            } elseif (!($RedUser->checkTel($KOLBasicInfoPOST['tel']))) {
                $res_data['errormsg'] = '手机号码格式不正确';
                $this->ajaxReturn($res_data);
            } elseif (!($RedUser->checkEmail($KOLBasicInfoPOST['email']))) {
                $res_data['errormsg'] = '电子邮箱格式不正确';
                $this->ajaxReturn($res_data);
            } elseif ($RedUser->checkTelUnique($KOLBasicInfoPOST['tel'])) {
                $res_data['errormsg'] = '手机号码已有备案';
                $this->ajaxReturn($res_data);
            } elseif ($RedUser->checkEmailUnique($KOLBasicInfoPOST['email'])) {
                $res_data['errormsg'] = '电子邮箱已有备案';
                $this->ajaxReturn($res_data);
            } else {
                $result = $RedUser->updateRedUser($KOLBasicInfo);

                //长长的路呀走几遍，轻歌慢语的少年
                if ($result) {
                    $res_data['errorcode'] = 0;
                    $res_data['errormsg'] = '修改成功';
                    $this->ajaxReturn($res_data);
                } else {
                    $res_data['errormsg'] = '修改失败';
                    $this->ajaxReturn($res_data);
                }
            }
        }
    }
}

?>