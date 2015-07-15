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
    			        <form name="gomail" id="FrLgn" method="post" onsubmit="return clickMail()" action="">
    						<ul class="email-ul">
    							 <li>
    								<div class="email-txt"><input type="text" name="uName" class="input-email" /></div>
    								<div class="mailSelect mailSelectHover">
    											<em>请选择邮箱</em>
    											<i>箭头图标</i>
    								</div>
    								<select name="domainss" style="display: none;" id=""></select>
    								<div class="mail-list" style="display:none;">
    									  <ul>
    										  <li>@163.com</li>
                                              <li>@126.com</li>
                                              <li>@sina.com</li>
                                              <li>@yahoo.com.cn</li>
                                              <li>@yahoo.cn</li>
                                              <li>@gmail.com</li>
                                              <li>@sohu.com</li>
                                              <li>@tom.com</li>
                                              <li>@188.com</li>
                                              <li>@21cn.com</li>
                                              <li>@yeah.net</li>
                                              <li>-请选择其他服务-</li>
                                              <li>百度账号</li>
                                              <li>ChinaRen校友录</li>
                                              <li>校内网</li>
                                              <li>51.com</li>
    									  </ul>
    								</div>
    							 </li>
    							 <li>
    								<input type="password" name="uPw" class="input-pwd" />
    								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    								@include('home.block.email')
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