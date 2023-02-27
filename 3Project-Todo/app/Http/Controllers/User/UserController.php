<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index');
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ],[
            'name.required' => 'Please enter a name',
            'email.required' => 'Please enter a email',
            'password.required' => 'Please enter a password',
        ]);

        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        notyf()
        // ->duration(2000)
        ->addSuccess('Data has been saved successfully!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();
        return response()->json(['success' => 'success',]);
    }

    public function autoData()
    {
        $data = [];
        $getData = User::where('id','!=', Auth::user()->id)->get();
        foreach ($getData as $value) {
            $data[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'email'=>$value->email,
            ];
        }
        return $data;
    }
}
