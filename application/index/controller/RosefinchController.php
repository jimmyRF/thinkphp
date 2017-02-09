<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\view;

class RosefinchController extends Controller
{
 public function index()
    {
    $view = new View();
    $view->assign('ext_user','');
    return $view->fetch('Rosefinch');
    }
}