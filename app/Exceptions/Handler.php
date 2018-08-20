<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * @var string[] $dontFlash
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  Exception $exception
     * @return mixed
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        return parent::report($exception);
    }

    /**
     * @param  Request  $request
     * @param  Exception  $exception
     * @return Response
     */
    public function render($request, Exception $exception): Response
    {
        return parent::render($request, $exception);
    }
}
