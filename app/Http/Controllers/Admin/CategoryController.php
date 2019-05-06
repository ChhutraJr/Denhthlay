<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\ProductImageModel;
use App\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $cats=CategoryModel::orderBy('order')->get();
        $data=array(
            'cats'=>$cats,
        );


        return view('admin.category.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:category,name',
            'slug' => 'required|max:100|unique:category,slug',
            'image'=>'required|mimes:jpeg,png'
        ]);

        //If input is right
        if ($validator->passes()) {

            $path='';
            if ($request->file('image')!=null){
                $path=$request->file('image')->store('category');
            }

            $order=0;
            $count=CategoryModel::all()->count();
            if ($count!=0){
                $order=$last_cat=CategoryModel::orderBy('order','DESC')->first()->order;
            }

            //Add user to database
            $cat =new CategoryModel();
            $cat->name=$request->name;
            $cat->slug=$request->slug;
            $cat->image=$path;
            $cat->order=$order+1;
            $cat->save();


            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'Category');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $cat=CategoryModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'image'=>'mimes:jpeg,png'
        ]);

        if ($cat->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:category,name',
                'slug' => 'required|max:100',
                'image'=>'mimes:jpeg,png'
            ]);
        }

        if ($cat->slug!=$request->slug){
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:100|unique:category,slug',
                'name' => 'required|max:100',
                'image'=>'required|mimes:jpeg,png'
            ]);
        }

        //If input is right
        if ($validator->passes()) {
            $path=$cat->image;
            if ($request->file('image')!=null){
                Storage::delete($cat->image);
                $path=$request->file('image')->store('category');
            }

            CategoryModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$path,
            ]);

            Session::flash('message', $cat->name.' have been updated !');
            Session::flash('title', 'Category');
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

        $pro=ProductModel::where('cat_id',$id)->get();
        foreach ($pro as $item){
            Storage::delete($item->image);
        }

        ProductModel::where('cat_id',$id)->delete();

        $cat= CategoryModel::find($id);

        Storage::delete($cat->image);

        CategoryModel::where('id',$id)->delete();
        Session::flash('message', $cat->name.' have been deleted !');
        Session::flash('title', 'Category');
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
        CategoryModel::where('order',$new_order)->update(['order'=>$order]);
        CategoryModel::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }

}
