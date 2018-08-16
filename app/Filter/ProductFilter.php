<?php
namespace App\Filter;


class ProductFilter extends Filter
{
  protected $fitlers = ['price', 'restoraunt', 'category', 'rate'];

  public function price($price)
  {
    return $this->builder->where('price', '>', $price[0])->where('price', '<=', $price[1]);
  }

  public function restoraunt($restoraunt)
  {
    if ($restoraunt) {
      return $this->builder->where('restoraunt_id', $restoraunt);
    } else {
      return $this->builder;
     }
  }

  public function category($category)
  {
      if ($category) {
        return $this->builder->where('category_id', $category);
      }
  }

  public function rate($rate)
  {
    if ($rate) {
      return $this->builder->where('rate', '>=', $rate);
    }
  }
}