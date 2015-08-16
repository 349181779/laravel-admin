<div class="user-inr1" style="display:none;">
	<h4>好友请求</h4>
	<table width="100%" border="0" class="tab_rgst">
		<tr>
			<th><div align="">发送者</div></>
			<th><div align="">内容</div></th>
			<th><div align="">时间</div></th>
			<th><div align="">操作</div></th>
		</tr>
		<?php if(!empty($add_friend_letter)):?>
			<?php foreach($add_friend_letter as $letter):?>
				<tr>
					<td><?php echo $letter->user_info->user_name;?></td>
					<td><?php echo $letter->contens;?></div></td>
					<td><?php echo $letter->created_at;?></td>
					<td><a href="javascript:void(0)" data-user_id="<?php echo $letter->user_info_id;?>" data-letter_id="<?php echo $letter->id;?>" onclick="confirmAddFrined(this)">确认</a></td>
				</tr>
			<?php endforeach;?>
		<?php endif;?>


	</table>

	<div class="page_bt">
		<ul>
			<?php echo $add_friend_letter->render(); ?>
		</ul>
		<div class="clear"></div>
	</div>

</div>

<script>

	/**
	 * 确认添加好友
	 *
	 * @param obj
	 */
	function confirmAddFrined(obj){
		var _this = $(obj);

		var user_id 	= _this.attr('data-user_id')
		var letter_id 	= _this.attr('data-letter_id')

		if(user_id > 0 && letter_id > 0){
			$.post('<?php echo action("User\AddFriendController@postConfirmAddFriend") ;?>', {"user_id" : user_id, "letter_id" : letter_id}, function(data){
				var _data = $.parseJSON(data);

				if(_data.code == 200){
					toastr.success(_data.msg);
					_this.parents('tr').fadeOut("slow");

				}else if(_data.code == 400){
					toastr.warning(_data.msg);
				}
			});
		}


	}
</script>