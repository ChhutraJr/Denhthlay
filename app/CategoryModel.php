<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table ='category';

    public function pro(){
        return $this->hasMany('App\ProductModel','cat_id','id');
    }
}
