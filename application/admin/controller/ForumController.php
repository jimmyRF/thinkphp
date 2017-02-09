<?php
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Forum;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
class ForumController extends AdminAuth
{
	//模块基本信息
	private $data = array(
		'module_name' => '论坛',
		'module_url'  => "/admin/forum/",
		'module_slug' => 'forum',
		'upload_path' => UPLOAD_PATH,
		'upload_url'  => '/public/uploads/',
        'ckeditor'    => array(
            'id'     => 'ckeditor_post_content',
            //Optionnal values
            'config' => array(
                'width'  => "100%", //Setting a custom width
                'height' => '400px',
                // 默认调用 Standard Package，以下代码为调用自定义工具栏，这些基础的主要用于前台用户富文本设置
                // 'toolbar'   =>  array(  //Setting a custom toolbar
                //     array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'),
                //     array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
                //     array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
                //     array('Styles','Format','Font','FontSize'),
                //     array('TextColor','BGColor')
                // )
            )
        ),
	);


    /**
     * [index 获取商品数据列表]
     * @return [type] [description]
     */
    public function index()
    {
        $request = request();
        $param = $request->param();

        if(!empty($param)){
            $this->data['search'] = $param;
            if(isset($param['title'])){
                $map['forum_title'] = ['like','%'.$param['title'].'%'];
            }
        }
        $map['id'] = ['>=','0'];
        $list =  Forum::where($map)
                        ->order('id', 'DESC')
                        ->paginate();



        $this->assign('data',$this->data);
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * [create 创建商品数据页面]
     * @return [type] [description]
     */
    public function create()
    {
        $admins = Administrator::where('status',1)->column('nickname','id');

        $this->data['edit_fields'] = array(
            'shop_aid'         => array('type' => 'radio', 'label' => '所属板块','default'=> array(1 => '网络游戏', 2 => '手机游戏', 3 => '网页游戏',4 => '棋牌游戏')),            
            'shop_name'     => array('type' => 'text', 'label' => '商品名'),
            'shop_area'   => array('type' => 'text', 'label' => '商品区服'),
            'shop_type'   => array('type' => 'text', 'label' => '商品交易类型'),
            'shop_price'   => array('type' => 'text', 'label' => '商品交易价格'),

            // 'post_content'   => array('type' => 'textarea', 'label' => '内容','id'=>'ckeditor_post_content'),
            'shop_img'  => array('type' => 'file','label'     => '商品图片'),
            'shop_status'         => array('type' => 'radio', 'label' => '状态','default'=> array( 0 => '编辑中', 1 => '发布',2 => '待审核')),
            // 'hr1'            => array('type' => 'hr'),
            // 'alert1'         => array('type' => 'alert', 'default' => '其它信息'),
            // 'post_author'    => array('type' => 'select', 'label' => '作者','default' => $admins, 'extra'=>array('wrapper'=>'col-sm-3')),
            // 'post_password'  => array('type' => 'text', 'label' => '访问密码','notes'=>'默认不填则可以直接访问', 'extra'=>array('wrapper'=>'col-sm-3')),
            // 'comment_status' => array('type' => 'select', 'label' => '评论开关', 'default' => array('opened'=>'打开','closed' => '关闭'), 'extra'=>array('wrapper'=>'col-sm-3')),
            'shop_createtime'    => array('type' => 'text', 'label' => '发布时间','class'=>'datepicker','extra'=>array('data'=>array('format'=>'YYYY-MM-DD hh:mm:ss'),'wrapper'=>'col-sm-3')),
            // 'hr2'            => array('type' => 'hr'),
        );

        //默认值设置
        $item['shop_status']         = '发布';
        // $item['comment_status'] = config('comment_toggle') ? '打开' : '关闭';
        $item['shop_createtime']    = date('Y-m-d H:i:s');

        $this->assign('item',$item);
        $this->assign('data',$this->data);
        return view();
    }

    /**
     * [add 新增商品数据ACTION，create()页面表单数据提交到这里]
     * @return [type] [description]
     */
    public function add()
    {
        $forum = new Forum;
        $data = input('post.');
        $rule = [
            'shop_name|商品名' => 'require',
            'shop_status|商品状态' => 'require',
        ];
        // 数据验证
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }

        $data['shop_img'] = $this->upload();
        if(!$data['shop_img']){
            unset($data['shop_img']);
        }

        $data['shop_createtime'] = $data['shop_createtime'] ? strtotime($data['shop_createtime']) : time();
        $data['update_time'] = time();


        if ($id = $shops->validate(true)->insertGetId($data)) {
            $url='http://'.$_SERVER['SERVER_NAME'];
            return $this->success('商品添加成功',$url.'/thinkphp/admin/shops/read?id='.$id);
        } else {
            return $this->error($posts->getError());
        }
    }



