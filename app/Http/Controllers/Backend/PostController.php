<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('admin.blog.index', [
            'posts' => Post::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = request()->image;
        $name = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1280,876)->save(\public_path('/uploads/images/blog/' . $name)); 

        $user = auth()->id();
        $post = new Post;
        $post->user()->associate($user);
        $post->title = $request->input('title');
        $post->short = $request->input('short');
        $post->content = $request->input('content');
        $post->image = $name;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Post created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function postActivate(Request $request){
        $post_id = $request->post_id;

        // check whether activate or de-activate
        if ($request->current_status == "1"){
            return $this->postDeActivate($post_id);
        }

        try {
            $agent = Post::findOrFail($post_id);
            $agent->update(['status' => 1]);

            return dd('success', 'Post activated successfully');
        }catch (ModelNotFoundException $exception){
            return dd('error', 'Failed to activate this post, try again');
        }
    }

    public function postDeActivate(int $post_id){

        try {
            Post::findOrFail($post_id)->update(['status' => 0]);
            return message('success', 'Post deactivated successfully');
        }catch (ModelNotFoundException $exception){
            return redirect()->back()->with('error', 'Failed to deactivate this post, try again');
        }
    }
}
