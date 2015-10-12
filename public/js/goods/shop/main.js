/**
 * Created by anywhere1000 on 15/10/2.
 */

/**
 * 获得全部城市
 *
 */
function getCity(){
    var city_list = getAllCity();
    if (city_list) {
        var html = '';
        for (city in city_list) {
            if (cityId == city_list[city].id){
                html += '<option selected="selected" value="' + city_list[city].id + '" >' + city_list[city].region_name + '</option>'
            }else{
                html += '<option  value="' + city_list[city].id + '" >' + city_list[city].region_name + '</option>'
            }

        }
        //操作dom
        $('select[name=city_id]').html(html);
    }
}

/**
 * 获得当前城市，全部区域
 *
 * @param city_id
 */
function getArea(city_id) {
    city_id = city_id > 0 ? city_id : $('select[name=city_id]').val();
    var area_list = getCurrentArea(city_id);
    if (area_list) {
        var html = '';
        for (area in area_list) {
            if (areaId == area_list[area].id) {
                html += '<option selected="selected" value="' + area_list[area].id + '" >' + area_list[area].region_name + '</option>'
            }else{
                html += '<option value="' + area_list[area].id + '" >' + area_list[area].region_name + '</option>'
            }

        }
        //操作dom
        $('select[name=district_id]').html(html);
    }
}

/**
 * 切换账户类型
 *
 * @param type
 */
function changeAccountType(type)
{
    if (!type){
        alert('类型不能为空');
        return;
    }

    switch (type) {
        case 1:
            $('.alipay').show();
            $('.bank').hide();
            break;
        case 2:
            $('.bank').show();
            $('.alipay').hide();
            break;
    }
}


$(function () {
    //初始化获得当前城市所在区域
    getCity();
    //获得当前城市，全部区域
    getArea()

})



var shop = bingo.action(function ($view, $ajax, $var) {

    $view.shop_info = {};//门店基本信息

    //获得门店基本信息
    $view.getShopInfo = function () {
        $ajax(getShopInfoUrl).param({'shop_id': shopId}).success(function (r) {
            if (r.code == HTTP_CODE.SUCCESS_CODE) {
                $view.shop_info = r.data;
                $view.$update();
            } else {
                toastr.warning(r.msg);
            }

        }).get();

    };
    $view.getShopInfo();

});

