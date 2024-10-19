<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use LaravelJsonApi\Core\Exceptions\JsonApiException;

class Handler extends ExceptionsHandler
{
    protected $dontReport = [
        JsonApiException::class,
    ];

    public function register()
    {
        $this->renderable(
            \LaravelJsonApi\Exceptions\ExceptionParser::make()->renderable()
        );
    }
}
