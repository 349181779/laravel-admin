<?php

// +----------------------------------------------------------------------
// | date: 2016-03-11
// +----------------------------------------------------------------------
// | OAuthAdapter.php: OAuth适配器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\OAuth;

class OAuthAdapter
{
    /**
     * oauth对象
     *
     * @var OAuthInterface
     */
    protected $oauth;

    /**
     * 构造方法
     *
     * OAuthAdapter constructor.
     * @param $oauth
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(OAuthInterface $oauth)
    {
        $this->oauth = $oauth;
    }

    /**
     * 发起登录
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function login()
    {
        $this->oauth->login();
    }

}