<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\HistoryAuctionModel;
use App\ProductModel;
use App\SlideShowModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index($key)
    {
        $mytime = Carbon::now();
        $slides = SlideShowModel::orderBy('order')->get();

        $product=ProductModel::where('gen_key',$key)->first();
        $cats=CategoryModel::orderBy('order')->get();
        $auctions=HistoryAuctionModel::where('pro_id',$product->id)->orderBy('id','DESC')->limit(3)->get();
        $count_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))->get();
        $data = array(
            'slides' => $slides,
            'product' => $product,
            'cats' => $cats,
            'auctions' => $auctions,
            'count_pro' => $count_pro,
        );

        ProductModel::where('gen_key',$key)
            ->update(['view'=>$product->view+1]);
        return view('product.index', $data);
    }

    public function auction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:12|max:13',
            'price' => 'required|max:21',
        ]);
        $df_price=$request->price;
        $price=str_replace(',','',$request->price);

        if ($validator->passes()) {
            $count_vote=HistoryAuctionModel::where('pro_id',$request->pro_id)->count();
            if ($count_vote!=0){
                $last_vote=HistoryAuctionModel::where('pro_id',$request->pro_id)
                    ->orderBy('id','DESC')->first();

                if ($price<=$last_vote->price){
                    return response()->json(['price'=>'false',
                    ]);
                }
            }else{
                $df_pro=ProductModel::where('id',$request->pro_id)->first();
                if ($price<=$df_pro->price){
                    return response()->json(['price'=>'false',
                    ]);
                }
            }


            $tel1=str_replace(array(')', '-'), ' ', $request->phone);
            $tel2=str_replace('(','',$tel1);


            $auction=new HistoryAuctionModel();
            $auction->phone=$tel2;
            $auction->price=$price;
            $auction->pro_id=$request->pro_id;
            $auction->save();


            $pro=ProductModel::where('id',$request->pro_id)->first();
            return response()->json(['verify'=>'true',
                'price'=>$df_price,
                'pro_name'=>$pro->name,
                'image'=>$pro->image,
                'key'=>$pro->gen_key,
            ]);

        }

        return ['errors' => $validator->errors()];
    }
}
