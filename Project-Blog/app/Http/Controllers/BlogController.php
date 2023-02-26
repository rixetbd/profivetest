<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        return view('frontend.products.product');
    }

    public function create()
    {
        $category = Category::all();
        return view('frontend.products.create',[
            'category'=>$category,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'p_code'=>'required',
            'quantity'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'description'=>'required',
            'image' => 'file|max:2048',
        ],[
            'name.required' => 'Please enter a name',
            'category_id.required' => 'Please select a category',
            'p_code.required' => 'Enter Product Code',
            'quantity.required' => 'Enter Product Quantity',
            'buying_price.required' => 'Enter Buying Price',
            'selling_price.required' => 'Enter Selling Price',
            'description.required' => 'Type Description...',
            'image.max' => 'Upload Less then 2MB',
        ]);

        $newID = Blog::insertGetId([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'p_code'=>$request->p_code,
            'quantity'=>$request->quantity,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);


        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
            $path = base_path('public/uploads/product/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);

            Blog::find($newID)->update([
                'image'=>$filename,
            ]);
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been saved successfully!');
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $category = Category::all();
        $data = Blog::where('id','=',$id)->first();
        return view('frontend.products.edit',[
            'category'=>$category,
            'data'=>$data,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'p_code'=>'required',
            'quantity'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'description'=>'required',
        ]);

        Blog::where('id','=',$request->id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'p_code'=>$request->p_code,
            'quantity'=>$request->quantity,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'description'=>$request->description,
        ]);

        $product = Blog::where('id','=',$request->id)->first();
        $product_img = base_path('public/uploads/product/'.$product->image);
        if ($product) {
            if($request->hasFile('image'))
            {
                if(File::exists($product_img)) {
                    File::delete($product_img);
                }
                $image = $request->file('image');
                $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
                $path = base_path('public/uploads/product/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                Blog::where('id','=',$request->id)->update([
                    'image'=>$filename,
                ]);
            }
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been update successfully!');
        return redirect()->route('product.index');
    }

    public function destroy(Request $request)
    {
        $product = Blog::where('id', $request->id)->first();
        $img_path = base_path('public/uploads/product/'.$product->image);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return response()->json(['success' => 'success',]);
    }
    
}
