<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
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

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof QueryException) {
    //         // Check if the exception message contains the specific error message
    //         if (strpos($exception->getMessage(), 'Integrity constraint violation') !== false) {
    //             // Redirect to a specific route when the integrity constraint violation occurs
    //             return redirect()->to('pengguna')->with('error', 'Data ini sedang digunakan');
    //         }
    //     }

    //     return parent::render($request, $exception);
    // }
}
