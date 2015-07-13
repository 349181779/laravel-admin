<style>
.fixed-table-toolbar .search{padding:0;width: auto;}
</style>
<div class="content-wrap">
                <div class="row">
                    <!-- SIDEMENU MAIL -->
                    <div class="col-sm-2">
                        <div class="side-mail">
                            <div class="btn btn-info button-mail" onclick="showUploadDialog()" ><i class="entypo-upload"></i>&nbsp;&nbsp; 上传文件</div>
                            <div class="list-btn-mail active">
                                <span class="entypo-download"></span><a href="<?php echo action('Admin\ResourceController@getIndex'); ?>">全部</a><i>648</i>
                            </div>
                            <div class="list-btn-mail">
                                <span class="entypo-picture"></span><a href="<?php echo action('Admin\ResourceController@getIndex', ["type"=>1]); ?>">图片</a><i>5</i>
                            </div>
                            <div class="list-btn-mail">
                                <span class="entypo-music"></span><a href="<?php echo action('Admin\ResourceController@getIndex',  ["type"=>2]); ?>">音频</a>
                            </div>
                            <div class="list-btn-mail">
                                <span class="entypo-video"></span><a href="<?php echo action('Admin\ResourceController@getIndex',  ["type"=>3]); ?>">视频</a>
                            </div>

                        </div>

                    </div>
                    <!-- /SIDEMENU MAIL -->
                    <!-- CONTENT MAIL -->
                    <div class="col-sm-10">

                        <div class="mail_header">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div style="margin-right:10px" class="btn-group pull-left">
                                        <div class="btn">
                                            <input type="checkbox" style="margin:0 5px;padding:0;position:relative;top:2px;">All</div>
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">None</a>
                                            </li>
                                            <li><a href="#">read</a>
                                            </li>
                                            <li><a href="#">Unread</a>
                                            </li>
                                        </ul>
                                    </div>



                                    <div style="margin-right:10px" class="btn-group pull-left">
                                        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">More
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-ban"></i> Spam</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <button style="margin-right:10px" type="button" data-color="#39B3D7" data-opacity="0.95" class="btn button test pull-left">
                                        <span class="entypo-arrows-ccw"></span>&nbsp;&nbsp;Refresh</button>


                                </div>





                            </div>

                        </div>

                        <div id="content-mail">

                        <div class="container-fluid">
                            <div id="toolbar" class="form-inline">

                            <!-- 搜索表单 -->
                            <form class="form-inline search_form" onsubmit="return false;">

                                <div class="form-group">
                                    <label for="file_name">文件名称：</label>
                                    <input type="text" name="file_name" class="form-control" >
                                </div>


                              <button type="submit" class="btn btn-default search_btn">搜索</button>
                            </form>
                            <!-- 搜索表单 -->

                          </div>
                              <table id="table"
                                       data-toolbar="#toolbar"
                                       data-search="true"
                                       data-show-refresh="true"
                                       data-show-toggle="true"
                                       data-show-columns="true"
                                       data-show-export="true"
                                       data-detail-view="true"
                                       data-detail-formatter="detailFormatter"
                                       data-minimum-count-columns="2"
                                       data-show-pagination-switch="true"
                                       data-pagination="true"
                                       data-page-list="[10, 25, 50, 100, ALL]"
                                       data-show-footer="true"
                                       data-side-pagination="server"
                                       data-url="<?php echo url('admin/resource/search') ;?>"
                                       data-query-params="queryParams"
                                       >
                                <thead>
                                      <tr>
                                          <th data-field="id">id</th>
                                          <th data-field="file_name">文件名称</th>
                                          <th data-field="file_type">文件类型</th>
                                          <th data-field="status">文件状态</th>
                                          <th data-field="sort">排序</th>
                                          <th data-field="created_at">创建时间</th>
                                          <th data-field="handle">操作</th>

                                       </tr>
                                  </thead>

                            </table>
                            </div>

                        </div>


                    </div>
                    <!-- /CONTENT MAIL -->
                </div>
            </div>