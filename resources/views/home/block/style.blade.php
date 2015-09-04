<link rel="stylesheet" href="/toastr/toastr.css"/>
<link type="text/css" href="/site/css/index.css" rel="stylesheet" />
<script type="text/javascript" src="/site/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/site/js/core.js"></script>
<script>
    var logout_url = '<?php echo action("Home\UserController@getLogout") ;?>';
    var get_search = '<?php echo action("Home\SearchController@postSearchInfo") ;?>';
    var login_url   = '<?php echo action("Home\UserController@postLogin") ;?>';
</script>