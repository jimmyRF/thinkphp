<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\view;
use app\index\model\Forum;

class ForumController extends Controller
{
    public function index(){
		if (isset($_COOKIE['?ext_user'])) {
		  $ext_user = base64_decode($_COOKIE['?ext_user']);
		  $view = new View();
		  $view->assign('ext_user',$ext_user);
		}else{
		  $view = new View();
		  $view->assign('ext_user','');
		}
		return $view->fetch('forum');
    }
    /**
     * [read 读取评论数据]
     * @param  string $id [商品ID]
     * @return [type]     [description]
     */
    public function read($id='')
    {

    	if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$this->assign('ext_user',$ext_user);		 
		}else{
			$this->assign('ext_user','');
		}

        //默认值设置
        $item = Forum::get($id);
        $map['forum_aid'] = $item['forum_aid'];
        $list =  Forum::where($map)
                ->order('create_time', 'DESC')
                ->paginate();

        for ($i=0; $i < count($list); $i++) { 
            $list[$i]['create_time'] = date('Y-m-d H-i-s', $list[$i]['create_time']);
            $list[$i]['update_time'] = date('Y-m-d H-i-s', $list[$i]['update_time']); 
        }        

        $this->assign('id',$id);
        $this->assign('list',$list);
        return view();
    }
    public function create($id='')
    {

        if (isset($_COOKIE['?ext_user'])) {

            //默认值设置
            $item = Forum::get($id);
            if ($item['forum_aid'] == '') {
                echo "false1";
                exit(); 
            }else{
                echo "ok";
                exit();  
            }        
        }else{
            echo "false2";;
            exit(); 
        }

    }
}