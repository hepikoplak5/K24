<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request, $id)
    {
        $user = User::find($id);

    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
    }

    public function destory(Request $request)
    {
        $user = User::find($request->id);
    }
}
