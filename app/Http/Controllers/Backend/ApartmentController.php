<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\House;
use App\Models\Apartment;
use App\Models\Favorite;
use App\Models\Region;
use Image;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::with('house')->latest()->paginate(10);
        return view('admin.property.house.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.house.apartment.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|max:30|min:3',
        //     'type' => 'required',
        //     'description' => 'required|min:100',
        //     'region_id' => 'required',
        //     'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        //     'city' => 'required',
        //     'quater' => 'required',
        //     'filename' => 'required',
        //     'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        //     'house-type' => 'required',
        //     'fence' => 'required',
        //     'parking' => 'required',
        //     'pool' => 'required',
        //     'apartment-type' => 'required',
        //     'livingroom' => 'required',
        //     'bedroom' => 'required',
        //     'bathroom' => 'required',
        //     'kitchen' => 'required',
        //     'balcony' => 'required',
        //     'action' => 'required'   
        // ]);

        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
               //$image->move(public_path('uploads/images/property/house/apartment/'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/apartment/' . $name));
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

        $apartment = new Apartment;
        $apartment->property()->associate($property);
        $apartment->house()->associate($house);
        $apartment->type = $request->input('apartment-type');
        $apartment->livingroom = $request->input('livingroom');
        $apartment->bedroom = $request->input('bedroom');
        $apartment->bathroom = $request->input('bathroom');
        $apartment->kitchen = $request->input('kitchen');
        $apartment->balcony = $request->input('balcony');
        $apartment->save();

        $favorite = new Favorite;
        $favorite->user_id = auth()->id();
        $favorite->property()->associate($property);
        $favorite->house()->associate($house);
        $favorite->apartment()->associate($apartment);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('apartment.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($apartment->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.house.apartment.edit', compact('apartment', 'regions'), array('user' => Auth::user()));
        } else {
            return redirect()->route('apartment.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if ($apartment->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.house.apartment.edit', compact('apartment', 'regions'), array('user' => Auth::user()));
        } else {
            return redirect()->route('apartment.index');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $property = Property::find(request('propertyid'));
        $house = House::find(request('houseid'));
        $apartment = Apartment::find(request('apartmentid'));
        if ($apartment->property->user_id == auth()->id()) {
            if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $image)
           {
               $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
               //$image->move(public_path('uploads/images/property/house/apartment/'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/apartment/' . $name));
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

        $apartment->house()->associate($house);
        $apartment->type = $request->input('apartment-type');
        $apartment->livingroom = $request->input('livingroom');
        $apartment->bedroom = $request->input('bedroom');
        $apartment->bathroom = $request->input('bathroom');
        $apartment->kitchen = $request->input('kitchen');
        $apartment->balcony = $request->input('balcony');
        $apartment->update();
        
        return redirect()->route('apartment.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
        } else {
            return redirect()->route('apartment.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       // Find the apartment by its ID
       $apartment = Room::findOrFail($id);

       // Check if the apartment has an associated property
       if ($apartment->favorite) {
           // Delete the associated property first
           $apartment->favorite->delete();
       }

       // Delete the apartment record
       $apartment->delete();

       // Return a response
       return redirect()->route('apartment.index');
    }
}
