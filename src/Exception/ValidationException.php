<?php

namespace Fnp\RouteMax\Exception;

class ValidationException extends \Exception
{
    public function report()
    {
        // Intentionally Left Blank
    }

    public function render($request)
    {
        return $this->getMessage();
    }
}