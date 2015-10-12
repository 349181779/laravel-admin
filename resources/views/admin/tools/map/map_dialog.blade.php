<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ;?></title>
    <?php echo Html::script('/assets/js/jquery.min.js');?>
    <?php echo Html::style('/assets/css/bootstrap.css');?>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo config('config.BAIDU_KEY')?>"></script>
</head>
<body>

<div class="container">
    <!-- 工具栏 -->
    <div id="toolbar" class="form-inline">

        <!-- 搜索表单 -->
        <form class="form-inline search_form" onsubmit="return false;">
            <!-- 文本框 -->
            <div class="form-group">
                <label for="image_name">请输入:：</label>
                <input type="text" name="image_name" class="form-control" id="suggestId"  placeholder="请输入地址名称" />
                <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
            </div>
            <input type="hidden" name="lng" value=""/>
            <input type="hidden" name="lat" value=""/>
            <input type="hidden" name="city" value="<?php echo $city?>"/>
            <button type="submit" class="btn btn-default search_btn" onclick="">搜索</button>
        </form>
        <!-- 搜索表单 -->

    </div>

</div>

<!-- 工具栏 -->
<div id="l-map" style="height: 500px;"></div>

<script type="text/javascript">
    // 百度地图API功能
    function G(id) {
        return document.getElementById(id);
    }

    var map = new BMap.Map("l-map");
    map.centerAndZoom("上海",12);   //todo 上海改成 可变                // 初始化地图,设置城市和地图级别。


    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {"input" : "suggestId"
                ,"location" : map
            });

    ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
        var str = "";
        var _value = e.fromitem.value;
        var value = "";
        if (e.fromitem.index > -1) {
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        G("searchResultPanel").innerHTML = str;
    });

    var myValue;
    ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
        var _value = e.item.value;
        myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
        setPlace();
    });

    function get_lng_lat(){
//返回覆盖物标注的地理坐标。
        var o_Point_now =  marker.getPosition();
        var lng = o_Point_now.lng;
        var lat = o_Point_now.lat;
        alert('经度:'+lng+' , 纬度: '+lat);

        $('input[name=lng]').val(lng);
        $('input[name=lat]').val(lat);
    }


    function setPlace(){
        map.clearOverlays();    //清除地图上所有覆盖物
        function myFun(){
            var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
            map.centerAndZoom(pp, 18);
            marker = new BMap.Marker(pp);// 创建标注
            marker.enableDragging();
            map.addOverlay(marker);    //添加标注

            marker.addEventListener("dragend", function(e){
            //获取覆盖物位置
                var o_Point_now =  marker.getPosition();
                var lng = o_Point_now.lng;
                var lat = o_Point_now.lat;
                get_lng_lat();
            })


//            console.log(pp.lng);

        }
        var local = new BMap.LocalSearch(map, { //智能搜索
            onSearchComplete: myFun
        });
        local.search(myValue);
    }
</script>


</body>
</html>
