<?php
/**
 * KOL添加总控制器
 * User: IT.SECPFSE Mercury
 * Date: 2016/8/23
 * Time: 9:24
 */
namespace Admin\Controller;

use Admin\Model\AbilitysModel;
use Admin\Model\MaterialModel;
use Admin\Model\NaturesModel;
use Admin\Model\ReduserModel;
use Admin\Model\SpedaysModel;
use Admin\Model\SwayModel;
use Admin\Model\TurnaModel;
use Think\Controller;

class InsertKOLController extends Controller
{
    /**
     * 新增KOL总数据接口
     */
    public function insertKOL()
    {
        //接受所有POST数据
        I_J('');
        if (IS_POST) {
            //获取POST基本信息（数组）..别让我再见到你
            $KOLBasicInfoPOST = $_POST['basicInfo'];
            //获取头像设定POST
            $KOLMaterialPOST = $_POST['material'];
            //获取内容属性POST
            $KOLNaturePOST = $_POST['natures'];
            //获取专业能力POST
            $KOLAbilitysPOST = $_POST['abilitys'];
            //获取平台信息POST（数组）
            $KOLSwayPOST = $_POST['sway'];
            //获取特殊信息POST
            $KOLSpecialInfoPOST = $_POST['speInfo'];
            //获取新增日期的POST（数组）
            $KOLSpecialDayPOST = $_POST['speday'];
            //获取黑标签的请求POST（数组）
            $KOLTurnaPOST = $_POST['turna'];

            //初始化返回数据
            $res_data['errorcode'] = 11110000;
            $res_data['errormsg'] = 'ERROR';

            //将获取到的基本信息重新封装成KOLBasicInfo
            $KOLBasicInfo = array(
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
            $RedUserModel = new ReduserModel();
            if (!($RedUserModel->checkUsername($KOLBasicInfoPOST['username']))) {
                $res_data['errormsg'] = '用户名格式不正确';
                $this->ajaxReturn($res_data);
            } elseif (!($RedUserModel->checkTel($KOLBasicInfoPOST['tel']))) {
                $res_data['errormsg'] = '手机号码格式不正确';
                $this->ajaxReturn($res_data);
            } elseif (!($RedUserModel->checkEmail($KOLBasicInfoPOST['email']))) {
                $res_data['errormsg'] = '电子邮箱格式不正确';
                $this->ajaxReturn($res_data);
            } elseif ($RedUserModel->checkTelUnique($KOLBasicInfoPOST['tel'])) {
                $res_data['errormsg'] = '手机号码已有备案';
                $this->ajaxReturn($res_data);
            } elseif ($RedUserModel->checkEmailUnique($KOLBasicInfoPOST['email'])) {
                $res_data['errormsg'] = '电子邮箱已有备案';
                $this->ajaxReturn($res_data);
            } else {
                $RUID = $RedUserModel->insertRedUser($KOLBasicInfo);

                //实例化模型类
                $NatureModel = new NaturesModel();
                $AbilitysModel = new AbilitysModel();
                $SpedaysModel = new SpedaysModel();
                $SwayModel = new SwayModel();
                $TurnaModel = new TurnaModel();
                $MaterialModel = new MaterialModel();

                //上传logo属性
                $KOLMaterial = array(
                    'ruid' => $RUID,
                    'type' => $KOLMaterialPOST['type'],
                    'obj_path' => $KOLMaterialPOST['obj_path']
                );
                $material = $MaterialModel->manageImg($KOLMaterial);

                //内容属性
                $KOLNature = array(
                    'ruid' => $RUID,
                    'natures' => $KOLNaturePOST['natures']
                );
                $natures = $NatureModel->selectNatures($KOLNature);

                //专业能力
                $KOLAbilitys = array(
                    'ruid' => $RUID,
                    'abilitys' => $KOLAbilitysPOST['abilitys']
                );
                $abilitys = $AbilitysModel->selectAbilitys($KOLAbilitys);

                //添加平台信息，接收多个平台的添加请求
                foreach ($KOLSwayPOST as $k => $v) {
                    $KOLSway = array(
                        'ruid' => $RUID,
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

                //特殊信息
                $KOLSpecialInfo = array(
                    'ruid' => $RUID,
                    'bday' => $KOLSpecialInfoPOST['bday'],                                  //生日
                    'hobbys' => $KOLSpecialInfoPOST['hobbys'],                              //喜好
                    'rank' => $KOLSpecialInfoPOST['rank'],                                  //等级
                    'dye' => $KOLSpecialInfoPOST['dye']                                     //颜值
                );
                $specialInfo = $SpedaysModel->insertSpeInfo($KOLSpecialInfo);

                //新增特殊日，接收多个特殊日的添加请求
                foreach ($KOLSpecialDayPOST as $k => $v) {
                    $KOLSpecialDay = array(
                        'rtime' => $v['rtime'],
                        'name' => $v['name'],
                        'ruid' => $RUID
                    );
                    $specialday = $SpedaysModel->insertSpecialDays($KOLSpecialDay);
                }

                //添加黑标签，接收多个黑标签的添加请求
                foreach ($KOLTurnaPOST as $k => $v) {
                    $KOLTurna = array(
                        'rtime' => $v['rtime'],
                        'l_id' => $v['l_id'],
                        'url' => $v['url'],
                        'remark' => $v['remark'],
                        'ruid' => $RUID
                    );
                    $turna = $TurnaModel->insertTurna($KOLTurna);
                }

                //添加完之后判断
                if (!$material) {
                    $res_data['errormsg'] = '设置头像失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$sway) {
                    $res_data['errormsg'] = '平台添加失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$natures) {
                    $res_data['errormsg'] = '内容属性选择失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$abilitys) {
                    $res_data['errormsg'] = '专业能力选择失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$specialInfo) {
                    $res_data['errormsg'] = '特殊信息添加失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$specialday) {
                    $res_data['errormsg'] = '特殊日添加失败';
                    $this->ajaxReturn($res_data);
                } elseif (!$turna) {
                    $res_data['errormsg'] = '黑历史添加失败';
                    $this->ajaxReturn($res_data);
                } else {
                    $res_data['errorcode'] = 0;
                    $res_data['errormsg'] = '添加成功';
                    $this->ajaxReturn($res_data);
                }
            }
        }
    }
}

?>