<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    public function report(Throwable $exception)
    {
        $errorMessage = $exception->getMessage();
        $filePath = $exception->getFile();
        $lineNumber = $exception->getLine();
        $errorClass = get_class($exception);
        $ip = '';//GetUserIp();

        $content = "<h3>Hello</h3>";
        $content .= "<p>Below are details of error occured website:</p>";
        $content .= "<p><b>Date:</b> " . date("Y-m-d H:i:s") . "</p>";
        $content .= "<p><b>Page URL:</b>" . Request()->fullUrl() . "</p>";
        $content .= "<p><b>Request Method:</b> " . Request()->method() . "</p>";
        $content .= "<p><b>Request IP:</b> " . $ip . "</p>";
        $content .= "<p><b>User Agent:</b> " . Request()->header('user-agent') . "</p>";
        $content .= "<p><b>Error Class:</b> $errorClass</p>";
        $content .= "<p><b>Error Message:</b> $errorMessage</p>";
        $content .= "<p><b>Error ON File:</b> $filePath</p>";
        $content .= "<p><b>Error in line number:</b> $lineNumber</p>";
        $body  = $content;

        $params["to"] = 'alkathumar91@gmail.com';
        $params["subject"] = env("APP_NAME") . ": " . substr($errorMessage, 0, 30);
        $params["body"] = $body;

        $sendEmail = 1;
        if ("Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException" == $errorClass) {
            $sendEmail = 0;
        } else if ("Symfony\Component\HttpKernel\Exception\NotFoundHttpException" == $errorClass) {
            $sendEmail = 0;
        } else if ("Illuminate\Session\TokenMismatchException" == $errorClass) {
            $sendEmail = 0;
        } else if ("Illuminate\Auth\AuthenticationException" == $errorClass) {
            $sendEmail = 0;
        } else if ("Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException" == $errorClass) {
            $sendEmail = 0;
        }
        if ($sendEmail == 1) {
            if (env("ERROR_HANDLER") == 'on') {
                try {
                    \Mail::send('emails.index', $params, function ($message) use ($params) {
                        $toEmails[] = $params['to'];
                        $message->to($toEmails);
                        $message->subject($params["subject"]);
                    });
                } catch (\Throwable $th) {
                }
            }
        }
        parent::report($exception);
    }
}
