<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\House;
use App\Models\Studio;
use App\Models\Favorite;
use App\Models\Region;
use Image;
use Auth;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studios = Studio::with('house')->latest()->paginate(10);
        return view('admin.property.house.studio.index', compact('studios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.house.studio.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
              //$image->move(public_path('uploads/images/property/house/studio'), $name);
              Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/studio/' . $name));
               $data[] = $name;  
           }
        }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->region_id = $request->input('region_id');
        $property->amount = $request->input('price');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->date = $request->input('date');
        $property->save();

        $house = new House;
        $house->property()->associate($property);
        $house->type = $request->input('house-type');
        $house->fence = $request->input('fence');
        $house->packing = $request->input('parking');
        $house->swimming_pool = $request->input('pool');
        $house->save();

        $studio = new Studio;
        $studio->property()->associate($property);
        $studio->house()->associate($house);
        $studio->type = $request->input('studio-type');
        $studio->bathroom = $request->input('bathroom');
        $studio->kitchen = $request->input('kitchen');
        $studio->balcony = $request->input('balcony');
        $studio->save();

        $favorite = new Favorite;
        $favorite->user_id = auth()->id();
        $favorite->property()->associate($property);
        $favorite->house()->associate($house);
        $favorite->studio()->associate($studio);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('studio.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studio $studio)
    {
        if ($studio->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.house.studio.edit', compact('studio', 'regions'), array('user' => Auth::user()));
        } else {
            return redirect()->route('studio.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::find(request('propertyid'));
        $house = House::find(request('houseid'));
        $studio = Studio::find(request('studioid'));

        if ($studio->property->user_id == auth()->id()) {
            if($request->hasfile('filename'))
            {
    
               foreach($request->file('filename') as $image)
               {
                   $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                  //$image->move(public_path('uploads/images/property/house/studio'), $name);
                  Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/studio/' . $name));
                   $data[] = $name;  
               }
            }

            $property->user_id = auth()->id();
            $property->name = $request->input('name');
            $property->type = $request->input('type');
            $property->description =$request->input('description');
            $property->region_id = $request->input('region_id');
            $property->amount = $request->input('price');
            $property->city = $request->input('city');
            $property->quater = $request->input('quater');
            $property->image = json_encode($data);
            $property->action = $request->input('action');
            $property->date = $request->input('date');
            $property->update();
    
            $house->property()->associate($property);
            $house->type = $request->input('house-type');
            $house->fence = $request->input('fence');
            $house->packing = $request->input('parking');
            $house->swimming_pool = $request->input('pool');
            $house->update();
    
            $studio->property()->associate($property);
            $studio->house()->associate($house);
            $studio->type = $request->input('studio-type');
            $studio->bathroom = $request->input('bathroom');
            $studio->kitchen = $request->input('kitchen');
            $studio->balcony = $request->input('balcony');
            $studio->update();
    
            return redirect()->route('studio.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
        } else {
            return redirect()->route('studio.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       // Find the studio by its ID
       $studio = Studio::findOrFail($id);

       // Check if the studio has an associated property
       if ($studio->favorite) {
           // Delete the associated property first
           $studio->favorite->delete();
       }

       // Delete the studio record
       $studio->delete();

       // Return a response
       return redirect()->route('studio.index');
    }
}
