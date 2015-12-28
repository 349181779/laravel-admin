<?php 

            //
            // NOTE Migration Created: 2015-12-13 17:13:51
            // --------------------------------------------------

            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;

            class CreateLaravelDatabase  extends Migration {
                //
                // NOTE - Make changes to the database.
                // --------------------------------------------------
                public function up()
                {
                Schema::create('add_user', function($table) {
 $table->increments('id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->unsignedInteger('invitee')->unsigned();
 $table->timestamp('created_at');
 $table->tinyInteger('status')->unsigned();
 });

Schema::create('admin_function', function($table) {
 $table->increments('id');
 $table->unsignedInteger('parent_id');
 $table->string('function_name', 50);
 });

Schema::create('admin_info', function($table) {
 $table->increments('id');
 $table->unsignedInteger('station_id');
 $table->unsignedInteger('limit_id');
 $table->string('admin_name', 50);
 $table->string('password', 60);
 $table->string('token', 255)->nullable();
 $table->unsignedInteger('state');
 $table->timestamp('last_login');
 $table->timestamp('create_date');
 $table->string('mobile', 50);
 });

Schema::create('admin_limit', function($table) {
 $table->increments('id');
 $table->string('limit_name', 50);
 });

Schema::create('admin_limit_menu', function($table) {
 $table->increments('id');
 $table->unsignedInteger('limit_id');
 $table->unsignedInteger('menu_id');
 });

Schema::create('admin_menu', function($table) {
 $table->increments('id');
 $table->unsignedInteger('parent_id');
 $table->string('menu_name', 50);
 $table->string('menu_url', 255);
 $table->tinyInteger('sort')->unsigned();
 });

Schema::create('app', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45)->unique();
 $table->string('site_url', 45);
 $table->string('icon', 45);
 $table->string('thumb_small', 45);
 $table->string('thumb_medium', 45);
 $table->string('thumb_logo', 45);
 $table->unsignedInteger('view')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->string('created_at', 45);
 $table->string('updated_at', 45);
 $table->string('deleted_at', 45);
 $table->integer('app_cat_id');
 });

Schema::create('app_cat', function($table) {
 $table->increments('id');
 $table->string('cat_name', 45)->unique();
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->smallInteger('pid')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('article', function($table) {
 $table->increments('id')->unsigned();
 $table->string('title', 45)->unique();
 $table->string('thumb', 255);
 $table->string('keywords', 45);
 $table->string('description', 45);
 $table->text('contents');
 $table->tinyInteger('sort')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at')->nullable();
 $table->timestamp('updated_at')->nullable();
 $table->timestamp('deleted_at')->nullable();
 $table->mediumInteger('view')->unsigned();
 $table->smallInteger('article_cat_id')->unsigned();
 $table->unsignedInteger('admin_info_id')->unsigned();
 });

Schema::create('article_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45)->unique();
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->smallInteger('pid')->nullable();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at')->nullable();
 $table->timestamp('updated_at')->nullable();
 $table->timestamp('deleted_at')->nullable();
 });

Schema::create('config', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45)->unique();
 $table->string('value', 255);
 $table->string('comment', 45);
 });

Schema::create('email', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45)->unique();
 $table->string('site_url', 45)->unique();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('forum', function($table) {
 $table->increments('id')->unsigned();
 $table->string('title', 45);
 $table->text('contents');
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->smallInteger('forum_cat_id')->unsigned();
 $table->unsignedInteger('view')->unsigned();
 });

Schema::create('forum_access', function($table) {
 $table->increments('id')->unsigned();
 $table->smallInteger('forum_cat_id')->unsigned();
 $table->unsignedInteger('role_id')->unsigned();
 });

