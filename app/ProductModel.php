<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table ='products';

    public function pictures(){
        return $this->hasMany('App\ProductImageModel','pro_id','id');
    }

    public function cat(){
        return $this->belongsTo('App\CategoryModel','cat_id','id');
    }

    public function auctions(){
        return $this->hasMany('App\HistoryAuctionModel','pro_id','id');
    }
}
