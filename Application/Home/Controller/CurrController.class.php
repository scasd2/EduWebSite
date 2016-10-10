<?php


namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class CurrController extends HomeController {
    public function index(){


        /*        $category = D('Category')->getTree();
                $lists    = D('Document')->lists(null);

                $this->assign('category',$category);//栏目
                $this->assign('lists',$lists);//列表
                $this->assign('page',D('Document')->page);//分页*/
        $grade=-1;/*年级*/
        $subject=-1;/*科目*/
        $grade=isset($_GET['grade'])?intval(I('grade')):-1;
        $subject=isset($_GET['subject'])?intval(I('subject')):-1;
        $this->grade=$grade;
        $this->subject=$subject;


        $teachers=M('curriculum')->select();


        foreach($teachers as $key=>$val){


            if($grade!=-1){
                if($grade!=$val['CurriculumLevel']){
                    unset($teachers[$key]);
                    continue;
                }
            }
            if($subject!=-1){
                if($subject!=$val['CourseType']){
                    unset($teachers[$key]);
                    continue;
                }
            }

            $pic=M('picture')->where([
                'id'=>$val['picture']
            ])->select();
            if(count($pic)>0){
                $teachers[$key]['headUrl']=$pic[0]['path'];

            }else{
                $teachers[$key]['headUrl']='';
            }
        }
        $this->teachers=$teachers;


        $gradeMap=[
            0=>"小学",
            1=>"初中",
            2=>"高中",
        ];
        $this->gradeMap=$gradeMap;


        $subjectMap=[
            0=>'语文',
            1=>'数学',
            2=>'英语',
            3=>'历史',
            4=>'地理',
            5=>'生物',
            6=>'政治',
            7=>'化学',
            8=>'物理',
        ];
        $this->subjectMap=$subjectMap;








        $this->currentUrl="Curr/index"."?grade=".$grade;
        $this->display();
    }
}