Schema::create('forum_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45);
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->smallInteger('pid')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->tinyInteger('is_show')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('forum_comment', function($table) {
 $table->increments('id')->unsigned();
 $table->unsignedInteger('forum_id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at');
 $table->string('contents', 255);
 $table->unsignedInteger('node')->unsigned();
 });

Schema::create('friend_group', function($table) {
 $table->increments('id')->unsigned();
 $table->string('group_name', 45);
 $table->timestamp('created_at');
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->tinyInteger('is_default')->unsigned();
 });

Schema::create('friends', function($table) {
 $table->increments('id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->unsignedInteger('friend_user_id')->unsigned();
 $table->timestamp('created_at');
 $table->unsignedInteger('friend_group_id')->unsigned();
 });

Schema::create('letter', function($table) {
 $table->increments('id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->string('contens', 45);
 $table->timestamp('created_at');
 $table->unsignedInteger('send_uid')->unsigned();
 $table->tinyInteger('type')->unsigned();
 $table->tinyInteger('status')->unsigned();
 });

Schema::create('menu', function($table) {
 $table->increments('id')->unsigned();
 $table->string('menu_name', 45);
 $table->unsignedInteger('pid')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->string('icon', 45);
 $table->string('url', 45);
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('news', function($table) {
 $table->increments('id')->unsigned();
 $table->string('title', 45)->unique();
 $table->string('site_url', 255)->unique();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->unsignedInteger('view')->unsigned();
 $table->string('thumb', 255);
 $table->smallInteger('news_cat_id')->unsigned();
 $table->unsignedInteger('admin_info_id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 });

Schema::create('news_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45)->unique();
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->smallInteger('pid')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('query', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45)->unique();
 $table->string('site_url', 45)->unique();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->smallInteger('query_cat_id')->unsigned();
 });

Schema::create('query_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45);
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('resource', function($table) {
 $table->increments('id')->unsigned();
 $table->string('file_name', 255)->unique();
 $table->tinyInteger('file_type')->unsigned();
 $table->string('error', 45);
 $table->tinyInteger('sort')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('resource_slave', function($table) {
 $table->increments('id');
 $table->string('file_name', 100)->unique();
 $table->string('persistent_fop_id', 45);
 $table->string('bucket', 45);
 $table->string('reqid', 45);
 $table->string('cmd', 100);
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('role', function($table) {
 $table->increments('id')->unsigned();
 $table->string('role_name', 45)->unique();
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('role_relation_menu', function($table) {
 $table->increments('id')->unsigned();
 $table->integer('role_id')->unsigned();
 $table->integer('menu_id')->unsigned();
 });

Schema::create('role_relation_rule', function($table) {
 $table->increments('id')->unsigned();
 $table->integer('role_id')->unsigned();
 $table->integer('rule_id')->unsigned();
 });

Schema::create('rule', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45);
 $table->string('title', 45);
 $table->tinyInteger('status')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 });

Schema::create('search', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 45);
 $table->string('search_url', 255)->unique();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->smallInteger('search_cat_id')->unsigned();
 });

Schema::create('search_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45)->unique();
 $table->string('logo', 45);
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->tinyInteger('is_default')->unsigned();
 });

Schema::create('site', function($table) {
 $table->increments('id')->unsigned();
 $table->string('site_name', 45)->unique();
 $table->string('name', 45)->nullable();
 $table->smallInteger('site_cat_id')->unsigned();
 $table->string('site_url', 255)->unique();
 $table->string('icon', 45);
 $table->string('thumb_small', 45);
 $table->string('thumb_medium', 45);
 $table->string('thumb_logo', 45);
 $table->unsignedInteger('view')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->unsignedInteger('admin_info_id')->unsigned();
 });

Schema::create('site_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45)->unique();
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->smallInteger('pid')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->tinyInteger('is_show_search')->unsigned();
 });

Schema::create('user_info', function($table) {
 $table->increments('id')->unsigned();
 $table->string('user_name', 45);
 $table->string('email', 45)->unique();
 $table->bigInteger('mobile')->unsigned();
 $table->string('password', 60);
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sex')->unsigned();
 $table->date('birthday')->nullable();
 $table->string('face', 45);
 $table->string('open_id', 255);
 $table->tinyInteger('is_validate_email')->unsigned();
 $table->tinyInteger('is_validate_mobile')->unsigned();
 $table->dateTime('created_at');
 $table->dateTime('updated_at');
 $table->dateTime('deleted_at');
 $table->unsignedInteger('account_number')->unsigned();
 });

Schema::create('user_news_category', function($table) {
 $table->increments('id')->unsigned();
 $table->unsignedInteger('user_info_id')->unsigned();
 $table->smallInteger('news_cat_id')->unsigned();
 });

Schema::create('user_profile', function($table) {
 $table->increments('id')->unsigned();
 $table->string('truename', 45);
 $table->string('other_email', 45);
 $table->string('qq', 20);
 $table->string('wechat', 45);
 $table->string('weibo', 45);
 $table->string('id_card', 20);
 $table->tinyInteger('marriage')->unsigned();
 $table->string('occupation', 45);
 $table->string('province', 45)->nullable();
 $table->string('city', 45)->nullable();
 $table->string('area', 45)->nullable();
 $table->string('home_province', 45);
 $table->string('home_city', 45);
 $table->string('home_area', 45);
 $table->unsignedInteger('user_info_id')->unsigned();
 });

Schema::create('user_site', function($table) {
 $table->increments('id')->unsigned();
 $table->string('site_name', 45);
 $table->string('name', 45);
 $table->string('site_url', 45);
 $table->string('icon', 45);
 $table->string('thumb_small', 45);
 $table->string('thumb_medium', 45);
 $table->string('thumb_logo', 45);
 $table->unsignedInteger('view')->unsigned();
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->string('created_at', 45);
 $table->string('updated_at', 45);
 $table->string('deleted_at', 45);
 $table->unsignedInteger('user_site_cat_id')->unsigned();
 });

Schema::create('user_site_cat', function($table) {
 $table->increments('id')->unsigned();
 $table->string('cat_name', 45);
 $table->string('keywords', 45);
 $table->string('description', 255);
 $table->string('pid', 45);
 $table->tinyInteger('status')->unsigned();
 $table->tinyInteger('sort')->unsigned();
 $table->timestamp('created_at');
 $table->timestamp('updated_at');
 $table->timestamp('deleted_at');
 $table->unsignedInteger('user_info_id')->unsigned();
 });

Schema::table('add_user', function($table) {
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('app', function($table) {
 $table->foreign('app_cat_id')->references('id')->on('app_cat');
 });

Schema::table('article', function($table) {
 $table->foreign('admin_info_id')->references('id')->on('admin_info');
 $table->foreign('article_cat_id')->references('id')->on('article_cat');
 });

Schema::table('forum', function($table) {
 $table->foreign('forum_cat_id')->references('id')->on('forum_cat');
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('forum_access', function($table) {
 $table->foreign('forum_cat_id')->references('id')->on('forum_cat');
 $table->foreign('role_id')->references('id')->on('role');
 });

Schema::table('forum_comment', function($table) {
 $table->foreign('forum_id')->references('id')->on('forum');
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('friend_group', function($table) {
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('friends', function($table) {
 $table->foreign('friend_group_id')->references('id')->on('friend_group');
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('letter', function($table) {
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('news', function($table) {
 $table->foreign('news_cat_id')->references('id')->on('news_cat');
 });

Schema::table('query', function($table) {
 $table->foreign('query_cat_id')->references('id')->on('query_cat');
 });

Schema::table('role_relation_menu', function($table) {
 $table->foreign('menu_id')->references('id')->on('menu');
 $table->foreign('role_id')->references('id')->on('role');
 });

Schema::table('role_relation_rule', function($table) {
 $table->foreign('role_id')->references('id')->on('role');
 $table->foreign('rule_id')->references('id')->on('rule');
 });

Schema::table('search', function($table) {
 $table->foreign('search_cat_id')->references('id')->on('search_cat');
 });

Schema::table('site', function($table) {
 $table->foreign('admin_info_id')->references('id')->on('admin_info');
 $table->foreign('site_cat_id')->references('id')->on('site_cat');
 });

Schema::table('user_news_category', function($table) {
 $table->foreign('news_cat_id')->references('id')->on('news_cat');
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('user_profile', function($table) {
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });

Schema::table('user_site', function($table) {
 $table->foreign('user_site_cat_id')->references('id')->on('user_site_cat');
 });

Schema::table('user_site_cat', function($table) {
 $table->foreign('user_info_id')->references('id')->on('user_info');
 });


                
                }
                //
                // NOTE - Revert the changes to the database.
                // --------------------------------------------------
                public function down()
                {
                Schema::drop('add_user');Schema::drop('admin_function');Schema::drop('admin_info');Schema::drop('admin_limit');Schema::drop('admin_limit_menu');Schema::drop('admin_menu');Schema::drop('app');Schema::drop('app_cat');Schema::drop('article');Schema::drop('article_cat');Schema::drop('config');Schema::drop('email');Schema::drop('forum');Schema::drop('forum_access');Schema::drop('forum_cat');Schema::drop('forum_comment');Schema::drop('friend_group');Schema::drop('friends');Schema::drop('letter');Schema::drop('menu');Schema::drop('news');Schema::drop('news_cat');Schema::drop('query');Schema::drop('query_cat');Schema::drop('resource');Schema::drop('resource_slave');Schema::drop('role');Schema::drop('role_relation_menu');Schema::drop('role_relation_rule');Schema::drop('rule');Schema::drop('search');Schema::drop('search_cat');Schema::drop('site');Schema::drop('site_cat');Schema::drop('user_info');Schema::drop('user_news_category');Schema::drop('user_profile');Schema::drop('user_site');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');Schema::drop('user_site_cat');
                
                }
            }