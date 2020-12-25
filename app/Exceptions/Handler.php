<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }



    protected function renderHttpException(HttpExceptionInterface $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => trans('api.not_found'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.endpoint_not_found'),
                ]
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'status' => trans('api.not_found'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.http_method_not_allowed'),
                ]
            ], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($e instanceof AuthenticationException ) {
            return response()->json([
                'status' => trans('api.unauthorized'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.http_method_not_allowed'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof UnauthorizedHttpException) {
            return response()->json([
                'status' => trans('api.unauthorized'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.unauthorized'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof HttpException) {
            return response()->json([
                'status' => trans('api.http_exception'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getStatusCode()
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => trans('api.ModelNotFoundException'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.ModelNotFoundException'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => trans('api.ModelNotFoundException'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.ModelNotFoundException'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof AuthorizationException) {
            return response()->json([
                'status' => trans('api.AuthorizationException'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.AuthorizationException'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        if ($e instanceof TokenMismatchException) {
            return response()->json([
                'status' => trans('api.TokenMismatchException'),
                'locale' => app()->getLocale(),
                'errors' => true,
                'data' => [
                    'message' => trans('api.TokenMismatchException'),
                ]
            ], JsonResponse::HTTP_FORBIDDEN);
        }

        return response()->json([
            'status' => trans('api.bad_request'),
            'locale' => app()->getLocale(),
            'errors' => true,
            'data' => [
                'message' => trans('api.bad_request'),
            ]
        ], JsonResponse::HTTP_FORBIDDEN);
    }

}
