<?php
/**
 * 个人信息控制类 新增个人能力
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 15:32
 */
namespace Admin\Controller;

use Admin\Model\AbilitysModel;
use Admin\Model\NaturesModel;
use Think\Controller;

class AbilitysController extends Controller
{
    /**
     * 新增个人能力接口
     */
    public function insertAbilitys()
    {
        I_J('');
        if (IS_POST) {
            $KOLAbilitysPOST['name'] = $_POST['name'];
            $AbilitysModel = new AbilitysModel();
            $result = $AbilitysModel->addAbilitys($KOLAbilitysPOST);
            if ($result) {
                $res_data['errorcode'] = 0;
                $res_data['errormsg'] = '添加成功';
                $this->ajaxReturn($res_data);
            } else {
                $res_data['errorcode'] = 1110;
                $res_data['errormsg'] = '添加失败';
                $this->ajaxReturn($res_data);
            }
        }
    }

    /**
     * 编辑个人能力
     */
    public function updateAbilitys()
    {
        I_J('');
        if (IS_POST) {
            //获取专业能力POST
            $KOLAbilitysPOST = $_POST['abilitys'];

            $AbilitysModel = new AbilitysModel();
            //内容属性
            $KOLNature = array(
                'ruid' => $KOLAbilitysPOST['ruid'],
                'abilitys' => $KOLAbilitysPOST['abilitys']
            );
            $abilitys = $AbilitysModel->selectAbilitys($KOLNature);
            if ($abilitys) {
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