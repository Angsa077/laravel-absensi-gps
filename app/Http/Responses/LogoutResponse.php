<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{    
    /**
     * Method toResponse
     *
     * @param $request $request [explicite description]
     *
     * @return void
     */
    public function toResponse($request)
    {
        return redirect('/');
    }
}