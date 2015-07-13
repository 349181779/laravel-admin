   首先先扯点蛋，做后台系统大概1年多了，每次都是重复的构建增、删、改、查的页面，重复的劳动力造成了写这个小程序的初衷！
   
 #### 构建数据列表页面
 
```
/**
     * 获得后台用户
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台用户列表')->
                builderSchema('id', 'id')->
                builderSchema('email', '登录名')->
                builderSchema('mobile','手机号码')->
                builderSchema('status', '状态')->
                builderSchema('role_name', '角色')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('email', '登录名')->
                builderSearchSchema('mobile', '手机号码')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderSearchSchema('role_name', '角色')->
                builderAddBotton('增加后台用户', url('admin/admininfo/add'))->
                builderJsonDataUrl(url('admin/admininfo/search'))->
                builderList();
    }
```

只需要上面几行代码就能构建出下面的这种图片：
![列表页.](http://static.womenshuo.com/@/other/images/列表页.png)


 #### 构建列表页数据
 
```
 /**
     * 搜索
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($email)){
            $map['admin_info.email'] = ['like','%'.$email.'%'];
        }
        if(!empty($mobile)){
            $map['admin_info.mobile'] = ['like','%'.$mobile.'%'];
        }
        if(!empty($role_name)){
            $map['r.role_name'] = ['like','%'.$role_name.'%'];
        }
        if(!empty($status)){
            $map['admin_info.status'] = $status;
        }

        $data = AdminInfoModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }
```
列表页全部的逻辑代码，只需要在这里封装搜索条件即可！


 #### 构建编辑页面
 

```
/**
     * 编辑角色
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑后台用户')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像', 'image')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AdminRoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/edit'), 'btn btn-success')->
                builderEditData(AdminInfoModel::findOrFail($id))->
                builderEdit();
    }
```
只需要上面几行代码就能构建出下面的这种图片：

![编辑页面](http://static.womenshuo.com/@/other/images/编辑页面.png)


 #### 构建增加页面
 

```
/**
     * 增加后台用户
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加后台用户')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像', 'image')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AdminRoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/add'), 'btn btn-success')->
                builderAdd();
    }
```



 #### 构建tree页面
 

```
/**
	 * 获得菜单列表
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('文章分类')->
                builderSchema('id', 'id')->
                builderSchema('menu_name', '菜单名称')->
                builderSchema('pid_name','父级栏目')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderAddBotton('增加菜单分类', url('admin/menu/add'))->
                builderTreeData(MenuModel::getAll())->
                builderTree();
	}
```

只需要上面几行代码就能构建出下面的这种图片：

![tree](http://static.womenshuo.com/@/other/images/tree.png)

 #### 构建tab页面
 

```
/**
	 * 网站配置
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
          return $this->html_builder->builderTabSchema(
                    $this->html_builder->
                    builderTitle('基本设置')->
                    builderFormSchema('site_name', '网站名称')->
                    builderFormSchema('keywords', '关键字', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                    builderFormSchema('description', '网站描述', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                    builderConfirmBotton('确认', url('admin/config/edit'), 'btn btn-success')->
                    builderEditData(ConfigModel::getAll())
                )->builderTabHtml();
	}
```

只需要上面几行代码就能构建出下面的这种图片：

![tab](http://static.womenshuo.com/@/other/images/tab.png)


#### 项目地址
* git os [http://git.oschina.net/yangxiansen/laravel-5](http://git.oschina.net/yangxiansen/laravel-5)
* github [https://github.com/tyua07/laravel-admin](https://github.com/tyua07/laravel-admin)

#### 卖个广告
 一个好的想法，可以使写项目变得更简单，如果写的不好的地方麻烦或者可以改进的地方，希望大家Pull Requests 我！谢谢（aligaduo）

#### 下一步计划
因为还没有使用在真实环境，所以，可以还会有变动，这个只是一个雏形，感兴趣的可以自己先fork一下！谢谢（aligaduo）

#### 数据库
* [sql](http://static.womenshuo.com/@/other/images/laravel.sql)
* [workbench 模型](http://static.womenshuo.com/@/other/images/后台设计数据库模型.mwb)


# 记得 star哦 摸摸大

