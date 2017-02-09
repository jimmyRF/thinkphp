<?php
namespace app\index\controller;

use think\View;
use think\Input;
use think\Controller;
use Captcha;

class Login extends Controller
{ 

    public function login(){
      $view = new View();
      return $view->fetch('login');
    }
    public function logining()
    {
      $view = new View();
      $name = input('request.name');
      $password  = input('request.password');
      $data = input('request.captcha');
      dump($data);
      if(!captcha_check($data)){
       //验证失败
          return $this->error("验证码错误");
      };


       $check=\app\common\model\Admin::login($name, $password);
       if ($check) {
       		// header(strtolower("location:"));
       		header(strtolower("location:". config("web_root") . "index/admin/index"));
			exit();
       }
       
       return $view->fetch('logining'); 
    }

    function captcha_img($id = "")
      {
          return '<img src="' . captcha_src($id) . '" alt="captcha" />';
      }
}
