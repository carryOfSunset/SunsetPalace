<?php
/**
 * 平台相关控制类 展示所有平台,修改平台，删除平台
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 15:48
 */
namespace Admin\Controller;

use Admin\Model\SwayModel;
use Think\Controller;

class SwayController extends Controller
{
    /**
     * 编辑界面 平台展示
     */
    public function getSwayList()
    {
        I_J('');
        $SwayPOST['ruid'] = $_POST['ruid'];
        $SwayModel = new SwayModel();
        $result = $SwayModel->getSway($SwayPOST);
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
     * 编辑界面 平台编辑
     */
    public function updateSway()
    {
        I_J('');
        $SwayPOST['id'] = $_POST['id'];
        $SwayPOST['n_id'] = $_POST['n_id'];
        $SwayPOST['nick_name'] = $_POST['nick_name'];
        $SwayPOST['url'] = $_POST['url'];
        $SwayPOST['fansnum'] = $_POST['fansnum'];
        $SwayPOST['readnum'] = $_POST['readnum'];
        $SwayPOST['paction'] = $_POST['paction'];

        $SwayModel = new SwayModel();
        $result = $SwayModel->updateSway($SwayPOST);
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '修改成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '修改失败';
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 编辑界面 删除平台
     */
    public function deleteSway()
    {
        I_J('');
        $SwayPOST['id'] = $_POST['id'];

        $SwayModel = new SwayModel();
        $result = $SwayModel->deleteSway($SwayPOST);
        if ($result) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '删除成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '删除失败';
            $this->ajaxReturn($res_data);
        }
    }

    /**
     * 编辑界面 添加平台
     */
    public function insertSway()
    {
        I_J('');
        //获取平台信息POST（数组）
        $KOLSwayPOST = $_POST['sway'];

        $SwayModel = new SwayModel();
        //添加平台信息，接收多个平台的添加请求
        foreach ($KOLSwayPOST as $k => $v) {
            $KOLSway = array(
                'ruid' => $v['ruid'],
                'n_id' => $v['n_id'],                         //平台影响力id
                'nick_name' => $v['nick_name'],             //KOL昵称
                'url' => $v['url'],                           //首页url
                'fansnum' => $v['fansnum'],                  //粉丝数量
                'readnum' => $v['readnum'],                  //平均阅读数
                'paction' => $v['paction']                   //合作协议
            );
            //读取完一次后，添加数据库..血染江山的画，怎敌你眉间一点朱砂
            $sway = $SwayModel->addSway($KOLSway);
        }
        if ($sway) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '添加成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '添加失败';
            $this->ajaxReturn($res_data);
        }
    }
}

?>