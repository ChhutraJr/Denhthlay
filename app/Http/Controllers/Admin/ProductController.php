<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\HistoryAuctionModel;
use App\ProductModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products=ProductModel::orderBy('id','DESC')->get();
        $cats=CategoryModel::orderBy('order')->get();

       // $mytime = Carbon::now();

      //  dd($mytime->format('Y-d-m'));


        $data=array(
            'products'=>$products,
            'cats'=>$cats,
        );

        return view('admin.product.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'category' => 'required',
            'price' => 'required|max:21',
            'end_date' => 'required',
            'end_time' => 'required',
            'description' => 'required|max:5000',
            'delivery_info' => 'required|max:5000',
            'image'=>'required|mimes:jpeg,png',
        ]);

        $mytime = Carbon::now();
        $end_date = date('Y-m-d'.' '.$request->end_time.':00', strtotime($request->end_date));

        //If input is right
        if ($validator->passes()) {


            if ($end_date<$mytime->format('Y-m-d H:i:s')){
                return response()->json(['date'=>'false',
                ]);
            }

            while (true){
                $generate_id = rand(00000, 999999);

                $data=ProductModel::where('gen_key',$generate_id)->count();

                if ($data==0) {
                    $price=str_replace(',','',$request->price);
                    $path=$request->file('image')->store('products');

                    //Add product to database
                    $pro =new ProductModel();
                    $pro->name=$request->title;
                    $pro->price=$price;
                    $pro->description=$request->description;
                    $pro->delivery_info=$request->delivery_info;
                    $pro->cat_id=$request->category;
                    $pro->image=$path;
                    $pro->gen_key=$generate_id;
                    $pro->end_date=$end_date;
                    $pro->save();

                    Session::flash('message', $request->title.' have been added !');
                    Session::flash('title', 'Product');
                    Session::flash('alert-type', 'success');

                    return response()->json(['verify'=>'true',
                    ]);
                }

            }

        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function show_update($id){

        $product=ProductModel::where('id',$id)->first();


        $cats=CategoryModel::orderBy('order')->get();

        $data=array(
            'product'=>$product,
            'cats'=>$cats,
        );

        return view('admin.product.update',$data);
    }

    public function update(Request $request){

        $pro=ProductModel::where('id',$request->update_id)->first();
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'category' => 'required',
            'price' => 'required|max:21',
            'end_date' => 'required',
            'end_time' => 'required',
            'description' => 'required|max:5000',
            'delivery_info' => 'required|max:5000',
        ]);

        $mytime = Carbon::now();
        $end_date = date('Y-m-d'.' '.$request->end_time.':00', strtotime($request->end_date));

            //If input is right
        if ($validator->passes()) {
            if ($end_date<$mytime->format('Y-m-d H:i:s')){
                return response()->json(['date'=>'false',
                ]);
            }

            $path=$pro->image;
            if ($request->file('image')!=null){
                Storage::delete($pro->image);
                $path=$request->file('image')->store('products');
            }

            $price=str_replace(',','',$request->price);
            ProductModel::where('id',$request->update_id)
                ->update([
                    'name'=>$request->title,
                    'price'=>$price,
                    'description'=>$request->description,
                    'delivery_info'=>$request->delivery_info,
                    'cat_id'=>$request->category,
                    'image'=>$path,
                    'end_date'=>$end_date,
                    ]);

            Session::flash('message', $pro->name.' have been updated !');
            Session::flash('title', 'Product');
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


        $pro= ProductModel::find($id);
        Storage::delete($pro->image);

        ProductModel::where('id',$id)->delete();
        Session::flash('message', $pro->name.' have been deleted !');
        Session::flash('title', 'Product');
        Session::flash('alert-type', 'error');
        return back();
    }

    public function product_picture(Request $request){
        //dd($request->all());
        if ($request->file('file')!=null){
            $path=$request->file('file')->store('product');
            $pro_images=new ProductImageModel();
            $pro_images->name=$path;
            $pro_images->save();
            return $path;
        }else{
            return "false";
        }
    }

    public function delete_picture(Request $request){

        $pro_image=ProductImageModel::where('pro_id',0)->get();
        foreach ($pro_image as $item){
            Storage::delete($item->name);
        }
        ProductImageModel::where('pro_id',0)->delete();

    }

    public function history($id){

        $history=HistoryAuctionModel::where('pro_id',$id)->orderby('id','DESC')->get();
        $product=ProductModel::where('id',$id)->first();
        $data=array(
            'history'=>$history,
            'product'=>$product,
        );

        return view('admin.product.history',$data);
    }

}
