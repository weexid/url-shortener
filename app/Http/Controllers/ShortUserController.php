<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;

class ShortUserController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $links = $user->links()->withCount('visitor')->get();

        return view('layouts.links.index', compact('links'));
    }
}
