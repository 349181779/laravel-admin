<div class="user-inr1" style="display:none;">
	<h4>账号安全</h4>
	<form name="form1" class="ajax-form" method="post" action="<?php echo action('User\ProfileController@postUpdatePassword') ;?>">
		<table width="100%" border="0" class="tab_rgst">
			<tr>
				<td><div align="right">旧密码：</div></td>
				<td><input type="password" class="text_txt inp_l" id="txtPwd" name="old_password" value="" placeholder="请输入密码"></td>
			</tr>
			<tr>
				<td><div align="right">请设置密码：</div></td>
				<td><input type="password" class="text_txt inp_l" id="txtPwd" name="password" value="" placeholder="请输入密码"><span class="vf_tishi">
																请设置密码 ,密码为6-20位
														</span></td>
			</tr>
			<tr>
				<td><div align="right">请确认密码：</div></td>
				<td><input type="password" class="text_txt inp_l" id="txtPwd" name="password_confirmation" value="" placeholder="请确认密码"><span class="vf_tishi">
																请确认密码 ,密码为6-20位
														</span></td>
			</tr>
			<tr>
				<td><div align="right"></div></td>
				<td><div class="signin_left12aa">
						<input name="_token" type="hidden" value="<?php echo csrf_token(); ?>" />
						<input type="submit" value="确认" class="signin_left15 colored8b00">

					</div></td>
			</tr>
		</table>
	</form>

</div>