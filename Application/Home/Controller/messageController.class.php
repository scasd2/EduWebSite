<?php
namespace Home\Controller;
use OT\DataDictionary;

class MessageController extends HomeController {
    public function index(){
        $this->display();
    }

    /*异步提交留言*/
    public function ajaxSubmit(){
        if(M('message')->add($_POST)){
            $this->ajaxReturn([
                "msg"=>"留言成功"
            ],'json');
        }else{
            $this->ajaxReturn([
                "msg"=>"留言失败"
            ],'json');
        }

    }

}
