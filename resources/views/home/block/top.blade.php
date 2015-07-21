<div class="tpcont">
    	   <div class="tp_ct">
    	           <div class="logo-geren"><a href="/"><img src="/site/images/indexlogo.png" width="278" height="52" /></a></div>
    			   <div class="datetime">
    			         <?php $week=array("周日","周一","周二","周三","周四","周五","周六");?>
    			         <p><?php echo date('m月d日').$week[date('w')];?></p>
    					 <p><?php echo number_to_ch(date('m'));?>月<?php echo  number_to_ch(date('d'));?></p>
    			   </div>
    			   <div class="weather">
    			       <iframe allowtransparency="true" frameborder="0" width="410" height="52" scrolling="no" src="http://tianqi.2345.com/plugin/widget/index.htm?s=2&z=3&t=1&v=2&d=2&bd=0&k=&f=&q=0&e=1&a=1&c=54511&w=410&h=52&align=center"></iframe>
    			   </div>
    			   <div class="email-box">
    			        <form id="mailForm" method="post" action="">
    						<ul class="email-ul">
    							 <li>
    								<div class="email-txt"><input type="text" name="mailUserName" id="mailUserName" class="input-email" /></div>
    								<div class="mailSelect mailSelectHover">
    											<em>请选择邮箱</em>
    											<i>箭头图标</i>
    								</div>
    								<div class="mail-list" style="display:none;">
    									  <ul>

    									  </ul>
    								</div>
    							 </li>
    							 <li>
									 <span id="mailParas" style="display:none;"></span>
    								<input type="password" name="uPw" id="mailPassword" class="input-pwd" />
    								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    								<input type="submit" class="btn-submit" value="登录" />
    							 </li>
    						</ul>

    					</form>
    			   </div>

    			   <div class="clear"></div>
    	   </div>

			<div class="tp_daohan">
				<!---->
				<div class="tp_dhdiv">
					@include('home.block.search')
				</div>
				<!---->
			</div>

    	</div>