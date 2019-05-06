<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function index($search){
        $mytime = Carbon::now();

        $slides=SlideShowModel::orderBy('order')->limit(20)->get();
        $cats=CategoryModel::orderBy('order')->get();
        $latest_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))
            ->where('name','LIKE',"%{$search}%")
            ->orderBy('id','DESC')
            ->paginate(8);

        $per_page=8;

        $paginate='false';
        $pro_count=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))
            ->where('name','LIKE',"%{$search}%")->count();
        if ($pro_count>8){
            $paginate='true';
        }

        $count_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))->get();
        $data=array(
            'slides'=>$slides,
            'cats'=>$cats,
            'latest_pro'=>$latest_pro,
            'per_page'=>$per_page,
            'paginate'=>$paginate,
            'count_pro'=>$count_pro,
        );

        return view('category.index',$data);
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->passes()) {

            return response()->json(['verify'=>'true',
                'search'=>$request->search
            ]);
        }

        return ['errors' => $validator->errors(),
            'data'=>$request->all()
        ];
    }
}
