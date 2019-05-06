<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug){
        $mytime = Carbon::now();

        $slides=SlideShowModel::orderBy('order')->limit(20)->get();
        $cats=CategoryModel::orderBy('order')->get();
        $cat=CategoryModel::where('slug',$slug)->first();
        $latest_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))
            ->where('cat_id',$cat->id)
            ->orderBy('id','DESC')
            ->paginate(8);

        $per_page=8;

        $paginate='false';
        $pro_count=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))
            ->where('cat_id',$cat->id)->count();
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
}
