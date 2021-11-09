<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'variation_id','category_id','name','price','img','stock', 'stock_left_items',
        'short_description','long_description','specification','product_link','author',
        'rating','feedback','sale_price_date'

    ];


    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function variation()
    {
        return $this->hasMany(Variation::class);
    }

   
   

}
