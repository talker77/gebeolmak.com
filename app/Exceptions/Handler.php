<?php

namespace App\Exceptions;

use App\Listeners\LoggingListener;
use App\Models\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use JsonSerializable;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The unique incident ID code.
     *
     * @var bool|string
     */
    protected $incidentCode = false;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
        $this->incidentCode = Str::random(12);
        $listener = $this->container->make(LoggingListener::class);
        $listener->events->map(function (MessageLogged $logged) use ($exception) {
            $logged->context = collect($logged->context)->map(function ($item) {
                if ($item instanceof JsonSerializable) {
                    return $item;
                }
                if (\is_array($item)) {
                    return json_encode($item);
                }

                return (string) $item;
            });
            \Illuminate\Support\Facades\Log::critical($logged->message, ['user' => 'test']);
            Log::addLog($logged->message, $exception, Log::TYPE_GENERAL, $this->incidentCode, request()->fullUrl());

            return $logged;
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('user.login'));
    }


    /**
     * Render the given HttpException.
     *
     * @param \Throwable
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $this->registerErrorViewPaths();
        if (view()->exists($view = "errors::{$e->getStatusCode()}")) {
            return response()->view($view, [
                'errors'       => new ViewErrorBag(),
                'exception'    => $e,
                'incidentCode' => $this->incidentCode ?? false,
            ], $e->getStatusCode(), $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }

}
