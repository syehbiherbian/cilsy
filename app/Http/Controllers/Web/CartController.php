<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        /* if (!Auth::user()) {
            return redirect('/');
        } */

        $cart = Cart::all();
        return $cart;
    }
}
