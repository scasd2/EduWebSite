<?php


namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class SchoolController extends HomeController {





    public function index(){

        $this->levelMap=[
            0=>"省一级",
            1=>"市一级",
            2=>"普通级别",
        ];
        $this->SchoolNatureMap=[
            0=>"民办",
            1=>"公办"
        ];
        $this->SchoolTypeMap=[
            0=>"仅高中",
            1=>"仅初中",
            2=>"高中+初中",

        ];


        $level=-1;
        $SchoolNature=-1;
        $SchoolType=-1;

        $level=isset($_GET['level'])?intval(I('level')):-1;
        $SchoolNature=isset($_GET['SchoolNature'])?intval(I('SchoolNature')):-1;
        $SchoolType=isset($_GET['SchoolType'])?intval(I('SchoolType')):-1;


        $this->level=$level;
        $this->SchoolNature=$SchoolNature;
        $this->SchoolType=$SchoolType;


        $school=M('school')->select();


        foreach($school as $key=>$val){



            if($level!=-1){
                if($level!=$val['level']){
                    unset($school[$key]);
                    continue;
                }
            }
            if($SchoolNature!=-1){
                if($SchoolNature!=$val['SchoolNature']){
                    unset($school[$key]);
                    continue;
                }
            }

            if($SchoolType!=-1){
                if($SchoolType!=$val['SchoolType']){
                    unset($school[$key]);
                    continue;
                }
            }



            $pic=M('picture')->where([
                'id'=>$val['picture']
            ])->select();
            if(count($pic)>0){
                $school[$key]['headUrl']=$pic[0]['path'];

            }else{
                $school[$key]['headUrl']='';
            }
        }



            $this->school=$school;


        $this->currentUrl="School/index";
        if(!is_mobile())
            $this->display();
        else
            $this->display("../wap/School/index");
    }

    public function info(){


        $this->levelMap=[
            0=>"省一级",
            1=>"市一级",
            2=>"普通级别",
        ];
        $this->SchoolNatureMap=[
            0=>"民办",
            1=>"公办"
        ];
        $this->SchoolTypeMap=[
            0=>"仅高中",
            1=>"仅初中",
            2=>"高中+初中",

        ];
        $id=I('id');

        $school=M('school')->where([
            'id'=>$id
        ])->select();

        $pic=M('picture')->where([
            'id'=>$school[0]['picture']
        ])->select();
        $school[0]['headPic']=$pic[0]['path'];
        //学院推荐模块
        $recommend=M('school')->where([
            'recommend'=>1
        ])->select();

        $length=count($recommend);
        for ($i=0;$i<$length;$i++) {
            $pics = M('picture')->where([
                'id' => $recommend[$i]['picture']
            ])->select();
            $recommend[$i]['headPic'] = $pics[0]['path'];
        }


        $this->recommend=$recommend;
        $this->school=$school[0];
        if(!is_mobile())
            $this->display();
        else
            $this->display("../wap/School/info");
    }
}