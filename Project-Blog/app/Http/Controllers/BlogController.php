<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        return view('backend.frontend.index');
    }

    public function create()
    {
        return view('backend.blog.create');
    }

    public function store(Request $request)
    {
        $newID = Blog::insertGetId([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'category'=>$request->category,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);


        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
            $path = base_path('public/uploads/blog/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);

            Blog::find($newID)->update([
                'image'=>$filename,
            ]);
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been saved successfully!');
        return redirect()->route('frontend.index');
    }

    public function edit($id)
    {
        $category = Category::all();
        $data = Blog::where('id','=',$id)->first();
        return view('backend.blog.edit',[
            'category'=>$category,
            'data'=>$data,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);

        Blog::where('id','=',$request->id)->update([
            'name'=>$request->name,
            'category'=>$request->category,
            'description'=>$request->description,
        ]);

        $product = Blog::where('id','=',$request->id)->first();
        $product_img = base_path('public/uploads/blog/'.$product->image);
        if ($product) {
            if($request->hasFile('image'))
            {
                if(File::exists($product_img)) {
                    File::delete($product_img);
                }
                $image = $request->file('image');
                $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
                $path = base_path('public/uploads/blog/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                Blog::where('id','=',$request->id)->update([
                    'image'=>$filename,
                ]);
            }
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been update successfully!');
        return redirect()->route('frontend.index');
    }

    public function destroy(Request $request)
    {
        $product = Blog::where('id', $request->id)->first();
        $img_path = base_path('public/uploads/blog/'.$product->image);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return response()->json(['success' => 'success',]);
    }

}
