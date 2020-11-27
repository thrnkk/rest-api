<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct(User $users){
        $this->users = $users;
    }

    public function login(Request $request)
    {

    	$name = $request->input('name');
    	$password = $request->input('password');

    	$user = $this->users->where('name', $name)
    						->where('password', $password)
    						->first();

    	if(!$user) {
            return response()->json(['message' => 'Login inválido.'], 404);
        }

        Session::put('user', $user);

        return response()->json($user, 200);

    }

    public function register(Request $request)
    {

    	$user = new User();
        $user->fill($request->all());
        $user->save();

        return response()->json($user, 201);

    }

}
