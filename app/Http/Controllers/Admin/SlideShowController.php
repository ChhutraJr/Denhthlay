<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\SlideShowModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SlideShowController extends Controller
{
    public function index(){
        $slide_show=SlideShowModel::orderBy('order')->get();
        $data=array(
            'slide_show'=>$slide_show,
        );

        return view('admin.slide_show.index',$data);
    }

    public function store(Request $request){


        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:slideshow,name',
            'image'=>'required|mimes:jpeg,png'
        ]);

        //If input is right
        if ($validator->passes()) {

            $path='';
            if ($request->file('image')!=null){
                $path=$request->file('image')->store('slideshow');
            }

            $order=0;
            $count=SlideShowModel::all()->count();
            if ($count!=0){
                $order=$last_slide=SlideShowModel::orderBy('order','DESC')->first()->order;
            }

            //Add user to database
            $slideshow =new SlideShowModel();
            $slideshow->name=$request->name;
            $slideshow->image=$path;
            $slideshow->order=$order+1;
            $slideshow->save();


            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'Slideshow');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $slide=SlideShowModel::where('id',$request->update_id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'image'=>'mimes:jpeg,png'
        ]);

        if ($slide->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:slideshow,name',
                'image'=>'mimes:jpeg,png'
            ]);
        }

        //If input is right
        if ($validator->passes()) {


            $path=$slide->image;
            if ($request->file('image')!=null){
                Storage::delete($slide->image);
                $path=$request->file('image')->store('slideshow');
            }

            SlideShowModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
                'image'=>$path,
            ]);

            Session::flash('message', $slide->name.' have been updated !');
            Session::flash('title', 'Slideshow');
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
        $slide= SlideShowModel::find($id);

        Storage::delete($slide->image);

        SlideShowModel::where('id',$id)->delete();
        Session::flash('message', $slide->name.' have been deleted !');
        Session::flash('title', 'Slideshow');
        Session::flash('alert-type', 'error');
        return back();
    }

    public function order($id,$order,$mode){

        if ($mode=='down'){
            $new_order=$order+1;
        }else{
            $new_order=$order-1;
        }

        //$parent_id= CategoriesModel::find($id)->parent_id;
        SlideShowModel::where('order',$new_order)->update(['order'=>$order]);
        SlideShowModel::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }

}
