<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class SearchController extends Controller
{
    public function index(Request $request)
    {
      $region = $request->input('region_id');
      $type = $request->input('type');
      $keyword = $request->input('keyword');

      $favorites = Favorite::whereHas('property', function ($query) use ($region) {
        $query->where('region_id', 'LIKE', $region);
      })->whereHas('property', function ($query) use ($type) {
        $query->where('type', 'LIKE', $type);
      })->whereHas('property', function ($query) use ($keyword) {
        $query->where(function ($query) use ($keyword) {
            $query->orwhere('action', 'LIKE', $keyword)
                ->orWhere('city', 'LIKE', $keyword);
        });
      })->get();


       // Return the results (could be a view or JSON response)
       return view('front.properties.search', compact('favorites'));
    }
}
