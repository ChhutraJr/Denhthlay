<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\SlideShowModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()){
            return redirect()->back();
        }
        return view('admin.login');
    }


    public function logout(){
        Auth::logout();
        return redirect('system');
    }

    public function auth(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password'=>'required|min:6|max:15',
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Authentication passed...
                //return redirect('system/products');
                return ['verify' => 'true'];
            }else{
                return ['verify' => 'false'];
                //return redirect()->back()->with('msg',"Your Email or Password is incorrect !");
            }
        }

        return ['errors' => $validator->errors()];

    }
}
