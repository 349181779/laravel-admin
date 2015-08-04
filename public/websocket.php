<?php

// +----------------------------------------------------------------------
// | date: 2015-08-03
// +----------------------------------------------------------------------
// | websocket.php: swoole web_socket服务器端
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

class SwooleWebSocket{

    private $web_socket;
    private $swoole_config;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        $this->swoole_config = include dirname(__DIR__) . '/config/swoole.php';
        $this->web_socket = new swoole_websocket_server($this->swoole_config['swoole_host'], $this->swoole_config['web_socket_port']);

        //绑定函数
        $this->bind();

        //启动
        $this->web_socket->start();
    }

    /**
     * 绑定函数
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function bind(){
        $this->web_socket->on('open', [$this, 'onOpen']);
        $this->web_socket->on('message', [$this, 'onMessage']);
        $this->web_socket->on('close', [$this, 'onClose']);
    }

    /**
     * WebSocket客户端与服务器建立连接并完成握手
     *
     * @param swoole_websocket_server $server
     * @param $req
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function onOpen(swoole_websocket_server $server, $req){

        $data = [
            'cmd'   => 'login',
            'fd'    => $req->fd,
        ];
        $server->push($req->fd, json_encode($data));
    }

    /**
     * 接受消息时
     *
     * @param swoole_websocket_server $server
     * @param $frame
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function onMessage(swoole_websocket_server $server, $frame){
        //组合数据
        $data = json_decode($frame->data, true);
        $data['time'] = date('Y-m-d H:i:s');

        $server->push($data['id'], json_encode($data));
    }

    /**
     * 关闭连接时
     *
     * @param swoole_websocket_server $server
     * @param $fd
     */
    public function onClose(swoole_websocket_server $server, $fd){
        echo "connection close: ".$fd . $this->swoole_config['package_eof'];;
    }
}

$web_socket = new SwooleWebSocket();