    /**
     * [read 读取商品数据]
     * @param  string $id [商品ID]
     * @return [type]     [description]
     */
    public function read($id='')
    {
        $admins = Administrator::where('status',1)->column('nickname','id');

        $this->data['edit_fields'] = array(
            'forum_aid'         => array('type' => 'radio', 'label' => '所属板块','default'=> array(1 => '网络游戏', 2 => '手机游戏', 3 => '网页游戏',4 => '棋牌游戏')),            
            'forum_title'     => array('type' => 'text', 'label' => '标题'),

            'forum_content'   => array('type' => 'textarea', 'label' => '内容','id'=>'ckeditor_post_content'),

            // 'post_password'  => array('type' => 'text', 'label' => '访问密码','notes'=>'默认不填则可以直接访问', 'extra'=>array('wrapper'=>'col-sm-3')),
            // 'comment_status' => array('type' => 'select', 'label' => '评论开关', 'default' => array('opened'=>'打开','closed' => '关闭'), 'extra'=>array('wrapper'=>'col-sm-3')),
            // 'update_time'    => array('type' => 'text', 'label' => '发布时间','class'=>'datepicker','extra'=>array('data'=>array('format'=>'YYYY-MM-DD hh:mm:ss'),'wrapper'=>'col-sm-3')),
        );

        //默认值设置
        $item = Forum::get($id);
        $item['forum_content'] = str_replace('&', '&amp;', $item['forum_content']);

        $this->assign('item',$item);
        $this->assign('data',$this->data);

        return view();
    }

    /**
     * [update 更新商品数据，read()提交表单数据到这里]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id)
    {
        $shops = new Shops;
        $data = input('post.');

        $rule = [
            //字段验证
            'shop_name|商品名' => 'require',
            'shop_status|商品状态' => 'require',
        ];
        $msg = [];

        // 数据验证
        $validate = new Validate($rule,$msg);
        $result   = $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }

        $data['id'] = $id;

        $data['shop_img'] = $this->upload();
        if(!$data['shop_img']){
        	unset($data['shop_img']);
        }

        if ($shops->update($data)) {
            $url='http://'.$_SERVER['SERVER_NAME'];
            return $this->success('更新成功',$url.'/thinkphp/admin/shops/read?id='.$id);
        } else {
            return $shops->getError();
        }
    }

    /**
     * [upload 图片上传]
     * @return [type] [description]
     */
    public function upload(){
	    // 获取表单上传文件
	    $file = request()->file('shop_img');
	    if($file){
	        if (true !== $this->validate(['shop_img' => $file], ['shop_img' => 'image'])) {
	            $this->error('请选择图像文件');
	        } else {
	        	$info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads'); //保存原图

	            // 读取图片
	            $image = Image::open($file);
	            // 图片处理
	            $image_type = request()->param('type') ? request()->param('type') : 1;
	            switch ($image_type) {
	                case 1: // 缩略图
	                    $image->thumb(150, 150, Image::THUMB_CENTER);
	                    break;
	                case 2: // 图片裁剪
	                    $image->crop(300, 300);
	                    break;
	                case 3: // 垂直翻转
	                    $image->flip();
	                    break;
	                case 4: // 水平翻转
	                    $image->flip(Image::FLIP_Y);
	                    break;
	                case 5: // 图片旋转
	                    $image->rotate();
	                    break;
	                case 6: // 图片水印
	                    $image->water(ROOT_PATH . 'public/static/images/logo.png', Image::WATER_NORTHWEST, 50);
	                    break;
	                case 7: // 文字水印
	                    $image->text('ThinkPHP', VENDOR_PATH . 'topthink/think-captcha/assets/ttfs/1.ttf', 20, '#ffffff');
	                    break;
	            }
	            $this->sourceFile = $info->getFilename();

	            $fileName = explode('.',$info->getFilename());
	            $saveName = $fileName[0] . '_thumb.' .$info->getExtension();
	            $image->save($this->data['upload_path'] .'/'. $saveName);

	            $this->imageThumbName = $saveName;

	            return $this->imageThumbName;
	        }
	    }else{
	     	return false;
	    }
	}

    /**
     * [delete 删除商品数据(伪删除)]
     * @param  [type] $id [表ID]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $posts = new Posts;
        $data['id'] = $id;
        $data['shop_status'] = -1;
        if ($posts->update($data)) {
        	$data['error'] = 0;
        	$data['msg'] = '删除成功';
        } else {
        	$data['error'] = 1;
        	$data['msg'] = '删除失败';
        }
        return $data;

        // 真.删除，不想用伪删除，请用这段(TODO：增加回收站功能用，在回收站清空时用真删除)
        // $posts = Posts::get($id);
        // if ($posts) {
        //     $posts->delete();
        //     $data['error'] = 0;
        // 	$data['msg'] = '删除成功';
        // } else {
        // 	$data['error'] = 1;
        // 	$data['msg'] = '删除失败';
        // }
        // return $data;
    }

    public function delete_image($id){
    	$posts = Posts::get($id);
    	if (file_exists($this->data['upload_path'] .'/'. $posts->feature_image)) {
            @unlink($this->data['upload_path'] .'/'. $posts->feature_image);
        }

        $source_image = str_replace('_thumb', '', $posts->feature_image);
        if (file_exists($this->data['upload_path'] .'/'. $source_image)) {
            @unlink($this->data['upload_path'] .'/'. $source_image);
        }

        $data['id'] = $id;
        $data['shop_img'] = '';
        if ($posts->update($data)) {
        	return $this->success('图像删除成功',$this->data['module_url'].$id);
        }else{
        	return $posts->getError();
        }


    }
}