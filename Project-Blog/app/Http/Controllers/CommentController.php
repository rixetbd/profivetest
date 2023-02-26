<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'comments'=>'required',
        ],[
            'name.required' => 'Enter your name',
            'comments.required' => 'Type your comment',
        ]);

        Comments::insert([
            'blog_id'=>$request->blog_id,
            'name'=>$request->name,
            'comments'=>$request->comments,
            'parent_comment'=>($request->parent_comment != ''?$request->parent_comment:0),
            'created_at'=>Carbon::now(),
        ]);
        // return response()->json([
        //     'success'=>'success',
        // ]);
            return back();
    }

    public function destroy(Request $request)
    {
        Comments::where('id','=',$request->comment_id)->delete();
        Comments::where('parent_comment','=', $request->comment_id)->delete();
        return response()->json([
            'success'=> 'success',
        ]);
    }

    public function autoData(Request $request)
    {
        $result = Comments::where('blog_id','=',$request->blog)
                            ->where('parent_comment','=', 0)
                            ->orderBY('created_at', 'DESC')->get();
        $data = [];
        foreach ($result as $value) {

            $sub_comment = Comments::where('parent_comment','=', $value->id)
                            ->orderBY('created_at', 'DESC')->get();

            $sub_commentData = [];
            foreach ($sub_comment as $item) {
                $sub_commentData[] = [
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'comments'=>$item->comments,
                    'created_at'=>$item->created_at->diffForHumans(),
                ];
            }

            $data[] = [
                'id'=>$value->id,
                'name'=>$value->name,
                'comments'=>$value->comments,
                'sub_comment'=>$sub_commentData,
                'created_at'=>$value->created_at->diffForHumans(),
            ];
        }


        return response()->json([
            'result'=> $data,
        ]);
    }
}
