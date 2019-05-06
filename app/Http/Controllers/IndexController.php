<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $mytime = Carbon::now();

        $slides=SlideShowModel::orderBy('order')->limit(20)->get();
        $cats=CategoryModel::orderBy('order')->get();

        $finish_pro=ProductModel::where('end_date','<',$mytime->format('Y-m-d H:i:s'))
            ->orderBy('end_date','DESC')
            ->limit(4)->get();

        $latest_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))
            ->orderBy('id','DESC')
            ->limit(16)->get();

        $count_pro=ProductModel::where('end_date','>',$mytime->format('Y-m-d H:i:s'))->get();
        $data=array(
            'slides'=>$slides,
            'cats'=>$cats,
            'finish_pro'=>$finish_pro,
            'latest_pro'=>$latest_pro,
            'count_pro'=>$count_pro,
        );

        return view('index',$data);
    }
}
