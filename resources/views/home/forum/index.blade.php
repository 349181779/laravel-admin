<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
@show
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          @include('home.block.header')
      @show

	
</div>
<!-- end top -->
<!-- main -->
<div class="main">
    <div class="wrap">
        <div class="sodiv tubiao">
            <div class="so_logo"><a href=""><img src="/site/images/sologo.png" width="363" height="66" /></a></div>
            @include('home.block.search')

            <!-- end -->
        </div>
        <!-- 新闻 -->
        <div class="content">
            <div class="c_qiehuan">
                <!---->
                <div class="c_q_title">
                    <ul>
                        <li><a href="" class="select_a">网站公告</a></li>
                        <li><a href="">用户建议</a></li>
                        <li><a href="">版块3</a></li>
                        <li><a href="">版块4</a></li>
                        <li><a href="">其它</a></li>
                        <li><a href="">版内搜索</a></li>
                    </ul>
                    <div class="c_q_set2">
                        <span>刷新</span>  <span>发贴</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="index-box">
                    <!---->
                    <div class="c_q_cont" style="display:block;">

                        <table border="0" cellspacing="0" cellpadding="0" class="fl_tb" width="100%">
                            <tr>
                                <th scope="col" class="common"><div align="left">主题</div></th>
                                <th scope="col"><div align="left">作者</div></th>
                                <th scope="col"><div align="left">点击</div></th>
                                <th scope="col"><div align="left">回复</div></th>
                                <th scope="col"><div align="left">最后发表</div></th>
                            </tr>
                            <tr>
                                <td class="common"><a href="" target="_blank">养蜂是世界上最长寿的职业</a></td>
                                <td class="by"><a target="_blank" href="">蜂疗助理4号</a></td>
                                <td class="digit">468</td>
                                <td class="num">19 </td>
                                <td class="by kmhf">2015-8-4 09:36</td>
                            </tr>
                            <tr>
                                <td class="common"><a href="" target="_blank">养蜂是世界上最长寿的职业</a></td>
                                <td class="by"><a target="_blank" href="">蜂疗助理4号</a></td>
                                <td class="digit">468</td>
                                <td class="num">19 </td>
                                <td class="by kmhf">2015-8-4 09:36</td>
                            </tr>
                            <tr>
                                <td class="common"><a href="" target="_blank">南江九号土元落寞红尘，唯有努力生存</a></td>
                                <td class="by"><a target="_blank" href="">大雁100有你飞</a></td>
                                <td class="digit">453</td>
                                <td class="num">22 </td>
                                <td class="by kmhf">2015-8-4 09:55</td>
                            </tr>
                            <tr>
                                <td class="common"><a href="" target="_blank">众多 “宝宝”收益受损，会有什么影响呢？</a></td>
                                <td class="by"><a target="_blank" href="">呵呵357</a></td>
                                <td class="digit">544</td>
                                <td class="num">29 </td>
                                <td class="by kmhf">2015-8-9 09:36</td>
                            </tr>
                            <tr>
                                <td class="common"><a href="" target="_blank">养蜂是世界上最长寿的职业</a></td>
                                <td class="by"><a target="_blank" href="">蜂疗助理4号</a></td>
                                <td class="digit">468</td>
                                <td class="num">19 </td>
                                <td class="by kmhf">2015-8-4 09:36</td>
                            </tr>
                        </table>

                        <div class="clear"></div>
                        <div class="page_bt">
                            <ul>
                                <li class="pagenum"><a>1</a></li>
                                <li class="pagenum"><a>2</a></li>
                                <li class="pagenum"><a>3</a></li>
                                <li class="pagenum"><a>4</a></li>
                                <li class="pagenum"><a>5</a></li>
                                <li class="pagenum"><a>6</a></li>
                                <li class="pagenum"><a>7</a></li>
                                <li class="pagenum"><a>8</a></li>
                                <li class="pagenext"><a>下一页</a></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <!---->
                        <!---->
                    </div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">
                        论坛
                    </div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">聊天室</div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">商店</div>
                    <!---->
                </div>
            </div>
        </div>
        <!-- end 新闻 -->
    </div>
</div>
<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')

<script>
    function addSite(obj){
        var _this = $(obj);

        layer.open({
            type: 2,
            skin: 'layui-layer-rim', //加上边框
            area: ['520px', '440px'], //宽高
            content:'<?php echo action("Home\IndexController@getAddSite") ;?>'
        });

    }
</script>
@show
<!-- end footer -->
</body>
</html>
