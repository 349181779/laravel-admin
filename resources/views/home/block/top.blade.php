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
                   <ul class="subnav">
                            <li><a href="" class="liselect">网页</a></li>
                            <li><a href="">新闻</a></li>
                            <li><a href="">帖吧</a></li>
                            <li><a href="">知道</a></li>
                            <li><a href="">音乐</a></li>
                            <li><a href="">图片</a></li>
                            <li><a href="">视频</a></li>
                            <li><a href="">地图</a></li>
                            <li><a href="">文库</a></li>
                      </ul>
                      <!--  end subnav -->
                      <div>
                         <form method="post" action="" id="search-form">
                            <div class="so_left">

                                 <input type="text" class="txt_so" id="search-input" value="" />
                                 <div id="search_hotword" class="" style="display: block;"></div>
                            </div>
                            <input type="submit" class="so_sub" value="搜索一下"  />
                            <div class="clear"></div>
                         </form>
                         <div class="search-span" id="search-suggest" style="display:none;">
                                        <ul id="search-result">
                                            <li class="">是的英文</li>
                                            <li class="">是的英文1</li>
                                            <li class="">是的英文2</li>
                                            <li class="">是的英文3</li>
                                        </ul>
                         </div>
                      </div>
                      <div  class="so_radio">
                              <span><input type="radio" name="radio" checked="checked" /> 百度 </span>
                              <span><input type="radio" name="radio"/> 谷歌 </span>
                              <span><input type="radio" name="radio"/> 搜狗 </span>
                              <span><input type="radio" name="radio"/> 必应 </span>
                              <span><input type="radio" name="radio"/> 雅虎</span>
                      </div>
                  </div>
                  <!---->
           </div>
    	</div>