<?php

// +----------------------------------------------------------------------
// | date: 2015-08-22
// +----------------------------------------------------------------------
// | HproseController.php: 高性能远程对象服务引擎服务提供者
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\BaseController;

use App;

use App\Model\Admin\NewsModel;

use App\Library\Hprose;

use HproseHttpService;

class HproseController extends BaseController{

    private $hprose;

    /**
     * 构造函数
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        //设置对象
        $this->hprose = App::make('App\Library\Hprose');
        //加载网址
        $this->hprose->load_file('http://www.xinhuanet.com/sports/xj.htm');
    }

    /**
     * 开始执行采集
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        //获得任务
        $all_task = config('config.html');
        var_dump($all_task);

        if(!empty($all_task)){
            foreach($all_task as $task){
                foreach($this->html->find($task['parent_dom']) as $article) {
                    NewsModel::create([
                        'title'         => $article->find($task['child_dom'], 0)->plaintext,
                        'site_url'      => $article->find($task['child_dom'], 0)->getAttribute('href'),
                        'status'        => 1,
                        'news_cat_id'   => $task['cat_id'],
                    ]);
                }
            }
        }
    }


}