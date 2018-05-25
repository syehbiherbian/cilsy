<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

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

    public function store(Request $r)
    {
        if (!Auth::user()) {
            return 0;
        }
        dd($r->input());
    }
}
