<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {



    public  function  getPic(&$arr){
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

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
        $this->_link();
        $this->information();
    }

    protected function _link(){
        //友情链接数据获取
        $friendship=M('friendshiplink')->cache(3600)->select();
        $this->friendship=$friendship;
    }

    /*公司资讯*/
    protected function information(){

        $Document = D('Document');


        /* 公司资讯 */
        $category2 = $this->category("GSZX");
        /* 获取当前分类列表 */
        $information= $Document->cache(3600)-> page(1,$category2['list_row'])->limit(6)->lists($category2['id']); /*初中资讯*/


      //  $this->getPic($information);
        $this->information=$information;


    }


	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}


    /* 文档分类检测 */
    public function category($id = 0){
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
