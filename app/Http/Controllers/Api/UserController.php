<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function getUser($user_id =null)
    {
        if(isset($user_id))
            $user = User::find($user_id);
        else
            $user= auth()->user();
        return Response()->json(['status'=>true,'Message'=>trans('admin.success'),'items'=>$user]);

    }

    public function  postUser(Request $request){

        $val=Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

        ]);
        if ($val->fails()){
            return Response()->json(['status'=>false,'Message'=>trans('admin.error'),'items'=>$val->errors()]);
        }

        $user =new User();

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=bcrypt( $request->get('password'));
        $user->save();
        return Response()->json(['status'=>true,'Message'=>trans('admin.success'),'items'=>$user]);
    }
    public function  putUser(Request $request){

        $val=Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. auth()->user()->id,
            'password' => 'required|min:6',

        ]);
        if ($val->fails()){
            return Response()->json(['status'=>false,'Message'=>trans('admin.error'),'items'=>$val->errors()]);
        }
        $user = auth()->user();
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=bcrypt( $request->get('password'));
        $user->save();
        return Response()->json(['status'=>true,'Message'=>trans('admin.success'),'items'=>$user]);
    }

    public function  deleteUser(Request $request ){
        $user = User::find($request->get('user_id'));
        if (isset($user)){
            $user->delete();
            return Response()->json(['status'=>true,'Message'=>trans('admin.success')]);
        }
        return Response()->json(['status'=>false,'Message'=>trans('admin.error')]);
    }

    public function profile($id=null){
        $user = (isset($id))? User::find($id) : auth()->user();
        return response()-> json(['status'=>true,'message'=>trans('admin.success'),'items'=>$user]);

    }
}
