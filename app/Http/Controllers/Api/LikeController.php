<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function addLike(Request $request){

        // `user_id`, `type`, `type_id`
        $val= Validator :: make($request->all(),[
            'type'=> 'required',
            'user_id'=> 'required',
            'type_id'=> 'required'
        ]);
        if($val->fails()){
            return response()-> json(['status'=>false,'message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $like=  new Like();
        //dd($request->all());
        $like-> type =$request -> get('type');
        $like-> user_id=$request -> get('user_id');
        $like->type_id =$request -> get('type_id');
        $like->save();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$like]);
    }
    public function  deleteLike(Request $request ){
        $like = Like::find($request->get('like_id'));
        if (isset($like)){
            $like->delete();
            return Response()->json(['status'=>true,'Message'=>trans('admin.success')]);
        }
        return Response()->json(['status'=>false,'Message'=>trans('admin.error')]);
    }

}
