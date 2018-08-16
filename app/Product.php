<?php

namespace App;

use App\Filter\ProductFilter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $with = ['category', 'restoraunt:id,brand'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function restoraunt()
  {
    return $this->belongsTo(Restoraunt::class, 'restoraunt_id');
  }

  public function scopeFilter($query, ProductFilter $filter)
  {
      return $filter->apply($query);
  }
}
