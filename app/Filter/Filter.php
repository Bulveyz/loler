<?php

namespace App\Filter;


use Illuminate\Http\Request;

abstract class Filter
{
  protected $builder, $request;
  protected $fitlers = [];

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function apply($builder)
  {
    $this->builder = $builder;

    foreach ($this->getFilters() as $filter => $value) {
      if (method_exists($this, $filter)) {
        $this->$filter($value);
      } else {
        return $this->builder;
      }
    }
  }

  public function getFilters() {
    return $this->request->only($this->fitlers);
  }
}