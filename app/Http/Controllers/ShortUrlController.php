<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortRequest;
use App\Models\ShortUrl;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class ShortUrlController extends Controller
{
    // halaman utama
    public function index()
    {
        if (auth()->check()) {
            $user = User::find(auth()->user()->id);
            $links = $user->links()->withCount('visitor')->get();
            return view('home', compact('links'));
        } else {
            return view('home');
        }
    }

    // get Short detail to modal
    public function getShortDetail($id)
    {
        $short = ShortUrl::findOrFail($id);
        return response()->json($short);
    }

    // generate short url
    public function short(ShortRequest $request)
    {
        if ($request->original_url) {
            if (auth()->user()) {
                $user_id = auth()->user()->id;

                $new_url = new ShortUrl();
                $new_url->original_url = $request->original_url;
                $new_url->user_id = $user_id;
                $new_url->save();
            } else {
                $new_url = ShortUrl::create([
                    'original_url' => $request->original_url
                ]);
            }
            if ($new_url) {
                $short_url = base_convert($new_url->id, 10, 36);
                $new_url->update([
                    'short_url' => $short_url
                ]);
                return redirect()->back()->with('shorted_link', url($short_url));
            }
            return back();
        }
    }

    // Direct from short url code to actual url
    public function show($code, Request $req)
    {
        $short_url = ShortUrl::where('short_url', $code)->first();

        if ($short_url) {
            $short_url->increment('visits');
            $ip = $req->ip();
            $country = null;

            if ($ip != '127.0.0.1') {
                $country = Location::get($ip)->countryName;
            }

            $visitor = new Visitor;
            $visitor->short_id = $short_url->id;
            $visitor->ip_address = $ip;
            $visitor->country = $country;
            $visitor->save();

            return  redirect()->to(url($short_url->original_url));
        }
        return redirect()->to(url('/'));
    }

    // submit edit from edit modals
    public function submitEdit(Request $request, $id)
    {
        $short = ShortUrl::find($id);
        $request->validate([
            'newShort' => 'required|unique:short_urls,short_url'
        ]);

        $short->update([
            'short_url' => $request->newShort
        ]);

        return response()->json(['success' => true, 'message' => "Short url successfully updated !"]);
    }

    // delete short
    public function deleteShort($id)
    {
        $short = ShortUrl::find($id);

        if (!$short) {
            return response()->json(['message' => 'short url not found !'], 400);
        }
        try {
            $short->delete();
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Error deleting short url'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Short url successfully deleted !']);
    }
}
