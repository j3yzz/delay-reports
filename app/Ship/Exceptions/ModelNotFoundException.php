<?php

namespace App\Ship\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException as BaseModelNotFoundExceptionAlias;

class ModelNotFoundException extends BaseModelNotFoundExceptionAlias
{
    protected $model;
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $model = explode('\\',$this->model);
        $name = lcfirst( end($model) );
        return apiResponse(false, ["$name.not_found"]);

    }
}
