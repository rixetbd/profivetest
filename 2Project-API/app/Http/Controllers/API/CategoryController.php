<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        if (count($data) > 0) {
            return response()->json([
                'data'=>$data,
                'status'=>'success',
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'No Data Found',
            ], 404);
        }
    }

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

        if ($newID) {
            return response()->json([
                'status'=>'success',
                'message'=>'Insert Successfully',
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'No Data Found',
            ], 404);
        }
    }

    public function show($id)
    {
        $data = Category::find($id);
        if ($data) {
            return response()->json([
                'data'=>$data,
                'status'=>'success',
            ], 200);
        }else{
            return response()->json([
                'status'=>'Nothing Found',
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $update = Category::find($id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        if ($update) {
            return response()->json([
                'status'=>'success',
                'message'=>'Update Successfully',
            ], 200);
        }else{
            return response()->json([
                'status'=>'Store Failed',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        if ($category) {
            return response()->json([
                'status'=>'success',
                'message'=>'Delete Successfully',
            ], 200);
        }else{
            return response()->json([
                'status'=>'errors',
            ], 404);
        }
    }
}
