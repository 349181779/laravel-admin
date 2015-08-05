<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('base_header')
@include('home.block.base_header')
	<script>
		var friend = '<?php echo action("User\UserController@postFriend") ;?>';
		var group = '<?php echo action("User\UserController@postGroup") ;?>'
		var chatlog = '<?php echo action("User\UserController@postChatlog") ;?>'
		var groups = '<?php echo action("User\UserController@postGroups") ;?>'
		var sendurl = '<?php echo action("User\ChatController@postSendMessage") ;?>'
        var Socket_fd =  '<?php echo action("User\ChatController@postSocketFd") ;?>'
	</script>
@show
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          @include('user.block.header')
      @show

	
</div>
<!-- end top -->
<!-- main -->
<div class="main">
	<div class="wrap">
		<div class="chaxun-logo"><a href=""><img src="/site/images/sologo.png" /></a></div>
		<div class="chaxun-box bfff">
			<div class="user-inl">
				<dl class="user-inlmenu">
					<dt>个人资料</dt>
					<dd><a href="" class="select_a">基本资料</a></dd>
					<dd><a href="">账号安全</a></dd>
				</dl>
			</div>
			<div class="user-inr" >
				<div class="user-inr1" style="display:block;">
					<h4>基本资料</h4>
					<form name="form1">
						<table width="100%" border="0" class="tab_rgst">
							<tr>
								<td width="18%"><div align="right">邮箱/手机号：</div></td>
								<td width="82%"> <input type="text" class="text_txt inp_l" placeholder="请输入邮箱/手机号"/> <span class="vf_tishi">
								        请您填写邮箱/手机号
								</span></td>
							</tr>

							<tr>
								<td><div align="right">网名：</div></td>
								<td> <input type="text" class="text_txt inp_l"  id="nickname" name="nickname" placeholder="网名"/> <span class="vf_tishi">
								        请您填写网名
								</span></td>
							</tr>
							<tr>
								<td><div align="right">姓名：</div></td>
								<td><input class="text_txt inp_l" type="text" value="" name="realname" action-data="text=填写真实姓名&amp;must=false" action-type="text_copy" node-type="realname">
									<span class="vf_tishi">
								        请您填写真实姓名，方便我们联系你。你的资料不会透漏给任何人								</span>									</td>
							</tr>
							<tr>
								<td><div align="right">性别：</div></td>
								<td><label class="radio-inline">
										<input name="sex" type="radio" value="1"> 男
									</label>
									<label class="radio-inline">
										<input name="sex" type="radio" value="2"> 女								</label>								</td>
							</tr>
							<tr>
								<td><div align="right">常用邮箱：</div></td>
								<td> <input type="text" class="text_txt inp_l"  placeholder="常用邮箱"/> <span class="vf_tishi">
								        请您填写常用邮箱
								</span></td>
							</tr>
							<tr>
								<td><div align="right">QQ：</div></td>
								<td> <input class="text_txt" type="text" value="" action-data="text=请输入QQ号&amp;must=false" action-type="text_copy" node-type="qq" name="qq"></td>
							</tr>
							<tr>
								<td><div align="right">微信：</div></td>
								<td> <input class="text_txt" type="text" value="" action-data="text=请输入微信号&amp;must=false" action-type="text_copy" node-type="微信" name="微信"></td>
							</tr>
							<tr>
								<td><div align="right">微博：</div></td>
								<td> <input class="text_txt " type="text" value="" action-data="text=请输入微博地址&amp;must=false" name="blog" action-type="text_copy" node-type="blog"></td>
							</tr>
							<tr>
								<td><div align="right">身份证号码：</div></td>
								<td> <input type="text" class="text_txt inp_l"  placeholder="身份证号码"/> <span class="vf_tishi">
								        请您填写身份证号码
								</span></td>
							</tr>
							<tr>
								<td><div align="right">出生年月：</div></td>
								<td><div class="inp_l" node-type="birthday" action-data="must=false">
									<span class="year">
										<select node-type="birthday_year" name="Date_Year">
											<option value="1"> </option>
											<option label="2015" value="2015">2015</option>
										</select>
														<i>年</i>													</span>
													<span class="month">
														<select node-type="birthday_month" name="birthday_m"><option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>
														<i>月</i>													</span>
													<span class="day">
														<select node-type="birthday_day" name="birthday_d"><option value=""></option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
														<i>日</i>													</span>
										<input type="hidden" value="1991-08-24" node-type="birthday_value">
									</div>																								</td>
							</tr>
							<tr>
								<td><div align="right">婚姻：</div></td>
								<td><div class="basicinfo_box">
										<select id="sense_select" class="select_medium">
											<option value="0">请选择</option>
											<option value="1">未婚</option>
											<option value="2">已婚</option>
											<option value="3">单亲</option>
										</select>
									</div></td>
							</tr>
							<tr>
								<td><div align="right">职业：</div></td>
								<td><input id="career_txt" type="text" class="text_txt inp_l" ><span class="vf_tishi">
								        请您填写职业
								</span></td>
							</tr>
							<tr>
								<td><div align="right">现居地：</div></td>
								<td><div class="basicinfo_box">
										<!--<select id="sense_select" class="select_medium">
                                            <option value="0">请选择</option>
                                        </select>-->
										<select id="addslt_c_0" style="width: 120px;"><option value="0">选择国家</option></select><label>    </label><select id="addslt_s_0" style="width: 75px;" disabled=""><option value="0">选择省</option></select><label>    </label><select id="addslt_cty_0" style="width: 105px;" disabled=""><option value="0">选择市</option></select><label>    </label>
									</div></td>
							</tr>
							<tr>
								<td><div align="right">家乡：</div></td>
								<td><div class="basicinfo_box">
										<select id="addslt_c_0" style="width: 120px;"><option value="0">选择国家</option></select><label>    </label><select id="addslt_s_0" style="width: 75px;" disabled=""><option value="0">选择省</option></select><label>    </label><select id="addslt_cty_0" style="width: 105px;" disabled=""><option value="0">选择市</option></select><label>    </label>
									</div>							</td>
							</tr>
							<tr>
								<td><div align="right">个人经历：</div></td>
								<td><div class="basicinfo_box">
										<select id="sense_select" class="select_medium text_txt1">
											<option value="3">大学</option>
										</select>
										<input id="career_txt" type="text" class="text_txt1 inp_l" >
										<input id="career_txt" type="text" class="text_txt1 inp_l" placeholder="学院" >
										<input id="career_txt" type="text" class="text_txt1 inp_l" >
										<input id="career_txt" type="text" class="text_txt1 inp_l" placeholder="专业" >
										<input id="career_txt" type="text" class="text_txt1 inp_l" >
										<select id="sense_select" class="select_medium text_txt1">
											<option value="2">年级</option>
										</select>
									</div></td>
							</tr>
							<tr>
								<td><div align="right">工作经历：</div></td>
								<td><div class="basicinfo_box">
										<input type="" class="text_txt1 inp_l" name="name" node-type="company" action-type="text_copy" action-data="text=请输入完整的公司名称">
										<div class="input_sel inp_l">
				<span class="rsp">
					<select node-type="stime" name="start" class="text_txt1">
						<option value="1">请选择</option>
						<option value="2015">2015</option>
						<option value="1900">1900</option>
					</select>&nbsp;至				</span>
				<span class="rsp">
					<select node-type="etime" name="end" class="text_txt1">
						<option value="1">请选择</option>
						<option value="9999">至今</option>
						<option value="2015">2015</option>
					</select>&nbsp;				</span>				</div>
										<input type="" class="text_txt1" name="remark" node-type="job" action-type="text_copy" action-data="text=请输入你所在的部门或职位">
									</div></td>
							</tr>
							<tr>
								<td><div align="right">验证码：</div></td>
								<td><div class="input-div">
										<input type="text" class="txt-mark">
										<img src="/site/images/verify.png" height="33" width="100">
									</div></td>
							</tr>
							<tr>
								<td><div align="right"></div></td>
								<td><div class="signin_left12aa">
										<p id="errormsg" style="padding-bottom: 10px;color:red;"></p>
										<a href="javascript:void(0);" onclick="Login();" class="signin_left15 colored8b00">确认</a> <a id="singloading" style="color: rgb(51, 51, 51);
                                padding-left: 1px; float: left; margin-left: 11px; margin-top: 12px; display: none;">
											<img src="http://img.cndns.com/images/loading.gif"></a>

									</div></td>
							</tr>
						</table>
					</form>
				</div>

				<div class="user-inr1" style="display:none;">
					<h4>账号安全</h4>
					<table width="100%" border="0" class="tab_rgst">
						<tr>
							<td><div align="right">请设置密码：</div></td>
							<td><input type="password" class="text_txt inp_l" id="txtPwd" name="password" value="" placeholder="请输入密码"><span class="vf_tishi">
																请设置密码 ,密码为6-20位
														</span></td>
						</tr>
						<tr>
							<td><div align="right">请确认密码：</div></td>
							<td><input type="password" class="text_txt inp_l" id="txtPwd" name="password" value="" placeholder="请确认密码"><span class="vf_tishi">
																请确认密码 ,密码为6-20位
														</span></td>
						</tr>
						<tr>
							<td><div align="right"></div></td>
							<td><div class="signin_left12aa">
									<p id="errormsg" style="padding-bottom: 10px;color:red;"></p>
									<a href="javascript:void(0);" onclick="Login();" class="signin_left15 colored8b00">确认</a> <a id="singloading" style="color: rgb(51, 51, 51);
                                padding-left: 1px; float: left; margin-left: 11px; margin-top: 12px; display: none;">
										<img src="http://img.cndns.com/images/loading.gif"></a>

								</div></td>
						</tr>
					</table>

				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- end main --><!-- footer -->
@section('footer')
@include('home.block.footer')
<link rel="stylesheet" href="/layim/css/layim.css">
<script src="/layim/lay/layim.js"></script>
@show
<!-- end footer -->
</body>
</html>
