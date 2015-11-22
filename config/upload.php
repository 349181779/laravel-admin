<?php

// +----------------------------------------------------------------------
// | date: 2015-09-09
// +----------------------------------------------------------------------
// | upload.php: 上传配置文件
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


return [
    'upyun' => [
        'bucketname'    => '', //空间名称
        'username'      => '',//'yangyifan',//操作员名称
        'password'      => '',//'yangyifan',//密码
        'imagesHots'    => '',//图片地址
        'fileHost'      => ''//静态文件地址
    ],

    'qiniu' => [
        'accessKey' => 'gIx7sI3Ak7LIXT-EDPPvF8imSUyP85ErXK5xhNoc',
        'secretKey' => 'KqP9ABmUZDfTS27WGBhSqVMiE4AjTFLU0fT5vMR9',
        'bucket'    => 'test',
        'url'       => 'http://7xk0dl.com1.z0.glb.clouddn.com',
    ],

];
