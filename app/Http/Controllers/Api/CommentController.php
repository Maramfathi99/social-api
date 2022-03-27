<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request){
        //`text`, `user_id` `post_id`,

        $val= Validator :: make($request->all(),[
            'text'=> 'required',
            'user_id'=> 'required|exists:users,id',
            'post_id'=>'required|exists:posts,id'

        ]);
        if($val->fails()){
            return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $comment=  new Comment();
        $comment-> text =$request -> get('text');
        $comment-> user_id=$request -> get('user_id');
        $comment-> post_id=$request -> get('post_id');
        $comment->save();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$comment]);
    }

    public function getComment(Request $request ,$comment_id){

        if(isset($comment_id)) {
            $comment = Comment::find($comment_id);
            return Response()->json(['status' => false, 'Message' => trans('admin.success'), 'items' => $comment]);
        }
    }
    public function editComment(Request $request,$id){
        $val= Validator :: make($request->all(),[
            'text'=> 'required',
            'user_id'=> 'required',
            'post_id'=>'required'

        ]);
        if($val->fails()){
            return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $comment=  Comment::find($id);
        $comment-> text =$request -> get('text');
        $comment-> user_id=$request -> get('user_id');
        $comment-> post_id=$request -> get('post_id');
        $comment->save();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$comment]);

    }

    public function  deleteComment(Request $request ){
        $comment = Comment::find($request->get('comment_id'));
        if (isset($comment)){
            $comment->delete();
            return Response()->json(['status'=>true,'Message'=>trans('admin.success')]);
        }
        return Response()->json(['status'=>false,'Message'=>trans('admin.error')]);
    }

}
