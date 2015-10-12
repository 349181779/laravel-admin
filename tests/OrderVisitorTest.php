<?php

// +----------------------------------------------------------------------
// | date: 2015-09-24
// +----------------------------------------------------------------------
// | OrderVisitorTest.php:短信列表单元测试
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

class OrderVisitorTest extends TestCase
{

	/**
	 * 测试 短信列表 列表页
	 *
	 * @return void
	 * @author zhuweijian <zhuweijain@louxia100.com>
	 */
	public function testIndex()
	{
		$response = $this->action('GET', 'Admin\OrderVisitorController@getIndex');
		$this->assertEquals(200,  $response->getStatusCode());
	}

}
