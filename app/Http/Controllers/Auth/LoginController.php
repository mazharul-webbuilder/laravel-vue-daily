<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'error' => 'Validation Error'
            ]);
        }
        return response()->json([
            'message' => 'Login Successfully'
        ]);
    }
}

//ADD Below lines to POSTMan request Pre-request-script of request for SPA API Authentication
//OOtherwise you will get csrf token mismatch error


//pm.sendRequest({
//    url: "http://127.0.0.1:8000/sanctum/csrf-cookie",
//    method: "GET",
//}, function(err, res, {cookies}){
//    if(!err) {
//        pm.globals.set('csrf-token', cookies.get('XSRF-TOKEN'))
//}
//})


//ADD this to reqeust header
//Accept = application/json
//X-XSRF-TOKEN = {{csrf-token}}  // the csrf-token is comes from global that you created by pre script

// One more think to get valid api response as SPA pass in header Referer = localhost (You domain name)


// Your SPA Santum API reqeust will authorized
