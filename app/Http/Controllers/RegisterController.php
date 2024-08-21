<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\User;
use Validator;

class RegisterController extends Controller
{
    // Validate requested data
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $response['token'] =  $user->createToken('blog-api-token')->accessToken;
    $response['name'] =  $user->name;
    $response['success'] = true;
    $response['message'] = "User registered successfully.";
    return $response;
}
