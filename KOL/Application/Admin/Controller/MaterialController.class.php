<?php
/**
 * 文件上传控制器 文件上传
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/26
 * Time: 9:57
 */
namespace Admin\Controller;

use Admin\Model\MaterialModel;
use Think\Controller;

class MaterialController extends Controller
{
    /**
     * KOL 素材上传接口...
     */
    public function uploadImg()
    {
        if (!empty($_FILES)) {
            $config = array(
                'maxSize' => 3145728,
                'rootPath' => './',
                'savePath' => '/upload/',
                'saveName' => array('uniqid', ''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => true,
                'subName' => array('date', 'Ymd'),
            );
            $upload = new \Think\Upload($config);
            $info = $upload->upload();
            if (!$info) {
                $this->error($upload->getError());
            } else {
                foreach ($info as $k => $file) {
                    //存放到服务器上时，还需要在前面设定具体的服务器地址
                    $file_name = '/mywork' . __ROOT__ . $file['savepath'] . $file['savename'];
                    $data = array(
                        'time' => date('y-m-d h:i:s', time()),
                        'obj_path' => $file_name
                    );
                    $FileData[$k] = $data;
                }
                if ($FileData) {
                    $res_data['errorcode'] = 0;
                    $res_data['errormsg'] = '上传成功';
                    $res_data['errorresult'] = $FileData;
                    $this->ajaxReturn($res_data);
                } else {
                    $res_data['errorcode'] = 11110000;
                    $res_data['errormsg'] = '上传失败';
                    $res_data['errorresult'] = null;
                    $this->ajaxReturn($res_data);
                }
            }
        } else {
            #$this->display();
        }
    }

    /**
     * KOL 头像设置接口
     */
    public function manageImg()
    {
        I_J('');
        if (IS_POST) {
            $materialPOST['ruid'] = $_POST['ruid'];
            $materialPOST['type'] = $_POST['type'];
            $materialPOST['obj_path'] = $_POST['obj_path'];

            $MaterialModel = new MaterialModel();
            $result = $MaterialModel->manageImg($materialPOST);
            if ($result) {
                $res_data['errorcode'] = 0;
                $res_data['errormsg'] = '设置成功';
                $this->ajaxReturn($res_data);
            } else {
                $res_data['errorcode'] = 11110000;
                $res_data['errormsg'] = '设置失败';
                $this->ajaxReturn($res_data);
            }
        }
    }
}

?>