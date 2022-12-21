<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showCategory()
    {
        $categories = Category::all();
        return response()->json(['success'=>true, 'data'=>$categories]);
    }

    public function showWatch(Request $request)
    {
        // $watches = Watch::orderBy('id', 'desc')->with('category')->paginate(6);
        $watches = Watch::orderBy('id', 'desc');
        if($request->category_id){
            $watches->where('category_id', $request->category_id);
        }
        $watches = $watches->with('category')->paginate(2);
        return response()->json(['success'=>true, 'data'=>$watches]);
    }
}
