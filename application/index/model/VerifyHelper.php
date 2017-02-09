<?php
namespace app\common\model;

use think\Input;

class Admin extends \think\Model
{
    public static function login($name, $password)
    {

        $where['admin_name'] = $name;
        $where['admin_password'] = md5($password);

        $user=Admin::where($where)->find();
        if ($user) {
            unset($user["password"]);
            session("ext_user", $user);
            return true;
        }else{
            return false;
        }
    }


  
    // 退出登录
    public static function logout(){
        session("ext_user", NULL);
        return [
            "code" => 0,
            "desc" => "退出成功"
        ]; 
    }

    // 查询一条数据
    public static function search($name){
        $where['admin_name'] = $name;
        $user=Admin::where($where)->find();
        return $user;
        // dump($user['admin_password']);
    }

    //更改用户密码

    public static function updatepassword($name,$newpassword){
        $where['admin_name'] = $name;
        $user=Admin::where($where)->update(['admin_password' => md5($newpassword)]);
        if ($user) {
            return true;
        }else{
            return false;
        }
    }

    
} 
 