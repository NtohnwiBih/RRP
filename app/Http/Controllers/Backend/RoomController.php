<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Property;
use App\Models\House;
use App\Models\Room;
use App\Models\Favorite;
use App\Models\Region;
use Image;
use Auth;
use Illuminate\Console\View\Components\Alert;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('house')->latest()->paginate(10);
        return view('admin.property.house.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.property.house.room.create', compact('regions'));
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
               //$image->move(public_path('uploads/images/property/house/room/'), $name);
               Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/room/' . $name));
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

        $room = new Room;
        $room->property()->associate($property);
        $room->house()->associate($house);
        $room->type = $request->input('room-type');
        $room->bathroom = $request->input('bathroom');
        $room->kitchen = $request->input('kitchen');
        $room->balcony = $request->input('balcony');
        $room->save();

        $favorite = new Favorite;
        $favorite->user_id = auth()->id();
        $favorite->property()->associate($property);
        $favorite->house()->associate($house);
        $favorite->room()->associate($room);
        $favorite->action = $request->input('action');
        $favorite->save();

        return redirect()->route('room.index')->with(['status'=>'success','message'=>'House added successfully!!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('house.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if ($room->property->user_id == auth()->id()) {
            $regions = Region::all();
            return view('admin.property.house.room.edit', compact('room', 'regions'), array('user' => Auth::user()));
        } else {
            return redirect()->route('room.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::find(request('propertyid'));
        $house = House::find(request('houseid'));
        $room = Room::find(request('roomid'));
        
        if ($room->property->user_id == auth()->id()) {
            if ($request->hasfile('filename')) {

                foreach ($request->file('filename') as $image) {
                    $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    //$image->move(public_path('uploads/images/property/house/room/'), $name);
                    Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/property/house/room/' . $name));
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

            $room->property()->associate($property);
            $room->house()->associate($house);
            $room->type = $request->input('room-type');
            $room->bathroom = $request->input('bathroom');
            $room->kitchen = $request->input('kitchen');
            $room->balcony = $request->input('balcony');
            $room->update();

            return redirect()->route('room.index')->with('message', 'Your property has been successfully updated!');
        } else {
            return redirect()->route('room.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       // Find the room by its ID
       $room = Room::findOrFail($id);

       // Check if the room has an associated property
       if ($room->favorite) {
           // Delete the associated property first
           $room->favorite->delete();
       }

       // Delete the room record
       $room->delete();

       // Return a response
       return redirect()->route('room.index');
    }
}
