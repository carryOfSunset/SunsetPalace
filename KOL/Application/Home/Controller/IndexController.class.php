<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        header("Content-Type:text/html; charset=utf-8");
        $basicInfo = array(
            array(
                'name' => '张三',
                'c_id' => '1',
                'sex' => '0',
                'age' => '70S',
                's_id' => '0',
                'username' => '张三',
                'tel' => '13867381576',
                'email' => '969128101@qq.com',
                'address' => '可谓艺术风格一起',
                'remark' => '而我库房也',
                'brands' => ['1', '2']
            ),
            array(
                'name' => '李斯',
                'c_id' => '1',
                'sex' => '0',
                'age' => '70S',
                's_id' => '0',
                'username' => '李斯',
                'tel' => '13867381576',
                'email' => '969128101@qq.com',
                'address' => '可谓艺术风格一起',
                'remark' => '而我库房也',
                'brands' => ['1', '2']
            ),
            array(
                'name' => '王五',
                'c_id' => '1',
                'sex' => '0',
                'age' => '70S',
                's_id' => '0',
                'username' => '李斯',
                'tel' => '13867381576',
                'email' => '969128101@qq.com',
                'address' => '可谓艺术风格一起',
                'remark' => '而我库房也',
                'brands' => ['1', '2']
            ),

        );

        $str = json_encode($basicInfo, JSON_UNESCAPED_UNICODE);
        echo count($basicInfo[1]);
    }
}