<?php
namespace app\index\model;

use think\Input;

class Member extends \think\Model
{
    public static function login($name, $password)
    {

        $where['member_name'] = $name;
        $where['member_password'] = md5($password);

        $user=Member::where($where)->find();

        if ($user) {
            unset($user["password"]);
            cookie('?ext_user',base64_encode($name),3600);
            return true;
        }else{
            return false;
        }
    }


    // 查询一条数据
    public static function search($name){
        $where['member_name'] = $name;
        $user=Member::where($where)->find();
        return $user;
    }

    // 更新数据
    public static function add($data){
        $where = $data;
        $user=Member::insert($data);
        return $user;
    }

    //更改用户密码
    public static function updatepassword($name,$newpassword){
        $where['member_name'] = $name;
        $user=Member::where($where)->update(['member_password' => md5($newpassword)]);
        if ($user) {
            return true;
        }else{
            return false;
        }
    }

    
} 
 