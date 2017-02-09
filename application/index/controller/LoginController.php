<?php
namespace app\index\controller;

use think\View;
use think\Input;
use think\Controller;
use think\captcha;


class LoginController extends Controller
{ 

  public function login(){
    if (isset($_COOKIE['?ext_user'])) {
      $ext_user = base64_decode($_COOKIE['?ext_user']);
      $view = new View();
      $view->assign('ext_user',$ext_user);

      return $view->fetch('login'); 
    }else{
      $view = new View();
      $view->assign('ext_user','');

      return $view->fetch('login');
    }
  }
  //登录
  public function logining()
  {
    $view = new View();
    $name = input('request.name');
    $password  = input('request.password');
    $data = input('request.captcha');

    // if(!captcha_check($data)){
    //  //验证失败
    //     return $this->error("验证码错误");
    // };

    $check=\app\index\model\Member::login($name, $password);

    if ($check) {   
      // header(strtolower("location:"));
      return $this->success("登陆成功",strtolower("location:member/"));
      exit();     
    }
      return $this->error("登陆失败",strtolower("location:index/login/login"));
      exit(); 
  }
  public function register()
  {
    $view = new View();
    $view->assign('ext_user','');
    return $view->fetch('register'); 
  }
  //注册
  public function registering()
  {
    $data = input('post.');
    if (!is_array($data)) {
      return '2';
      exit();
    }
    $name = $data['member_name'];
    $email = $data['member_name'];
    $usersearch=\app\index\model\Member::search($name);
    if ($usersearch) {
      return '3';
      exit();
    }
    if ($email !== '') {
      $usersearch=\app\index\model\Member::search($email);
        if ($usersearch) {
        return '5';
        exit();
      }
    }
    $useradd=\app\index\model\Member::add($data);
    if ($useradd) {
      return '0';
      exit();
    }
    
    // $view = new View();
    // $name = input('request.name');
    // $password  = input('request.password');
    // $data = input('request.captcha');
    // $check=\app\index\model\Member::login($name, $password);
  }
  // 退出登录
  public function logout(){
    cookie('?ext_user',' ');
    return $this->success("退出成功",strtolower("location:index/login/login"));
  }
  // 验证码
  function captcha_img($id = "")
  {
    return '<img src="' . captcha_src($id) . '" alt="captcha" />';
  }
}
