<?php

// +----------------------------------------------------------------------
// | date: 2015-09-18
// +----------------------------------------------------------------------
// | AdminMenuModel.php: 后台菜单模型
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Admin;

use Session;

use DB;

class AdminMenuModel extends BaseModel {

    protected $table    = 'admin_menu';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAll()
    {
        return self::mergeData(self::all());
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author zhuweijian <zhuweijain@louxia100.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach ($data as &$v) {

                //组合操作
                $v->handle       = '<a href="'.createUrl('Admin\Admin\AdminMenuController@getEdit',['id' => $v->id]).'" >修改</a>';
                //父级菜单
                if ($v['parent_id']) {
                    $v['parent_name'] = self::where(array('id' => $v['parent_id']))->pluck('menu_name');
                } else if($v['parent_id'] == 0) {
                    $v['parent_name'] = trans('response.top_classification');
                }

            }
        }
        return $data;
    }

    /**
     * 获得组合用户全部菜单 [组合好]
     *
     * @param null $role_id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getFullUserMenu($limit_id = null)
    {
        $limit_id       = self::getRoleId($limit_id);
        $all_menu       = self::all();
        $all_user_menu  = AdminLimitMenuModel::getUserRelationMenu($limit_id);
        if (!empty($all_menu)) {
            foreach ($all_menu as &$menu) {
                $menu->checked = in_array($menu->id, $all_user_menu) ? true : false;
            }
        }
        //组合数据
        return arrayToObj(mergeTreeChildNode(objToArray($all_menu), 0, 0, 'parent_id'));
    }

    /**
     * 获得顶级菜单
     *
     * @return array|bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAdminTopMenu($limit_id = null)
    {
        //获得当前角色全部menu_id
        $all_menu_id = AdminLimitMenuModel::getAdminAllMenuId($limit_id);

        if (empty($all_menu_id)) {
            return false;
        }
        return self::mergeMenuUrl(self::multiwhere(['id' => ['IN', $all_menu_id], 'parent_id' => 0])->orderBy('sort', 'asc')->get());
    }

    /**
     * 获得当前用户菜单
     *
     * @param $parent_id
     * @param $limit_id
     * @return array|bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAdminMenu($parent_id = 0, $limit_id = null)
    {
        //获得当前角色全部menu_id
        $all_menu_id = AdminLimitMenuModel::getAdminAllMenuId($limit_id);

        if (empty($all_menu_id)) {
            return false;
        }
        return mergeTreeChildNode(objToArray(self::mergeMenuUrl(self::multiwhere(['parent_id' => ['>', 0], 'id' => ['IN', $all_menu_id]] )->orderBy('sort', 'asc')->get())), $parent_id);
    }

    /**
     * 组合url
     *
     * @param $menu_list
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeMenuUrl($menu_list)
    {
        if (empty($menu_list)) {
            return false;
        }

        foreach ($menu_list as &$menu) {
            if (empty($menu->menu_url)) continue;

            $menu->menu_url = createUrl($menu->menu_url);
        }
        return $menu_list;
    }


}
