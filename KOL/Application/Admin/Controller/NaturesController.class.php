<?php
/**
 * 内容属性控制类 新增内容属性
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 15:32
 */
namespace Admin\Controller;

use Admin\Model\NaturesModel;
use Think\Controller;

class NaturesController extends Controller
{
    /**
     * 新增内容属性接口
     */
    public function insertNatures()
    {
        I_J('');
        if (IS_POST) {
            $KOLNaturePOST['name'] = $_POST['name'];
            $NaturesModel = new NaturesModel();
            $result = $NaturesModel->addNatures($KOLNaturePOST);
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
     * 编辑内容属性
     */
    public function updateNatures()
    {
        I_J('');
        if (IS_POST) {
            //获取内容属性POST
            $KOLNaturePOST = $_POST['natures'];

            $NatureModel = new NaturesModel();
            //内容属性
            $KOLNature = array(
                'ruid' => $KOLNaturePOST['ruid'],
                'natures' => $KOLNaturePOST['natures']
            );

            $natures = $NatureModel->selectNatures($KOLNature);

            if ($natures) {
                $res_data['errorcode'] = 0;
                $res_data['errormsg'] = '修改成功';
                $this->ajaxReturn($res_data);
            } else {
                $res_data['errorcode'] = 11110000;
                $res_data['errormsg'] = '修改失败';
                $this->ajaxReturn($res_data);
            }
        }
    }
}

?>