<?php

// +----------------------------------------------------------------------
// | date: 2015-07-04
// +----------------------------------------------------------------------
// | BaseModel.php: 公共模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

use DB;

use \Session;

class BaseModel extends Model
{
    const SEPARATED         = ','; //分隔符
    const LANG_ZH           = 'zh';//中文语言包
    const LANG_KOREA        = 'korea';//韩文语言包

    public static $locale   = null;//语言

    //列表页 css 样式
    const COL_DEFAULT       = "";//默认样式
    const COL_PRIMARY       = "bg-primary";//primary样式
    const COL_SUCCESS       = "bg-success";//成功样式
    const COL_INFO          = "bg-info";//info样式
    const COL_WARNING       = "bg-warning";//警告样式
    const COL_DANGER        = "bg-danger";//危险样式

    public $timestamps = false;//关闭时间戳

    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset)
    {
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                orderBy($sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' => self::multiwhere($map)->count(),
        ];
    }

    /**
     * 多条件查询where
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function scopeMultiwhere($query, $arr)
    {
        if (!is_array($arr)) {
            return $query;
        }

        if (empty($arr)) {
            return $query;
        }

        foreach ($arr as $key => $value) {
            //判断$arr
            if(is_array($value)){
                $value[0] = trim(strtolower($value[0]));

                //如果参数不正确，则跳过
                if (self::matchMapValue($value[0], $value) == false ) continue;

                switch($value[0]){
                    case 'like';
                        $query = $query->where($key, $value[0] ,$value[1]);
                        break;
                    case 'in':
                        $query = $query->whereIn($key, $value[1]);
                        break;
                    case 'not in':
                        $query = $query->whereNotIn($key, $value[1]);
                        break;
                    case 'between':
                        $query = $query->whereBetween($key, [$value[1][0], $value[1][1]]);
                        break;
                    case 'not between':
                        $query = $query->whereNotBetween($key, [$value[1][0], $value[1][1]]);
                        break;
                    case 'null':
                        $query = $query->whereNull($key);
                        break;
                    case 'or':
                        $query = $query->orWhere(function($query) use ($value) {
                            self::mergeWhereOrMap($value, $query);
                        });
                        break;
                    case 'raw':
                        //默认为 "and"
                        $value[1][2] = empty($value[1][2]) ? "and" : $value[1][2];
                        //sql         //绑定参数
                        $query = $query->whereRaw($value[1][0], $value[1][1], $value[1][2]);
                        break;
                    default:
                        if (is_array($value) && !empty($value) ) {
                            $query = $query->where($key, $value[0], $value[1]);
                        } else {
                            $query = $query->where($key, '=', $value);
                        }

                        break;
                }
            }else{
                $query = $query->where($key, $value);
            }
        }
        return $query;
    }

    /**
     * 匹配map条件是否正确
     *
     * @param $type
     * @param $value
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function matchMapValue($type, $value)
    {
        if (in_array($type, ['in', 'not in'] )) {
            //如果不是数组，则跳过档次循环
            if (empty($value[1]) || !is_array($value[1])) {
                return false;
            }
        } elseif (in_array($type, ['between', 'not between'] )) {
            //如果不是数组，则跳过档次循环
            if (empty($value[1]) || !is_array($value[1])) {
                return false;
            }
        } elseif (in_array($type, ['or']) ) {
            //如果不是数组，则跳过档次循环
            if (empty($value) || !is_array($value)) {
                return false;
            }
        } elseif (in_array($type, ['raw']) ) {
            //如果不是数组，则跳过档次循环
            if (empty($value) || !is_array($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * 组合 whereOr map 条件
     *
     * @param $value
     * @param $query
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeWhereOrMap($value, $query)
    {
        if (is_array($value)) {
            foreach ($value as $map) {
                $query = self::mergeWhereOrMapForOnes($map, $query);
            }
        }
        return $query;
    }

    /**
     * 组合单条 whereOr map条件
     *
     * @param $map
     * @param $query
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeWhereOrMapForOnes($map, $query)
    {
        if (is_array($map)) {
            return $query->orWhere($map[0], $map[1], $map[2]);
        }
        return $query;
    }

    /**
     * 获得全部文章分类--无限极分类（编辑菜单时选项）
     *
     * @descript  递归组合无限极分类，为了编辑页面和增加页面select 展示
     * @param $name 表单name名称
     * @param $id 当前id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForSchemaOption($name, $id = 0, $first = true)
    {
        $data = $id > 0 ? mergeTreeNode(objToArray(self::where('id', '<>' , $id)->get())) : mergeTreeNode(objToArray(self::all()));
        $first == true && array_unshift($data, ['id' => '0', $name => '顶级分类']);
        return $data;
    }

    /**
     * 获得全部文章分类--无限极分类（编辑菜单时选项）
     *
     * @descript  递归组合无限极分类，为了编辑页面和增加页面select 展示
     * @param $name 表单name名称
     * @param $id 当前id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllParentName($name, $id = 0, $first = true)
    {
        $data = $id > 0 ? mergeTreeNode(objToArray(self::where('id', '<>' , $id)->get())) : mergeTreeNode(objToArray(self::all()));

        $first == true && array_unshift($data, ['id' => '0', $name => '顶级分类']);
        return $data;
    }
    /**
     * 获得全部文章分类--无限极分类（编辑菜单时选项）
     *
     * @descript  递归组合无限极分类，为了编辑页面和增加页面select 展示
     * @param $name 表单name名称
     * @param $id 当前id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllFunctionName($name, $id = 0, $first = true)
    {
        $data = $id > 0 ? mergeTreeNode(objToArray(self::where('id', '<>' , $id)->get())) : mergeTreeNode(objToArray(self::all()));

        $first == true && array_unshift($data, ['id' => '0', $name => '顶级函数']);
        return $data;
    }

    /**
     * 打印最后一条执行sql
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getLastSql($type = false)
    {

        $sql = DB::getQueryLog();
        if ($type == true ) {
            var_dump($sql);die;
        }

        $query = end($sql);
        var_dump($query);die;
    }

    /**
     * 获得当前语言
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getLocale()
    {
        $locale = \Cookie::get('locale');
        return !empty($locale) ? $locale : 'zh';
    }

    /**
     * 更新图片到数据库
     *
     * @param $image_name
     * @param $id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateImage($image_name, $id)
    {
        if (!empty($image_name) && $id > 0 ) {
            return self::multiwhere( ['id' => $id] )->update([
                static::INPUT_NAME => $image_name,
            ]) > 0 ? true : false;
        }
        return false;
    }

    /**
     * 获得图片资源类型 (默认为)
     *
     * @return mixed|null
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getImageSourceType()
    {
        if (is_null(static::$source_type)) {
            static::$source_type = 'article';
        }
        return static::$source_type;
    }

    /**
     * 获得图片类型
     *
     * @return mixed|null
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getImageType()
    {
        if (is_null(static::$image_type)) {
            static::$image_type = 'article';
        }
        return static::$image_type;
    }

    /**
     * 组合 col class 名称
     *
     * @param $state
     * @return string
     */
    protected static function mergeClassName($state)
    {
        if ($state == 2) {
            return self::COL_DANGER;
        }
        return self::COL_DEFAULT;
    }

}

