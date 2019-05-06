<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\ContactModel;
use App\ProductImageModel;
use App\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        $cons=ContactModel::orderBy('id','DESC')->get();
        $data=array(
            'cons'=>$cons,
        );

        return view('admin.contact.index',$data);
    }

    public function delete(Request $request){
        $id=$request->delete_id;

        $con=ContactModel::where('id',$id)->first();
        ContactModel::where('id',$id)->delete();

        Session::flash('message', $con->name.' have been deleted !');
        Session::flash('title', 'Contact');
        Session::flash('alert-type', 'error');
        return back();
    }

}
