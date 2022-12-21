<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WatchController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $watches = Watch::orderBy('id', 'desc')->with('category')->paginate(2);
        return view('watch.index', compact('watches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('watch.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
            'category_id' => 'required'

        ]);

        $file = $request->file('image');
        $file_name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        Watch::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $file_name,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Watch created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $watch = Watch::where('id', $id)->with('category')->first();
        return view('watch.edit', compact('categories', 'watch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        // Category::where('id', $id)->update([
        //     'name' => $request->name
        // ]);
        $watch = Watch::where('id', $id);
        if($request->hasFile('image')){
            $filepath = public_path('/images/'.$watch->first()->image);
            unlink($filepath);
            
            $file = $request->file('image');
            $file_name = uniqid().$file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
           
        }else{
            $file_name = $watch->first()->image;
        }

        $watch->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $file_name,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Watch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $watch = Watch::find($id);
        $filepath = public_path('/images/'.$watch->image);
        unlink($filepath);
        $watch->delete();
        return redirect()->back()->with('success', 'Watch deleted successfully');
    }
}
