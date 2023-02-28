<?php

namespace App\Http\Controllers;

use App\Models\TaskAssign;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    public function index()
    {
        $data = Tasks::all();
        return view('backend.tasks.index',[
            'data'=>$data,
        ]);
    }

    public function create()
    {
        return view('backend.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'due_date'=>'required',
            'description'=>'required',
        ],[
            'name.required' => 'Please enter a name',
            'due_date.required' => 'Enter Due Date',
            'description.required' => 'Type Description...',
        ]);

        $newID = Tasks::insertGetId([
            'name'=>$request->name,
            'start_from'=>$request->start_from,
            'due_date'=>$request->due_date,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);

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
            'start_from'=>'required',
            'due_date'=>'required',
            'description'=>'required',
        ],[
            'name.required' => 'Please enter a name',
            'due_date.required' => 'Enter Due Date',
        ]);

        Tasks::where('id','=',$request->id)->update([
            'name'=>$request->name,
            'start_from'=>$request->start_from,
            'due_date'=>$request->due_date,
        ]);

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been update successfully!');
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        Tasks::where('id', $id)->delete();
        notyf()
        ->addSuccess('Delete successfully!');
        return back();
    }

    public function status(Request $request)
    {
        Tasks::where('id', $request->id)->update([
            'status'=>$request->status,
        ]);

        return response()->json([
            'success'=>'success',
        ]);
    }

    public function assign ($id)
    {
        $data = Tasks::where('id', $id)->first();
        $user = User::all();

        return view('backend.tasks.show',[
            'data'=>$data,
            'user'=>$user,
        ]);
    }

    public function assigntousers(Request $request){


        foreach ($request->users as $value) {
            TaskAssign::insert([
                'task_id'=> $request->tasks,
                'user_id'=> $value,
                'created_at'=>Carbon::now(),
            ]);
        }

        return $request->all();
    }

}
