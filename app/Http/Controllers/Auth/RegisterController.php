<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        // request()->validate(
        //     [
        //         'name' => 'required|min:1|max:25',
        //         'username' => 'required|alpha_num|min:3|max:255|unique:users,username',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|min:6'
        //     ]
        // );
        User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        return response('Thank you for reqister');
    }
}
