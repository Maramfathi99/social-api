<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Favourite;
//use App\Models\User;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addPost(Request $request){
        //`text`, `user_id`,

        $val= Validator :: make($request->all(),[
            'text'=> 'required',
            'user_id'=> 'required|exists:users,id'

        ]);
        if($val->fails()){
            return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $post=  new Post();
        $post-> text =$request -> get('text');
        $post-> user_id=$request -> get('user_id');
        $post->save();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$post]);
    }
    public function getPost(Request $request ,$post_id){

        if(isset($post_id)) {
            $post = Post::find($post_id);
            return Response()->json(['status' => false, 'Message' => trans('admin.success'), 'items' => $post]);
        }
//    else
//        return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);

    }



    public function editPost(Request $request,$id){
        $val= Validator :: make($request->all(),[
            'text'=> 'required',
            'user_id'=> 'required'

        ]);
        if($val->fails()){
            return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $post=  Post::find($id);
        $post-> text =$request -> get('text');
        $post-> user_id=$request -> get('user_id');
        $post->save();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$post]);

    }
    public function  deletePost(Request $request ){
        $post = Post::find($request->get('post_id'));
        if (isset($post)){
            $post->delete();
            return Response()->json(['status'=>true,'Message'=>trans('admin.success')]);
        }
        return Response()->json(['status'=>false,'Message'=>trans('admin.error')]);
    }
    public function timeLine(Request $request){
        $limit = 10 ;
        $currentPage = $request->currentPage;
        $count = Post::count();

        $offset = ($currentPage - 1) * $limit;
        $numberOfPages = (int) ceil($count / $limit);
        // return response()->json($numberOfPages );

        $data = Post::skip($offset)->take($limit)->get();

        return response()->json($data);
    }
    public function favouritePost($id = null){

        if(isset($id)) {
            $favourite = Favourite::with('Posts')->get()->first();
            $users = User::with('Posts')->get();
        }
        else{
            $favourite= Favourite::where('user_id',Auth::user()->id )->get()->first();
        return response()->json(['status'=>true,'message'=> trans('admin.success'),'items'=>$favourite]);

    }}
}
