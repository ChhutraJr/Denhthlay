<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users=User::all();

        $data=array(
            'users'=>$users,
        );

        return view('admin.users.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100|unique:users,name',
            'email' => 'required|max:100|unique:users,email',
            'password'=>'required|min:8|max:15',
            'confirm_password' => 'required|min:8|max:15|same:password',
            'profile'=>'mimes:jpeg,png'
        ]);

        //If input is right
        if ($validator->passes()) {

            $path='profile\avatar\user.png';
            if ($request->file('profile')!=null){
                $path=$request->file('profile')->store('profile/avatar');
            }

            //Add user to database
            $user =new User();
            $user->name=$request->username;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->profile=$path;
            $user->save();


            Session::flash('message', $request->username.' have been added !');
            Session::flash('title', 'User');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
                'name'=>$request->username,
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){

        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100',
            'profile'=>'mimes:jpeg,png'
        ]);

        $current_user=User::where('id',$request->update_id)->first();
        if ($current_user->name!=$request->username){
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:100|unique:users,name',
                'profile'=>'mimes:jpeg,png',
            ]);
        }

        $pass=$current_user->password;
        if (!empty($request->old_password)||!empty($request->new_password)||!empty($request->confirm_password)){
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:100',
                'old_password' => 'required|min:8|max:15',
                'new_password'=>'required|min:8|max:15',
                'confirm_password' => 'required|min:8|max:15|same:new_password',
                'profile'=>'mimes:jpeg,png',
            ]);

            //Check old password
            if (!Hash::check($request->old_password,$current_user->password)){
                $validator = Validator::make($request->all(), [
                    'username' => 'required|max:100',
                    'old_password' => 'required|min:8|max:15',
                    'new_password'=>'required|min:8|max:15',
                    'confirm_password' => 'required|min:8|max:15|same:new_password',
                    'profile'=>'mimes:jpeg,png',
                ]);

                if (!$validator->passes()){
                    return ['errors' => $validator->errors()];
                }

                return ['wrong_pass' => 'true'];
            }

            $pass=bcrypt($request->new_password);
        }

        //If input is right
        if ($validator->passes()) {

            $path=$current_user->profile;
            if ($request->file('profile')!=null){
                if ($current_user->profile!='profile\avatar\user.png'){
                    Storage::delete($path);
                }
                $path=$request->file('profile')->store('profile/avatar');

            }

            User::where('id',$request->update_id)->update([
                'name'=>$request->username,
                'password'=>$pass,
                'profile'=>$path,
            ]);


            Session::flash('message', $current_user->name.' have been updated !');
            Session::flash('title', 'User');
            Session::flash('alert-type', 'success');

            //Send value back to view
            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function delete(Request $request){
        $id=$request->delete_id;
        $user= User::find($id);
        if ($user->profile!='profile\avatar\user.png'){
            Storage::delete($user->profile);
        }

        User::where('id',$id)->delete();
        Session::flash('message', $user->name.' have been deleted !');
        Session::flash('title', 'User');
        Session::flash('alert-type', 'error');
        return back();
    }
}
