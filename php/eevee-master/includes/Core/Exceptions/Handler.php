<?php

namespace Core\Exceptions;

use Exception;
use PDOException;
use Core\Services\Context;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response|void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        if ($e instanceof StatusException) {
            
            return (new Context($request))->response($e->status);

        } else if ($e instanceof PDOException) {

            return (new Context($request))->response(status('databaseException', $e->getMessage()));
            
        } else {

            return parent::render($request, $e);

        }
    }
}
