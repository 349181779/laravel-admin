// JavaScript Document

          $(function(){
			   /* �������js */

		         $("#search-input").bind('keyup',function(){

				 /* ��ȡ�������� */
				  /*   var searchText=$("#search-input").val();
					 $.get('http://api.bing.com/qsonhs.aspx?q='+ searchText,function(d){
						  var d=d.AS.Results[0].Suggests;
						  var html='';
						  for(var i=0;i<d.length;i++){
							   html='<li>' + d[i].Txt + '</li>';
						  }
						  $("#search-result").html(html);
						  $('#search-suggest').show().css({
							 top:$("#search-form").offset().top() + $("#search-form").height(),
							 left:$("#search-form").offset().left(),
							 position:'absolute'
						  });



					 },'json');*/

					 /* �ӷ���˻�ȡ��ݺ���Ҫ���  �������Ե�ǰ��̬ҳ�� ����������ʾ����ʽ */
					 $('#search-suggest').show().css({
							 top:$("#search-form").offset().top() + $("#search-form").height(),
							 left:$("#search-form").offset().left(),
							 position:'absolute'
						  });


				 })

				 /* �ӷ���˻�ȡ��ݺ���Ҫ���  �������Ե�ǰ��̬ҳ�� ��������б��������ʾ���������� */
				 $("#search-result li").each(function(i){
						 $(this).hover(function(){
							 $(this).css('background','#f8f8f8');
						 },function(){
							 $(this).css('background','#fff');
						 })
						 $(this).click(function(){
							 var lival=$(this).html();
							 $(".txt_so").val(lival);
							 $("#search-result").css('display','none');
						})
				 })


				  /* ���ҳ������λ������ */
				/*$(document).bind('click',function(){
					$('#search-suggest').hide();

				})*/

				/*Ϊ���Ԫ������javascript��̬��ɵ�Ԫ������¼�ʱʹ���¼����� ��������б��ֱ��������ҳ */
				/*$(document).delegate('li','click',function(){
					 var keyword=$(this).text();
					 location.href='http://cn.bing.com/search?q=' + keyword
				})*/


				 /* �������js���� */

				 /*�������� ����  ���� */
				 $(".grsp_l_pep li .grsp_group").click(function(){
					 		$(this).next().toggle();
				})
			    /*�������� �л� */
				$(".g_l_nav ul li").each(function(i){
				     $(this).click(function(){
					    $(".grsp_left .grsp-box").eq(i).show().siblings().hide();
                        return false;
					})
			    })
				$(".c_q_title ul li").each(function(i){

					$(this).click(function(){
					$(".index-box .c_q_cont").eq(i).show().siblings().hide();
					$(this).children("a").addClass("select_a").parent().siblings().children("a").removeClass("select_a");
					return  false;
					})
				})


				/* ����ѡ��js */
				$(".mailSelect").click(function(){
					 var selectem=$(".mailSelect em").html();
					 $(".mail-list ul li").each(function(i){
						  var thisval=$(this).html();
					     if(selectem == thisval){

							 }
					 })
					 $(".mail-list").show();

				})

				$(".mail-list ul li").each(function(i){
						 $(this).click(function(){
							 var livals=$(this).html();
							 $(".mailSelect").find('em').html(livals);
							 $(".mail-list").hide();
                             $('select[name=domainss]').html('<option value="'+livals+'">'+livals+'</option>')

						})
				 })

		  })
		  
		  
		  
		  
		  
		  