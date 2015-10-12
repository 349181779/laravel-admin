<?php

// +----------------------------------------------------------------------
// | date: 2015-09-24
// +----------------------------------------------------------------------
// | SmsTest.php:短信列表单元测试
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

class SmsTest extends TestCase
{

	/**
	 * 测试 短信列表 列表页
	 *
	 * @return void
	 * @author zhuweijian <zhuweijain@louxia100.com>
	 */
	public function testIndex()
	{
		$response = $this->action('GET', 'Admin\SmsController@getIndex');
		$this->assertEquals(200,  $response->getStatusCode());
	}

}
