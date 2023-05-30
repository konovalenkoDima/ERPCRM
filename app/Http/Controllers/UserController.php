<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateAccessLevel(Request $request)
    {
        $user = User::find($request->input("user_id"));
        $user->access_level = $request->input("access_level");
        $user->save();

        return [
            "status" => "ok"
        ];
    }
}
