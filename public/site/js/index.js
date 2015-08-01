// JavaScript Document

          $(function(){
			   /* 搜索框的js */

                 //$("#search-input").bind('keyup',function(){
                 //
				 ///* 获取服务端数据 */
				 // /*   var searchText=$("#search-input").val();
					// $.get('http://api.bing.com/qsonhs.aspx?q='+ searchText,function(d){
					//	  var d=d.AS.Results[0].Suggests;
					//	  var html='';
					//	  for(var i=0;i<d.length;i++){
					//		   html='<li>' + d[i].Txt + '</li>';
					//	  }
					//	  $("#search-result").html(html);
					//	  $('#search-suggest').show().css({
					//		 top:$("#search-form").offset().top() + $("#search-form").height(),
					//		 left:$("#search-form").offset().left(),
					//		 position:'absolute'
					//	  });
					//
					//
					//
					// },'json');*/
					//
					// /* 从服务端获取数据后不需要这个  这个仅针对当前静态页面 设置搜索提示的样式 */
					// $('#search-suggest').show().css({
					//		 top:$("#search-form").offset().top() + $("#search-form").height(),
					//		 left:$("#search-form").offset().left(),
					//		 position:'absolute'
					//	  });
				 //
					//
				 //})
				 
				 /* 从服务端获取数据后不需要这个  这个仅针对当前静态页面 点击搜索列表后文字显示在搜索框中 */
				 //$("#search-result li").each(function(i){
					//	 $(this).hover(function(){
					//		 $(this).css('background','#f8f8f8');
					//	 },function(){
					//		 $(this).css('background','#fff');
					//	 })
					//	 $(this).click(function(){
					//		 var lival=$(this).html();
					//		 $(".txt_so").val(lival);
					//		 $("#search-result").css('display','none');
					//	})
				 //})
				 
				  
				  /* 点击页面其他位置隐藏 */
				/*$(document).bind('click',function(){
					$('#search-suggest').hide();
				   
				})*/
				
				/*为多个元素且由javascript动态生成的元素添加事件时使用事件代理 点击搜索列表后直接跳到搜索页 */
				/*$(document).delegate('li','click',function(){
					 var keyword=$(this).text();
					 location.href='http://cn.bing.com/search?q=' + keyword
				})*/
				 
				 
				 /* 搜索框的js结束 */
				 
				 /*个人社区 朋友  伸缩 */ 
				 $(".grsp_l_pep li .grsp_group").click(function(){
					 		$(this).next().toggle();		
							return false;
				})
			    /*个人社区 切换 */ 
				$(".g_l_nav ul li").each(function(i){
				     $(this).click(function(){
					    $(".grsp_left .grsp-box").eq(i).show().siblings().hide();
						$(".g_r_say span").eq(i).show().siblings().hide();
						$(".grsp_right .r-grsp-box").eq(i).show().siblings().hide();
                        return false;
					})			  
			    })
				$(".c_q_title ul li").each(function(i){
				    									
					$(this).click(function(){

						if($(this).find('a').attr('href') == ''){
							$(".index-box .c_q_cont").eq(i).show().siblings().hide();
							$(this).children("a").addClass("select_a").parent().siblings().children("a").removeClass("select_a");
							return  false;
						}else{
							console.log($(this).find('a').attr('href'));
							window.location.href = $(this).find('a').attr('href')
						}

					})								
				})
				
				
				/* 邮箱选择js */
				$(".mailSelect i").click(function(){
					$('.mail-list').removeClass('hide')
					 var selectem=$(".mailSelect em").html();
					 $(".mail-list ul li").each(function(i){
						  var thisval=$(this).html();
					     if(selectem == thisval){
							    
							 }						 
					 })
					 $(".mail-list").show();
				  								  
				})



				$(".mail-list li").each(function(i){

						 $(this).click(function(){
							 $('.mail-list').addClass('hide')
							 var livals=$(this).html();
							 $(".mailSelect").find('em').html(livals);

							 $('select[name=domainss]').html('<option value="'+livals+'">'+livals+'</option>')
						})
				 })

			    //页面底部网址列表js
			    $('.seaou:gt(0)').css('border-top', '0')
				
		  })
		  
		  
		  
		  
		  
		  