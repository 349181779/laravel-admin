<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title;?></title>
	@section('header')
        	@include('......admin.block.header')
            <?php echo Html::style('/assets/js/upload/demos/css/uploader.css');?>
            <?php echo Html::style('/assets/js/upload/demos/css/demo.css');?>
            <?php echo Html::style('/assets/js/dropZone/downloads/css/dropzone.css');?>
    @show
    <style>
    body{background: #fff;}
    </style>
</head>
<body>


    <div class="container">

       <div class="content-wrap">
         <div class="row">
           <div class="col-sm-12">
             <div class="nest" id="DropZoneClose">
               <div class="title-alt">


                   <div class="row">

                       <div class="col-sm-2">
                           <h6> 上传文件</h6>
<!--                           <div class="titleClose"> <a class="gone" href="#DropZoneClose"> <span class="entypo-cancel"></span> </a> </div>-->
<!--                           <div class="titleToggle"> <a class="nav-toggle-alt" href="#DropZone"> <span class="entypo-up-open"></span> </a> </div>-->
                       </div>

                       <form method="post" class="form-inline search_form" onsubmit="return false;">

                           <!--下拉选择框 -->
                           <div class="form-group">
                               <label for="source">来源 ：</label>
                               <select class="form-control" name="source" onchange="changeSource(this)">
                                   <?php if(!empty($all_image_source)):?>
                                       <?php foreach($all_image_source as $image_souce):?>
                                           <option value="<?php echo $image_souce['id'] ;?>"><?php echo $image_souce['name'] ;?></option>
                                       <?php endforeach;?>
                                   <?php endif;?>
                               </select>
                           </div>



                           <!--下拉选择框 -->
                           <div class="form-group">
                               <label for="image_type">图片类型：</label>
                               <select class="form-control" name="image_type" onchange="changeImageType(this)">
                                   <?php if(!empty($all_image_type)):?>
                                       <?php foreach($all_image_type as $image_type):?>
                                           <option value="<?php echo $image_type['id'] ;?>"><?php echo $image_type['name'] ;?></option>
                                       <?php endforeach;?>
                                   <?php endif;?>
                               </select>
                           </div>

                       </form>
                   </div>

               </div>





               <div class="body-nest" id="DropZone">
                 <form action="<?php echo $upload_url ;?>" class="dropzone" id="my-dropzone">
                     <input type="hidden" name="source">
                     <input type="hidden" name="image_type">
                    <input type="hidden" name="_token" value="<?php echo  csrf_token();?>">
                 </form>
                 <button style="margin-top:10px;" class="btn btn-info" id="submit-all">确认上传</button>
               </div>
             </div>
           </div>
         </div>
       </div>

    </div>
    <!-- MAIN EFFECT -->
    @section('js')
    	@parent
        @include('admin.block.base_js')

        <script type="text/javascript" src="/assets/js/upload/src/dmuploader.min.js"></script>
        <script type="text/javascript" src="/assets/js/dropZone/lib/dropzone.js"></script>
        <script type="text/javascript">

            /**
             * 选择图片资源
             */
            function changeSource(obj){
                var _this = $(obj)
                $('.dropzone').find('input[name=source]').val(_this.val())
            }

            /**
             * 选择图片类型
             */
            function changeImageType(obj){
                var _this = $(obj)
                $('.dropzone').find('input[name=image_type]').val(_this.val())
            }


            //触发事件
            $('select[name=source]').trigger('change')
            $('select[name=image_type]').trigger('change')

            //上传
            Dropzone.options.myDropzone = {

                // Prevents Dropzone from uploading dropped files immediately
                autoProcessQueue: false,

                //初始化
                init: function() {
                    var submitButton = document.querySelector("#submit-all")
                    myDropzone = this; // closure

                    submitButton.addEventListener("click", function() {
                        myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                    });

                    // You might want to show the submit button only when
                    // files are dropped here:
                    this.on("addedfile", function() {
                        // Show submit button here and/or inform user to click it.
                    });

                },

                //上传成功回调
                success: function(file){
                    var _data = $.parseJSON(file.xhr.response);
                    if (_data.code == HTTP_CODE.SUCCESS_CODE) {
                        toastr.success(_data.msg);
                        return file.previewElement.classList.add("dz-success");
                    }else{
                        toastr.warning(_data.msg);
                        return file.previewElement.classList.add("dz-error");
                    }

                }
            };
            </script>
    @show
    <!-- /MAIN EFFECT -->

</body>
</html>
