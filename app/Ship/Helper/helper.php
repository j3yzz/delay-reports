<?php

function apiResponse( $success, $errors_or_data = [], $code = 0, $extra = [] )
{
    return response( array_merge([
        'success' => boolval( $success ),
        $success ? 'data' : 'errors' => $errors_or_data,
    ], $extra), $code ? $code : ( $success ? 200 : 422 ) );
}
