<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\view;

class MemberController extends Controller
{
 public function index()
    {

      if (isset($_COOKIE['?ext_user'])) {
        if ($_COOKIE['?ext_user'] == ' ') {
            header(strtolower("location: ./login/login"));
            exit();
        }else{
            $ext_user = base64_decode($_COOKIE['?ext_user']);
            $view = new View();
            $view->assign('ext_user',$ext_user);

            return $view->fetch('member'); 
        }

      }else{
        header(strtolower("location: ./login/login"));
        exit();
      }
        
    }
    //修改密码
    public function changepsw(){
      if (isset($_COOKIE['?ext_user'])) {
        if ($_COOKIE['?ext_user'] == ' '){
        header(strtolower("location: ./login/login"));
        exit();
        }else{
          $view = new View();
          $ext_user = base64_decode($_COOKIE['?ext_user']);
          $view->assign('ext_user',$ext_user);
          return $view->fetch('changepsw'); 
        }
      }else{
        header(strtolower("location: ./login/login"));
        exit(); 
      }      
    }
    public function changepassword(){

      $oldpassword = input('request.oldpassword');
      $newpassword  = input('request.newpassword');
      $newpassword1  = input('request.newpassword1');
      $name = base64_decode($_COOKIE['?ext_user']);
      $check=\app\index\model\Member::login($name, $oldpassword);
      if ($check){
          $updatepassword=\app\index\model\Member::updatepassword($name, $newpassword);
          if ($updatepassword) {
            cookie('?ext_user',' ');
            return $this->success('修改成功，请重新登录', '../index/login/login');
          }else{
            return $this->error("修改密码失败");
          }
      }else{
        return $this->error("原密码输入错误");
      }     
    }
    //个人资料
    public function person(){
      if (isset($_COOKIE['?ext_user'])) {
        if ($_COOKIE['?ext_user'] == ' '){
        header(strtolower("location: ./login/login"));
        exit();
        }else{
          $view = new View();
          $ext_user = base64_decode($_COOKIE['?ext_user']);
          $view->assign('ext_user',$ext_user);
          return $view->fetch('person'); 
        }
      }else{
        header(strtolower("location: ./login/login"));
        exit(); 
      }      
    }
    public function addperson(){
      $data = input('post.');
      if (isset($_COOKIE['?ext_user'])){
          if ($_COOKIE['?ext_user'] !== ' '){
              $addperson=\app\index\model\Member::add($data);
              if ($addperson) {
                return $this->success('更新成功', '../index/login/login');
              }else{
                return $this->error("更新失败");
              }
          }else{
            return $this->error("请先登录",'../index/login/login');
          } 
      }else{
          return $this->error("请先登录",'../index/login/login');
      }
    
    }
}