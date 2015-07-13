<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
@show
<script type="text/javascript">
function bgChange(){
 var lis= document.getElementsByTagName('li');
 for(var i=0; i<lis.length; i+=2)
 lis[i].style.background = '#fff';
}
window.onload = bgChange;
</script>
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          @include('home.block.header')
      @show

</div>
<!-- end top -->
<!-- main -->
<div class="main">
    <div class="wrap">
	       <div class="chaxun-logo"><a href=""><img src="/site/images/sologo.png" /></a></div>
	       <div class="chaxun-box">
		           <p class="chaxun-p">查询</p>
					<div class="query">
						<div class="item w180">
							<ul class="list">
							  <li><a href="">生活服务</a></li>
							  <li><a href="">万年历</a></li>
							  <li><a href="">快递查询</a></li>
							  <li><a href="">话费查询</a></li>
							  <li><a href="">手机归属地</a></li>
							  <li><a href="">电话归属地</a></li>
							  <li><a href="">身份证查询</a></li>
							  <li><a href="">吉日查询</a></li>
							  <li><a href="">天气预报</a></li>
							  <li><a href="">北京时间校对</a></li>
							  <li><a href="">2014年放假安排</a></li>	
							  <li><a href="">更多</a></li>		
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">交通出行</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>			
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">金融理财</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">上网工具</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">资料检索</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">健康养生</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">星座命理</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">休闲娱乐</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>

							  <li><a href="">更多</a></li>					
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">算命大全</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>			
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">教育学习</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>	
							  <li><a href="">更多</a></li>				
							</ul>
						</div>
						<div class="item ">
							<ul class="list">
							  <li><a href="">票务预定</a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href=""></a></li>
							  <li><a href="">更多</a></li>					
							</ul>
						</div>
						<div class="clear"></div>
					</div>
				   <table class="chaxun-list" border="1">
					  <tr class="huise-color">
					    <?php if(!empty($all_query)):?>
					        <?php foreach($all_query as $query_cat):?>
					            <th scope="col"><?php echo $query_cat->cat_name;?></th>
					        <?php endforeach;?>
					    <?php endif;?>
					  </tr>
					  <tr class="baise-color">
						<th scope="row">万年历</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<th scope="row">快递查询</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr class="baise-color">
						<th scope="row">话费查询</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<th scope="row">手机归属地</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr class="baise-color">
						<th scope="row">电话归属地</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<th scope="row">身份证查询</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr class="baise-color">
						<th scope="row">吉日查询</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<th scope="row">天气预报</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr class="baise-color">
						<th scope="row">北京时间校对</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<th scope="row">2014年放假安排</th>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr class="baise-color">
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
						<td>更多</td>
					  </tr>

					</table>

		   </div>
	</div>
</div>
<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')
@show
<!-- end footer -->
</body>
</html>
