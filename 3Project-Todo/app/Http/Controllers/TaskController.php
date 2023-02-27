<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    public function index()
    {
        return view('backend.tasks.index');
    }

    public function create()
    {
        return view('backend.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'due_date'=>'required',
            'description'=>'required',
            'image' => 'file|max:2048',
        ],[
            'name.required' => 'Please enter a name',
            'status.required' => 'Please Select Status',
            'due_date.required' => 'Enter Due Date',
            'description.required' => 'Type Description...',
            'image.max' => 'Upload Less then 2MB',
        ]);

        $newID = Tasks::insertGetId([
            'name'=>$request->name,
            'status'=>$request->status,
            'start_from'=>$request->start_from,
            'due_date'=>$request->due_date,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);


        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
            $path = base_path('public/uploads/tasks/' . $filename);
            Image::make($image)->fit(1000, 1000)->save($path);

            Tasks::find($newID)->update([
                'image'=>$filename,
            ]);
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been saved successfully!');
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $data = Tasks::where('id','=',$id)->first();
        return view('backend.tasks.edit',[
            'data'=>$data,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
            'due_date'=>'required',
            'description'=>'required',
            'image' => 'file|max:2048',
        ],[
            'name.required' => 'Please enter a name',
            'status.required' => 'Please Select Status',
            'due_date.required' => 'Enter Due Date',
            'description.required' => 'Type Description...',
            'image.max' => 'Upload Less then 2MB',
        ]);

        Tasks::where('id','=',$request->id)->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'start_from'=>$request->start_from,
            'due_date'=>$request->due_date,
            'description'=>$request->description,
        ]);

        $product = Tasks::where('id','=',$request->id)->first();
        $product_img = base_path('public/uploads/tasks/'.$product->image);
        if ($product) {
            if($request->hasFile('image'))
            {
                if(File::exists($product_img)) {
                    File::delete($product_img);
                }
                $image = $request->file('image');
                $filename = Str::slug($request->name).rand(111,999).'.' . $image->getClientOriginalExtension();
                $path = base_path('public/uploads/tasks/' . $filename);
                Image::make($image)->fit(1000, 1000)->save($path);

                Tasks::where('id','=',$request->id)->update([
                    'image'=>$filename,
                ]);
            }
        }

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been update successfully!');
        return redirect()->route('tasks.index');
    }

    public function destroy(Request $request)
    {
        $product = Tasks::where('id', $request->id)->first();
        $img_path = base_path('public/uploads/tasks/'.$product->image);
        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoData()
    {
        $data = [];
        $getData = Tasks::all();
        foreach ($getData as $value) {
            $data[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'status'=>$value->status,
                'start_from'=>$value->start_from,
                'due_date'=>$value->due_date,
                'description'=>$value->description,
                'image'=>$value->image,
            ];
        }
        return $data;
    }
}
