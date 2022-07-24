<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->input('query')) {
            $search = $request->input('query');
            $videos = Video::where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")->get();
            return view('search', compact("videos"));
        }

        return view('search', ['videos' => []]);
    }
}
