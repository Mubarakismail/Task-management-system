<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDevelopers()
    {
        $developers=User::where('type','developer')->pluck('name');
        return response()->json($developers);
    }
}
