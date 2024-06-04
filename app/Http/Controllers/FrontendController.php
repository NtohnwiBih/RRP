<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Region;
use App\Models\Property;
use App\Models\House;
use App\Models\Vehicle;
use App\Models\Post;

class FrontendController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $favorites = Favorite::all();
            $regions = Region::all();

        return view('front.home', compact('favorites', 'regions'));
    }

    public function about(Request $request)
    {
        return view('front.about');
    }

    public function blog(Request $request)
    {
        $newPosts   = Post::orderBy('id')->get(); 
        return view("front.blog.blog")->with(compact('newPosts')); // ;
    }

    public function blogDetail($id)
    {
         $post_details = Post::findOrFail($id);
        return view('front.blog.blog_details',compact('post_details'));
    }

    public function rent()
    {
        $favorites = Favorite::where('action', 'rent')->get();
        return view('front.properties.properties', compact('favorites'));
    }

    public function buy()
    {
        $favorites = Favorite::where('action', 'buy')->get();
        return view('front.properties.properties', compact('favorites'));
    }

    public function showPropertiesByType($type)
    {
         // Fetch properties for a particular type
         $properties = Property::where('type', $type)->get();

         // Collect all related to these property
         $favorites = collect();
         foreach ($properties as $property) {
             $favorites = $favorites->merge($property->favorites);
         }
        return view('front.properties.property_list', compact('favorites'));
    }

    public function showPropertiesByHouseType($type)
    {
         // Fetch houses for a particular type
         $houses = House::where('type', $type)->get();

         // Collect all related to these property
         $favorites = collect();
         foreach ($houses as $house) {
             $favorites = $favorites->merge($house->favorites);
         }
        return view('front.properties.property_list', compact('favorites'));
    }

    public function showPropertiesByVehicleType($type)
    {
         // Fetch vehicle for a particular type
         $vehicles = Vehicle::where('type', $type)->get();

         // Collect all related to these property
         $favorites = collect();
         foreach ($vehicles as $vehicle) {
             $favorites = $favorites->merge($vehicle->favorites);
         }
        return view('front.properties.property_list', compact('favorites'));
    }

    public function showPropertiesByCity($city)
    {
        // Fetch properties in the specified city
        $properties = Property::where('city', $city)->get();

        // Collect all related to these property
        $favorites = collect();
        foreach ($properties as $property) {
            $favorites = $favorites->merge($property->favorites);
        }

        return view('front.properties.major_cities', compact('favorites', 'city'));
    }

    public function propertyDetail($id)
    {
         $favorite_details = Favorite::findOrFail($id);
        return view('front.properties.property_details',compact('favorite_details'));
    }

    public function search(Request $request)
    {
       // Retrieve search parameters from the request
       $region = $request->input('region_id');
       $type = $request->input('type');
       $keyword = $request->input('keyword');

       // Query to search houses based on provided filters
       $query = Property::query();

       if ($region) {
           $query->whereHas('favorites', function($q) use ($region) {
               $q->where('region_id', 'like', '%' . $region . '%');
           });
       }

       if ($type) {
           $query->whereHas('favorites', function($q) use ($type) {
               $q->where('type', 'like', '%' . $type . '%');
           });
       }

       if ($keyword) {
           $query->whereHas('favorites', function($q) use ($keyword) {
               $q->where('description', 'like', '%' . $keyword . '%');
           });
       }

       // Get the results
       $properties = $query->get();

       // Return the results (could be a view or JSON response)
       return response()->json($properties);
    }
}
