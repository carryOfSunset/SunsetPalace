<?php
/**
 * 特殊日 删除特殊日 特殊日提醒
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 16:21
 */
namespace Admin\Controller;

use Admin\Model\SpedaysModel;
use Think\Controller;

class SpecialDayController extends Controller
{
    /**
     * 编辑页面 特殊日显示功能接口
     */
    public function getSpecialDay()
    {
        I_J('');
        $SpecialDayPOST['ruid'] = $_POST['ruid'];
        $SpedaysModel = new SpedaysModel();
        $result = $SpedaysModel->getSpecialDay($SpecialDayPOST);
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '查找完毕';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '没有查找到信息';
            $res_data['errorresult'] = null;
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 编辑页面 删除特殊日功能
     */
    public function deleteSpecialDay()
    {
        I_J('');
        $SpecialDayPOST['id'] = $_POST['id'];

        $SpedaysModel = new SpedaysModel();
        $result = $SpedaysModel->deleteSpecialDay($SpecialDayPOST);
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '删除成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['code'] = 11110000;
            $res_data['msg'] = '删除失败';
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 编辑页面 特殊信息编辑
     */
    public function updateSpecialInfo()
    {
        I_J('');
        $SpecialInfoPOST['ruid'] = $_POST['ruid'];
        $SpecialInfoPOST['bday'] = $_POST['bday'];
        $SpecialInfoPOST['hobbys'] = $_POST['hobbys'];
        $SpecialInfoPOST['dye'] = $_POST['dye'];
        $SpecialInfoPOST['rank'] = $_POST['rank'];

        $SpedaysModel = new SpedaysModel();
        $result = $SpedaysModel->insertSpeInfo($SpecialInfoPOST);
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '修改成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['code'] = 11110000;
            $res_data['msg'] = '修改失败';
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 编辑界面 新增特殊日
     */
    public function insertSpecialday()
    {
        I_J('');
        //获取新增日期的POST（数组）
        $KOLSpecialDayPOST = $_POST['speday'];

        $SpedaysModel = new SpedaysModel();
        //新增特殊日，接收多个特殊日的添加请求
        foreach ($KOLSpecialDayPOST as $k => $v) {
            $KOLSpecialDay = array(
                'rtime' => $v['rtime'],
                'name' => $v['name'],
                'ruid' => $v['ruid']
            );
            $specialday = $SpedaysModel->insertSpecialDays($KOLSpecialDay);
        }
        if ($specialday) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '添加成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['code'] = 11110000;
            $res_data['msg'] = '添加失败';
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 获取等级信息
     */
    public function getRankList()
    {
        $SpecialDayModel = new SpedaysModel();
        $result = $SpecialDayModel->getRankList();
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '查找完毕';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '没有查找到信息';
            $res_data['errorresult'] = null;
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 获取颜值信息
     */
    public function getdyeList()
    {
        $SpecialDayModel = new SpedaysModel();
        $result = $SpecialDayModel->getDyeList();
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '查找完毕';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '没有查找到信息';
            $res_data['errorresult'] = null;
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 主页面的特殊日期提示消息
     */
    public function notifySpecialDay()
    {
        $SpecialDayModel = new SpedaysModel();
        $result = $SpecialDayModel->notifySpecialDay();
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '查找完毕';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '没有查找到信息';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 主页面的生日提示消息
     */
    public function notifyBirthDay()
    {
        $BirthDayModel = new SpedaysModel();
        $result = $BirthDayModel->notifyBirthDay();
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '查找完毕';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '没有查找到信息';
            $res_data['errorresult'] = $result;
            $this->ajaxReturn($res_data);
        }
    }
}

?>