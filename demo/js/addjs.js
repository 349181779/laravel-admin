// JavaScript Document
 $(function(){
	    $(".subnav li a").each(function(i){
	         $(this).click(function(){
				   $(this).addClass("liselect").parent().siblings().children('a').removeClass("liselect");
				   return false;
			 })
	     })
		
		$(".list_tubiao ul li").each(function(i){
											  
				$(this).hover(function(){
		    
			$(this).children('.tile_tit').css("display","block");
			
			
		},function(){$(this).children('.tile_tit').css("display","none")})							  
        })
		
})