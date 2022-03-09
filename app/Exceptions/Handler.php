<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    private Responder $responder;

    public function __construct(Container $container)
    {
        $this->responder = new Responder();

        parent::__construct($container);
    }
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return $this->responder->notFoundResponse($e);
        });

        $this->renderable(function (QueryException $e) {
            return $this->responder->queryExceptionResponse($e);
        });

        $this->renderable(function (AuthenticationException $e) {
            return $this->responder->authenticationExceptionResponse($e);
        });

        $this->renderable(function (ValidationException $e) {
            return $this->responder->validationResponse($e);
        });

        $this->renderable(function (\Exception $e) {
            return $this->responder->exceptionResponse($e);
        });
    }
}
