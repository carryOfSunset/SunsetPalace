<?php
/**
 * 黑历史控制类
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 17:10
 */
namespace Admin\Controller;

use Admin\Model\TurnaModel;
use Think\Controller;

class TurnaController extends Controller
{
    /**
     * 编辑界面 添加黑历史
     */
    public function insertTurna()
    {
        I_J('');
        //获取黑标签的请求POST（数组）
        $TurnaPOST = $_POST['turna'];

        $TurnaModel = new TurnaModel();
        //添加黑标签，接收多个黑标签的添加请求
        foreach ($TurnaPOST as $k => $v) {
            $Turna = array(
                'rtime' => $v['rtime'],
                'l_id' => $v['l_id'],
                'url' => $v['url'],
                'remark' => $v['remark'],
                'ruid' => $v['ruid']
            );
            $turna = $TurnaModel->insertTurna($Turna);
        }
        if ($turna) {
            $res_data['errorcode'] = 0;
            $res_data['errormsg'] = '添加成功';
            $this->ajaxReturn($res_data);
        } else {
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = '添加失败';
            $this->ajaxReturn($res_data);
        }
    }


    /**
     * 编辑界面 编辑黑历史
     */
    public function updateTurna()
    {
        I_J('');
        $TurnaPOST['id'] = $_POST['id'];
        $TurnaPOST['rtime'] = $_POST['rtime'];
        $TurnaPOST['l_id    '] = $_POST['l_id'];
        $TurnaPOST['url'] = $_POST['url'];
        $TurnaPOST['remark'] = $_POST['remark'];

        $TurnaModel = new TurnaModel();
        $result = $TurnaModel->updateTurna($TurnaPOST);
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
     * 删除黑历史
     */
    public function deleteTurna()
    {
        I_J('');
        if (IS_POST) {
            $TurnaPOST['id'] = $_POST['id'];

            $TurnaModel = new TurnaModel();
            $result = $TurnaModel->deleteTurna($TurnaPOST);
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
    }

    /**
     * 添加标签
     */
    public function insertLabel()
    {
        I_J('');
        if (IS_POST) {
            $TurnaLabelPOST['name'] = $_POST['name'];

            $LabelModel = new TurnaModel();
            $result = $LabelModel->insertLabel($TurnaLabelPOST);
            if ($result) {
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

    /**
     * 查找黑标签
     */
    public function searchLabel()
    {
        I_J('');
        if (IS_POST) {
            $TurnLabelPOST['id'] = $_POST['id'];

            $LabelModel = new TurnaModel();
            $result = $LabelModel->searchLabel($TurnLabelPOST);
            if ($result) {
                $res_data['errorcode'] = 0;
                $res_data['errormsg'] = '查找完毕';
                $res_data['errorresult'] = $result;
                $this->ajaxReturn($res_data);
            } else {
                $res_data['errorcode'] = 11110000;
                $res_data['errormsg'] = '查找失败';
                $res_data['errorresult'] = null;
                $this->ajaxReturn($res_data);
            }
        }
    }

    /**
     *获取所有黑历史标签
     */
    public function getLabelList()
    {
        $TurnaLabelNodel = new TurnaModel();
        $result = $TurnaLabelNodel->getLabelList();
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
}

?>