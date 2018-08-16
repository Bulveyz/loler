<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    protected $table = 'product_user';
    
    public function scopeIsExistst($product_id)
    {
        return $this->where('user_id', auth()->user()->id)->where('product_id', $product_id);
    }
}
