<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Check if email exists in the db
     * 
     * @return Response
     */
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(['message' => 'The email has already been taken.'], 200);
        }

        return response()->json(['message' => 'The email doesn\'t exist in our database.'], 404);
    }
}
