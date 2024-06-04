<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\Vehicle;
use App\Models\Bike;
use App\Models\Favorite;
use App\Models\Region;
use Image;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bikes = Bike::with('vehicle')->latest()->paginate(10);
        return view('admin.property.vehicle.bike.index', compact('bikes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.vehicle.bike.create', compact('regions'));
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
               //$image->move(public_path('uploads/images/property/vehicle/bike/'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/vehicle/bike/' . $name));
               $data[] = $name;  
           }
        }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->amount = $request->input('price');
        $property->region_id = $request->input('region_id');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->date = $request->input('date');
        $property->save();

        $vehicle = new Vehicle;
        $vehicle->property()->associate($property);
        $vehicle->type = $request->input('vehicle-type');
        $vehicle->color = $request->input('color');
        $vehicle->year = $request->input('year');
        $vehicle->save();

        $bike = new Bike;
        $bike->property()->associate($property);
        $bike->vehicle()->associate($vehicle);
        $bike->brand = $request->input('brand');
        $bike->model = $request->input('model');
        $bike->save();

        $favorite = new Favorite;
        $favorite->user_id = auth()->id();
        $favorite->property()->associate($property);
        $favorite->vehicle()->associate($vehicle);
        $favorite->bike()->associate($bike);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('bike.index')->with(['status'=>'success','message'=>'Bike added successfully!!!']);
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
    public function edit(string $id)
    {
        if ($bike->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.vehicle.bike.edit', compact('bike', 'regions'), array('user' => Auth::user()));
        } else {
            return redirect()->route('bike.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::find(request('propertyid'));
        $vehicle = Vehicle::find(request('vehicleid'));
        $bike = Bike::find(request('bikeid'));
        if ($bike->property->user_id == auth()->id()) {
            if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
               //$image->move(public_path('uploads/images/property/vehicle/bike/'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/vehicle/bike/' . $name));
               $data[] = $name;  
           }
        }
        $property->user_id = auth()->id();
        $property->name = $request->input('name');
        $property->type = $request->input('type');
        $property->description =$request->input('description');
        $property->amount = $request->input('price');
        $property->region_id = $request->input('region_id');
        $property->city = $request->input('city');
        $property->quater = $request->input('quater');
        $property->image = json_encode($data);
        $property->action = $request->input('action');
        $property->date = $request->input('date');
        $property->save();

        $vehicle->property()->associate($property);
        $vehicle->type = $request->input('vehicle-type');
        $vehicle->color = $request->input('color');
        $vehicle->year = $request->input('year');
        $vehicle->save();

        $bike->property()->associate($property);
        $bike->vehicle()->associate($vehicle);
        $bike->brand = $request->input('brand');
        $bike->model = $request->input('model');
        $bike->save();

        return redirect()->route('bike.index')->with(['status'=>'success','message'=>'Bike added successfully!!!']);
        } else {
            return redirect()->route('bike.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       // Find the bike by its ID
       $bike = Bike::findOrFail($id);

       // Check if the bike has an associated property
       if ($bike->favorite) {
           // Delete the associated property first
           $bike->favorite->delete();
       }

       // Delete the bike record
       $bike->delete();

       // Return a response
       return redirect()->route('bike.index');
    }
}
