<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|min:6|max:12|unique:user',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()]
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([], 200);
    }

    //
}
