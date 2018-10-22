<?php

namespace Fnp\RouteMax\Extension;

use Fnp\RouteMax\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

trait Validation
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @throws ValidationException
     */
    public function initValidationTrait(Request $request, Response $response)
    {
        $data = array_merge($request->all(), $request->route()->parameters());

        $validator = \Validator::make(
            $data,
            $this->initValidationRules(),
            $this->initValidationMessages()
        );

        if ($validator->fails()) {
            $view = $this->onValidationFailed($validator);
            throw new ValidationException($view);
        }
    }

    abstract public function initValidationRules(): array;

    abstract public function initValidationMessages(): array;

    abstract public function onValidationFailed(Validator $validator);
}