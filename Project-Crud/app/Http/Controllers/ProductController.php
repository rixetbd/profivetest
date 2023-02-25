<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
        ]);

        $newID = Product::insertGetId([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'p_code'=>$request->p_code,
            'quantity'=>$request->quantity,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'description'=>$request->description,
        ]);


        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = Str::slug($request->name).'.' . $image->getClientOriginalExtension();
            $path = base_path('public/uploads/product/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);

            Product::find($newID)->update([
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
        $data = Product::where('id','=',$id)->first();
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

        Product::where('id','=',$request->id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'p_code'=>$request->p_code,
            'quantity'=>$request->quantity,
            'buying_price'=>$request->buying_price,
            'selling_price'=>$request->selling_price,
            'description'=>$request->description,
        ]);

        $product = Product::where('id','=',$request->id)->first();
        $product_img = base_path('public/uploadsproduct/'.$product->image);
        if ($product) {
            if($request->hasFile('image'))
            {
                if(File::exists($product_img)) {
                    File::delete($product_img);
                }
                $image = $request->file('image');
                $filename = Str::slug($request->name).'.' . $image->getClientOriginalExtension();
                $path = base_path('public/uploads/product/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                Product::where('id','=',$request->id)->update([
                    'image'=>$filename,
                ]);
            }
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been saved successfully!');
        return redirect()->route('product.index');
    }

    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $img_path = base_path('public/uploads/product/'.$product->image);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoData()
    {
        $data = [];
        $getData = Product::all();
        foreach ($getData as $value) {
            $data[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'p_code'=>$value->p_code,
                'buying_price'=>$value->buying_price,
                'category_id'=>$value->getCategory->name,
                'quantity'=>$value->quantity,
                'image'=>$value->image,
            ];
        }
        return $data;
    }
}
