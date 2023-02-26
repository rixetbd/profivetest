<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.products.category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|unique:categories',
        ]);

        $newID = Category::insertGetId([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'created_at'=>Carbon::now(),
        ]);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
            $path = base_path('public/uploads/category/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);

            Category::find($newID)->update([
                'image'=>$filename,
            ]);
        }

        return response()->json([
            'success'=>'success',
        ]);
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
        //
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
        //
    }

    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $img_path = base_path('public/uploads/category/'.$category->image);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $category->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoData()
    {
        $data = [];
        $getData = Category::all();
        foreach ($getData as $value) {
            $data[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'slug'=>$value->slug,
                'image'=>$value->image,
            ];
        }
        return $data;
    }
}
