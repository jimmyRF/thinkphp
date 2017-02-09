<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\view;

class IndexController extends Controller
{

  //模块基本信息
  private $data = array(
    'shop_url'  => "/index/shop/read",
  );

  public function index()
    {

      if (isset($_COOKIE['?ext_user'])) {
        $ext_user = base64_decode($_COOKIE['?ext_user']);
        $view = new View();
        $view->assign('ext_user',$ext_user);
      }else{
        $view = new View();
        $view->assign('ext_user','');
      }

        $view->assign('data',$this->data); 
        return $view->fetch('index');
    }

    //修改密码
    public function changepsw(){
      if (!session('?ext_user')) {
        header(strtolower("location: index/login/login"));
        exit();
      }
      
      $view = new View();
       
      return $view->fetch('changepsw'); 
    }
    public function changepassword(){
      $oldpassword = md5(input('request.oldpassword'));
      $newpassword  = input('request.newpassword');
      $newpassword1  = input('request.newpassword1');
      $name=session('ext_user')['admin_name'];
      $changepsw=\app\common\model\Admin::search($name);
      // dump($changepsw['admin_password']);
      $password=$changepsw['admin_password'];
      if ($password==$oldpassword ) {
        if ($newpassword==$newpassword1) {
          $updatepassword=\app\common\model\Admin::updatepassword($name,$newpassword);
          if ($updatepassword) {
            session("ext_user", NULL);
            return $this->success('修改成功，请重新登录', 'index/login/login');
          }else{
            return $this->error("修改密码失败");
          }
        }else{
          return $this->error("两次输入密码不一致");
        }
      }else{
        return $this->error("原密码输入错误");
      }     
    }
}