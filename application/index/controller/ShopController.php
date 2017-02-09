<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\view;
use app\index\model\Shop;

class ShopController extends Controller
{

	//模块基本信息
	private $data = array(
		'module_url' => 'read',
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
		$map['shop_status'] = ['>=','0'];
		$list =  Shop::where($map)
	                    ->order('id', 'DESC')
	                    ->paginate();
	    for ($i=0; $i < count($list); $i++) {
	        $str = preg_replace('/\/\?|"/',"",htmlspecialchars_decode($list[$i]['shop_status'])); 
	    	$list[$i]['rarcurl'] = str_replace(" ","-","$str"). "-" . $list[$i]['id'] . "-" . $list[$i]['shop_aid']. ".html";
	    }
	    $view->assign('data',$this->data);
	    $view->assign('list',$list);

		return $view->fetch('shop');
	}
	public function wangluo()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$map['shop_aid'] = 1;
		$list =  Shop::where($map)
	                    ->order('id', 'DESC')
	                    ->paginate();
	    for ($i=0; $i < count($list); $i++) {
	        $str = preg_replace('/\/\?|"/',"",htmlspecialchars_decode($list[$i]['shop_status'])); 
	    	$list[$i]['rarcurl'] = str_replace(" ","-","$str"). "-" . $list[$i]['id'] . "-" . $list[$i]['shop_aid']. ".html";
	    }
	    $view->assign('data',$this->data);
	    $view->assign('list',$list);
		return $view->fetch('wangluo');
	}
	public function shouji()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$map['shop_aid'] = 2;
		$list =  Shop::where($map)
	                    ->order('id', 'DESC')
	                    ->paginate();
	    for ($i=0; $i < count($list); $i++) {
	        $str = preg_replace('/\/\?|"/',"",htmlspecialchars_decode($list[$i]['shop_status'])); 
	    	$list[$i]['rarcurl'] = str_replace(" ","-","$str"). "-" . $list[$i]['id'] . "-" . $list[$i]['shop_aid']. ".html";
	    }
	    $view->assign('data',$this->data);
	    $view->assign('list',$list);
		return $view->fetch('shouji');
	}
	public function wangye()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$map['shop_aid'] = 3;
		$list =  Shop::where($map)
	                    ->order('id', 'DESC')
	                    ->paginate();
	    for ($i=0; $i < count($list); $i++) {
	        $str = preg_replace('/\/\?|"/',"",htmlspecialchars_decode($list[$i]['shop_status'])); 
	    	$list[$i]['rarcurl'] = str_replace(" ","-","$str"). "-" . $list[$i]['id'] . "-" . $list[$i]['shop_aid']. ".html";
	    }
	    $view->assign('data',$this->data);
	    $view->assign('list',$list);
		return $view->fetch('wangye');
	}
	public function qipai()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$map['shop_aid'] = 4;
		$list =  Shop::where($map)
	                    ->order('id', 'DESC')
	                    ->paginate();
	    for ($i=0; $i < count($list); $i++) {
	        $str = preg_replace('/\/\?|"/',"",htmlspecialchars_decode($list[$i]['shop_status'])); 
	    	$list[$i]['rarcurl'] = str_replace(" ","-","$str"). "-" . $list[$i]['id'] . "-" . $list[$i]['shop_aid']. ".html";
	    }
	    $view->assign('data',$this->data);
	    $view->assign('list',$list);
		return $view->fetch('qipai');
	} 

	    /**
     * [read 读取商品数据]
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
        $item = Shop::get($id);

        $this->assign('item',$item);
        $this->assign('data',$this->data);

        return view();
    }

    public function car()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$data = input('post.');
		if (!is_array($data)) {
		    return $this->error("加入购物车失败",strtolower("location:index/shop"));
			exit();
		}

		$id =empty($data['id'])? "" : intval($data['id']);
		$buynum = isset($data['buynum']) && is_numeric($data['buynum']) ? $data['buynum'] : 1;
		$buynum = ($buynum < 1) ? 1 : $buynum;
		$item = Shop::get($id);

        if($item['id'] == '')
        {
		    return $this->error("该商品已不存在！",strtolower("location:shop"));
			exit();
        } 
        $item['buynum'] = $buynum;
        $item['total_price'] = $item['shop_price']*$buynum;
       
        $view->assign('item',$item);
	    $view->assign('data',$this->data);

		return $view->fetch('car');
	} 
	public function buy()
	{
		if (isset($_COOKIE['?ext_user'])) {
			$ext_user = base64_decode($_COOKIE['?ext_user']);
			$view = new View();
			$view->assign('ext_user',$ext_user);		 
		}else{
			$view = new View();
			$view->assign('ext_user','');
		}
		$data = input('post.');
		if (!is_array($data)) {
		    return $this->error("加入购物车失败",strtolower("location:index/shop"));
			exit();
		}

		$id =empty($data['id'])? "" : intval($data['id']);
		$buynum = isset($data['buynum']) && is_numeric($data['buynum']) ? $data['buynum'] : 1;
		$buynum = ($buynum < 1) ? 1 : $buynum;
		$item = Shop::get($id);

        if($item['id'] == '')
        {
		    return $this->error("该商品已不存在！",strtolower("location:shop"));
			exit();
        } 
        $item['buynum'] = $buynum;
        $item['total_price'] = $item['shop_price']*$buynum;
       
        $view->assign('item',$item);
	    $view->assign('data',$this->data);

		return $view->fetch('car');
	}          
}