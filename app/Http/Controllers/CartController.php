<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\increment;

class CartController extends Controller
{

  // Add Product
  public function store(Request $request)
  {
    if ($request->expectsJson()) {
      $this->validate($request, [
          'product_id' => 'required|exists:products,id'
      ]);

      $found = (new Cart())->scopeIsExistst($request->get('product_id'))->first();
      // If Product Exists In User Cart
      if ($found) {
        $found->count = $found->count + 1;
        $found->save();
        if ($request->expectsJson()) {
          return 'true';
        }
        // Else
      } else {
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->get('product_id')
        ]);
        return 'false';
      }
    } else {
      return redirect('/');
    }
  }

  // Delete Product From Cart
  public function destroy($id)
  {
    if (\request()->expectsJson()) {
      $delete = Cart::where('user_id', \auth()->user()->id)->where('product_id', $id)->delete();
      if ($delete) {
        return '200';
      }
    } else {
      return redirect('/');
    }
  }

  // Get All Products From Cart
  public function getProducts()
  {
    if (\request()->expectsJson()) {
      return User::find(\auth()->user()->id)->getCart()->get();
    } else {
      return redirect('/');
    }
  }

  // Counter Products Items From Cart
  public function counter(Request $request)
  {
    if ($request->expectsJson()) {
      $cartItem = Cart::findOrFail($request->id);
      $cartItem->count = $request->count;
      $cartItem->save();

      return $cartItem;
    } else {
      return redirect('/');
    }
  }
}
