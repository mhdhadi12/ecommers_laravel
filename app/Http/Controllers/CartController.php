<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }
    public function store(Request $r)
    {
        $cart = new Cart();
        $cart->quantity = $r->quantity;
        $cart->stok_id = $r->stok_id;
        $cart->user_id = session('user_id');
        $cart->size = $r->size;
        $cart->save();

        return redirect('cart');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();

        return redirect('cart');
    }
}