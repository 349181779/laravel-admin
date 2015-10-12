<?php

// +----------------------------------------------------------------------
// | date: 2015-09-24
// +----------------------------------------------------------------------
// | MessageTest.php: 站内信单元测试
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

class MessageTest extends TestCase
{

	/**
	 * 测试 站内信 列表页
	 *
	 * @return void
	 * @author zhuweijian <zhuweijain@louxia100.com>
	 */
	public function testIndex()
	{
		$response = $this->action('GET', 'Admin\MessageController@getIndex');
		$this->assertEquals(200,  $response->getStatusCode());
	}

	/**
	 * 测试 站内信 编辑
	 *
	 * @author zhuweijian <zhuweijain@louxia100.com>
	 */
	public function testEdit()
	{
		$data = [
			'id'			        => '1',
			'message_title'	    => '测试文本测试文本',
			'type'	                => '1',
			'message_content'		=> '测试文本测试文本',
			'valid_date_start'	=> '2015-09-24 13:28:40',
			'valid_date_end'	    => '2015-09-24 13:29:15',
		];

		$response = $this->call('POST', createUrl('Admin\MessageController@postEdit'), $data);
		$this->assertEquals(200,  $response->getStatusCode());
	}

	/**
	 * 测试 站内信 添加
	 *
	 * @author zhuweijian <zhuweijain@louxia100.com>
	 */
	public function testAdd()
	{
        $data = [
            'message_title'	    => '测试文本测试文本',
            'type'	                => '1',
            'message_content'		=> '测试文本测试文本',
            'valid_date_start'	=> '2015-09-24 13:28:40',
            'valid_date_end'	    => '2015-09-24 13:29:15',
        ];

		$response = $this->call('POST', createUrl('Admin\MessageController@postAdd'), $data);
		$this->assertEquals(200,  $response->getStatusCode());
	}

}
