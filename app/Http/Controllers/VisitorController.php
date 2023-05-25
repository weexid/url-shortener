<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function show($id_link)
    {
        $link = ShortUrl::where('id', $id_link)->get()->first();
        $count = Visitor::where('short_id', $id_link)->count();
        $location = DB::table('visitors')->select('country', DB::raw('count(*) as count'))->where('short_id', $id_link)->groupBy('country')->get();


        return view('pages.visitor.index', compact('id_link', 'link', 'count', 'location'));
    }
}
