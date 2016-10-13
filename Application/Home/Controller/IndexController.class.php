<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {


    private  function  getPic(&$arr){
        foreach($arr as $key => $val){
            $pic=M('picture')->where([
                'id'=>$val['cover_id']
            ])->select();
            if(count($pic)>0){
                $arr[$key]['headUrl']=$pic[0]['path'];

            }else{
                $arr[$key]['headUrl']='';
            }

        }
    }

	//系统首页
    public function index(){

/*        $category = D('Category')->getTree();
        $lists    = D('Document')->lists(null);

        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',D('Document')->page);//分页*/

        $Document = D('Document');

        /* 分类信息 */
        $category1 = $this->category("news1");
        /* 获取当前分类列表 */
        $news1= $Document->page(1,$category1['list_row'])->limit(6)->lists($category1['id']); /*小学资讯*/

        /* 分类信息 */
        $category2 = $this->category("news-2");
        /* 获取当前分类列表 */
        $news2= $Document->page(1,$category2['list_row'])->limit(6)->lists($category2['id']); /*初中资讯*/


        /* 分类信息 */
        $category3 = $this->category("news-3");
        /* 获取当前分类列表 */
        $news3= $Document->page(1,$category3['list_row'])->limit(6)->lists($category3['id']); /*高中资讯*/




        $this->getPic($news1);
        $this->getPic($news2);
        $this->getPic($news3);


        $this->news1=$news1;
        $this->news2=$news2;
        $this->news3=$news3;
        //轮播数据获取
        $carousel=M('carousel')->select();
        $length=count($carousel);
        for($i=0;$i<$length;$i++){
            $pic=M('picture')->where([
                'id'=>$carousel[$i]['picture']
            ])->select();
            $carousel[$i]['headPic']=$pic[0]['path'];
        }
        $this->carousel=$carousel;

        $this->currentUrl="Index/index";
        //教师推荐模块
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

        $recommend=M('teachers')->where([
            'recommend'=>1
        ])->select();
        $length=count($recommend);
        for ($i=0;$i<$length;$i++) {
            $pics = M('picture')->where([
                'id' => $recommend[$i]['head']
            ])->select();
            $recommend[$i]['headPic'] = $pics[0]['path'];
        }
        $this->recommend=$recommend;
        //推荐课程块
        $recommends=M('curriculum')->where([
            'hot'=>1
        ])->select();

        $length=count($recommends);
        for ($i=0;$i<$length;$i++) {
            $pics = M('picture')->where([
                'id' => $recommends[$i]['picture']
            ])->select();
            $recommends[$i]['headPic'] = $pics[0]['path'];
        }

        $this->recommends=$recommends;

        if(!is_mobile())
            $this->display();
        else
            $this->display("../wap/Index/index");

    }


    /* 文档分类检测 */
    private function category($id = 0){
        /* 标识正确性检测 */
        $id = $id ? $id : I('get.category', 0);
        if(empty($id)){
            $this->error('没有指定文档分类！');
        }

        /* 获取分类信息 */
        $category = D('Category')->info($id);
        if($category && 1 == $category['status']){
            switch ($category['display']) {
                case 0:
                    $this->error('该分类禁止显示！');
                    break;
                //TODO: 更多分类显示状态判断
                default:
                    return $category;
            }
        } else {
            $this->error('分类不存在或被禁用！');
        }
    }

}