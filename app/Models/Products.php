<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $dateFormat = 'U';


    function categories(){
        return $this->belongsTo('App\Models\Categories','id_category');
    }

    function brands(){
        return $this->belongsTo('App\Models\Brands','id_brand');
    }

    function comments(){
        return $this->hasMany('App\Models\Comments','id_product');
    }


    protected $fillable = [
        'id_category',
        'id_brand',
        'name_product',
        'image1',
        'image2',
        'image3',
        'image4',
        'price',
        'quantity',
        'lenght',
        'weight',
        'height',
        'description',
        'like',
        'old_price'
    ];
    
}
