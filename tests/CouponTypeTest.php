<?php

// +----------------------------------------------------------------------
// | date: 2015-09-16
// +----------------------------------------------------------------------
// | CouponTypeTest.php: 后端优惠券类型单元测试
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

class CouponTypeTest extends TestCase
{

	/**
	 * 测试优惠券类型列表页
	 *
	 * @return void
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function testIndex()
	{
		$response = $this->action('GET', 'Admin\CouponTypeController@getIndex');
		$this->assertEquals(200,  $response->getStatusCode());
	}

	/**
	 * 测试 优惠券类型 编辑
	 *
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function testEdit()
	{
		$data = [
			'id'			=> '59',
			'coupon_name'	=> '会员邀请奖励4',
			'coupon_price'	=> 'aaaaa',
			'time_type'		=> '1',
			'end_from'		=> '1212',
			'full_money'	=> '0.00',
			'is_freight'	=> '2',
			'is_new'		=> '3',
			'is_speed'		=> '1',
			'type'			=> '1',
		];

		$response = $this->call('POST', createUrl('Admin\CouponTypeController@postEdit'), $data);
		$this->assertEquals(200,  $response->getStatusCode());
	}

	/**
	 * 测试 优惠券类型 添加
	 *
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function testAdd()
	{
		$data = [
			'coupon_name'	=> '会员邀请奖励2',
			'coupon_price'	=> '3.00',
			'time_type'		=> '1',
			'end_from'		=> '1212',
			'full_money'	=> '0.00',
			'is_freight'	=> '2',
			'is_new'		=> '3',
			'is_speed'		=> '1',
			'type'			=> '1',
		];

		$response = $this->call('POST', createUrl('Admin\CouponTypeController@postAdd'), $data);
		$this->assertEquals(200,  $response->getStatusCode());
	}

}
