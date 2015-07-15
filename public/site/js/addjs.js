// JavaScript Document
 $(function(){

		
        $(".list_tubiao ul li").each(function(i){

				$(this).hover(function(){
                    $(this).children('.tile_tit').css("display","block");

			    },function(){
                    $(this).children('.tile_tit').css("display","none")}
                )
        })
		
})