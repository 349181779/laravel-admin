<div class="user-inr1" style="display:block;">
	<h4>基本资料</h4>
	<form name="form1" class="ajax-form" method="post" action="<?php echo action('User\UserController@postProfile') ;?>">
		<table width="100%" border="0" class="tab_rgst">
			<tr>
				<td width="18%"><div align="right">用户编号：</div></td>
				<td width="82%"><?php echo $user_profile->account_number ;?></td>
			</tr>
			<tr>
				<td width="18%"><div align="right">邮箱：</div></td>
				<td width="82%"> <input type="text" class="text_txt inp_l" name="email" value="<?php echo $user_profile->email ;?>" placeholder="请输入邮箱"/> <span class="vf_tishi">
								        请您填写邮箱
								</span></td>
			</tr>

			<tr>
				<td width="18%"><div align="right">手机号：</div></td>
				<td width="82%"> <input type="text" class="text_txt inp_l" name="mobile" value="<?php  if($user_profile->mobile > 0)  echo $user_profile->mobile;?>" placeholder="请输入手机号"/> <span class="vf_tishi">
								        请您填写手机号
								</span></td>
			</tr>

			<tr>
				<td><div align="right">网名：</div></td>
				<td> <input type="text" class="text_txt inp_l"  id="nickname" value="<?php echo $user_profile->user_name ;?>" name="user_name" placeholder="网名"/> <span class="vf_tishi">
								        请您填写网名
								</span></td>
			</tr>
			<tr>
				<td><div align="right">姓名：</div></td>
				<td><input class="text_txt inp_l" type="text" name="user_profile[truename]" value="<?php echo $user_profile->user_profile->truename ;?>" >
									<span class="vf_tishi">
								        请您填写真实姓名，方便我们联系你。你的资料不会透漏给任何人								</span>									</td>
			</tr>
			<tr>
				<td><div align="right">性别：</div></td>
				<td><label class="radio-inline">
						<input name="sex" type="radio" value="1" <?php if($user_profile->sex == 1){echo 'checked="checked"';}?> > 男
					</label>
					<label class="radio-inline">
						<input name="sex" type="radio" value="2" <?php if($user_profile->sex == 2){echo 'checked="checked"';}?>> 女								</label>								</td>
			</tr>
			<tr>
				<td><div align="right">常用邮箱：</div></td>
				<td> <input type="text" class="text_txt inp_l" name="user_profile[other_email]" value="<?php echo $user_profile->user_profile->other_email ;?>"  placeholder="常用邮箱"/> <span class="vf_tishi">
								        请您填写常用邮箱
								</span></td>
			</tr>
			<tr>
				<td><div align="right">QQ：</div></td>
				<td> <input class="text_txt" type="text" value="<?php echo $user_profile->user_profile->qq ;?>"  name="user_profile[qq]"></td>
			</tr>
			<tr>
				<td><div align="right">微信：</div></td>
				<td> <input class="text_txt" type="text" value="<?php echo $user_profile->user_profile->wechat ;?>"  name="user_profile[wechat]"></td>
			</tr>
			<tr>
				<td><div align="right">微博：</div></td>
				<td> <input class="text_txt " type="text" value="<?php echo $user_profile->user_profile->weibo ;?>"  name="user_profile[weibo]"></td>
			</tr>
			<tr>
				<td><div align="right">身份证号码：</div></td>
				<td> <input type="text" class="text_txt inp_l"  placeholder="身份证号码" value="<?php echo $user_profile->user_profile->id_card ;?>"  name="user_profile[id_card]"/> <span class="vf_tishi">
								        请您填写身份证号码
								</span></td>
			</tr>
			<tr>
				<td><div align="right">出生年月：</div></td>
				<td><div class="inp_l" node-type="birthday" action-data="must=false">
									<span class="year">
										<select name="year"></select><i>年</i>
                                    </span>
									<span class="month">
									    <select name="month"></select><i>月</i>
                                    </span>
									<span class="day">
									    <select name="day">></select><i>日</i>
                                    </span>
						<input type="hidden" value="" name="birthday">
					</div>																								</td>
			</tr>
			<tr>
				<td><div align="right">婚姻：</div></td>
				<td><div class="basicinfo_box">
						<select id="sense_select" name="marriage" class="select_medium">
							<option value="0">请选择</option>
							<option value="1">未婚</option>
							<option value="2">已婚</option>
							<option value="3">单亲</option>
						</select>
					</div></td>
			</tr>
			<tr>
				<td><div align="right">职业：</div></td>
				<td><input id="career_txt" type="text" class="text_txt inp_l" value="<?php echo $user_profile->user_profile->occupation ;?>"  name="user_profile[occupation]" ><span class="vf_tishi">
								        请您填写职业
								</span></td>
			</tr>
			<tr>
				<td><div align="right">现居地：</div></td>
				<td><div class="basicinfo_box"><select name="user_profile[province]"></select><select name="user_profile[city]"></select><select name="user_profile[area]"></select></div></td>
			</tr>
			<tr>
				<td><div align="right">家乡：</div></td>
				<td><div class="basicinfo_box"><select name="user_profile[home_province]"></select><select name="user_profile[home_city]"></select><select name="user_profile[home_area]"></select></div></td>
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
				<td><div class="input-div" >
						<input type="text" name="captcha" class="txt-mark">
						<div style="display: inline-block;" onclick="loadCaptchaImg(this)"><?php echo captcha_img();?></div>
					</div></td>
			</tr>
			<tr>
				<td><div align="right"></div></td>
				<td>
					<div class="signin_left12aa">
						<input name="_token" type="hidden" value="<?php echo csrf_token(); ?>" />
						<input type="submit" value="确认" class="signin_left15 colored8b00">
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>