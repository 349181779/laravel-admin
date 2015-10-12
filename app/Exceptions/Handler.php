<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	const NOT_FOUND_CODE = 404;

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		//500错误
//		if ($e->getCode() > 0 ) {
//			return parent::report($e);
//		}
//		//404页面跳转
//		if ($e->getStatusCode() == self::NOT_FOUND_CODE) {
//			header('location: '.createUrl('Admin\Order\OrderList\OrderListController@getIndex'));die;
//		}

//        die(json_encode([
//            'code'	=>$e->getCode(),
//            'msg'	=>'Message:'.$e->getMessage() . ';Line:'.$e->getLine(),
//        ]));

        return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        return parent::render($request, $e);
	}

}
