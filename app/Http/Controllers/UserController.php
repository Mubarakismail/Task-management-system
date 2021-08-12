<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDevelopers()
    {
        $developers=User::where('type','developer')->pluck('name');
        return response()->json($developers);
    }
}
