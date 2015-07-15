
/**
 * 获得搜索
 *
 * @param obj
 */
function getSearch(obj){

    var _this       = $(obj);
    var this_val    = _this.val();

    if(this_val <= 0 ){
        alert('页面错误');
        return;
    }

    $.post(get_search, {id:this_val, _token:$('meta[name="csrf-token"]').attr('content')}, function(data){
        var _data = eval("("+data+")");
        if(_data.code == 200){
            var all_search  = _data.data.all_search;
            var html        = '';

            for(attr in all_search){
                if(attr == 0){
                    html += '<li><a data-search_url="'+all_search[attr]['search_url']+'" onclick="choseSearchMenu(this)" href="javascript:void(0)" class="liselect">'+all_search[attr]['name']+'</a></li>'
                    $('#search-form').attr('action', all_search[attr]['search_url'])
                }else{
                    html += '<li><a data-search_url="'+all_search[attr]['search_url']+'" onclick="choseSearchMenu(this)" href="javascript:void(0)" >'+all_search[attr]['name']+'</a></li>'
                }

            }
            $('.subnav').html(html);

        }else{
            toastr.warning(_data.msg);
        }
    })

}

/**
 * 切换搜索导航
 *
 * @param obj
 * @returns {boolean}
 */
function choseSearchMenu(obj){
    var _this = $(obj);
    $(".subnav li a").removeClass("liselect");
    _this.addClass("liselect");

    //设置form
    $('#search-form').attr('action', _this.attr('data-search_url'))
    return false;
}

/**
 * 搜索函数
 *
 * @param obj
 */
$(function(){
    $('#search-form').submit(function(e){
        e.preventDefault();
        var location_url = $(this).attr('action') + $.trim($(this).find('#search-input').val());
        window.open(location_url);
    })
})
