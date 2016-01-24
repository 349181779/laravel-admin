<div class="footer">
       <a href="<?php echo action('Home\ForumController@getIndex', ['cat_id' => 1]) ;?>">网站公告</a>
	   <a href="<?php echo action('Home\ForumController@getIndex', ['cat_id' => 2]) ;?>">用户建议</a>
</div>
@include('home.block.js')