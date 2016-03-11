<?php

// +----------------------------------------------------------------------
// | date: 2016-03-11
// +----------------------------------------------------------------------
// | OAuthInterface.php: OAuth接口
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\OAuth;

interface OAuthInterface
{
    /**
     * 发起登录
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function login();

}