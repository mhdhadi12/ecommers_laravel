<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Stok;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = User::where('id', session('user_id'))->first();
        $carts = Cart::where('user_id', session('user_id'))->get();

        return view('checkout', [
            'user' => $user,
            'carts' => $carts,
        ]);
    }


    public function store(Request $request){
        $code = Carbon::now()->format('ymdHis');

        foreach ($request->carts_id as $id) {
            $cart = Cart::find($id);

            $checkout = new Checkout();
            $checkout->kode = $code;
            $checkout->stok_id = $cart->stok_id;
            $checkout->user_id = $request->user_id;
            $checkout->status = 'pending';
            $checkout->qty = $cart->quantity;
            $checkout->size = $cart->size;
            $checkout->total = $request->total;
            $imagePath = $request->file('image')->store('public/bukti-pembayaran');
            $checkout->bukti = $imagePath;
            $checkout->save();

            $cart->delete();
        }

        return redirect()->route('konfirmasi', $code);
    }

    public function konfirmasi($code) {
        $checkout = Checkout::where('kode', $code)->first();

        return view('konfirmasi', [
            'checkout' => $checkout
        ]);
    }

    public function admin_index()
    {
        $checkouts = Checkout::all();

        return view('checkout.checkout', [
            'checkouts' => $checkouts,
        ]);
    }
    public function update_status($id)
    {
        $checkout = Checkout::find($id);
        $checkout->status = 'verify';
        $checkout->save();

        $barang = Stok::find($checkout->stok_id);
        $barang->saldoakhir = $barang->saldoakhir - $checkout->qty ;
        $barang->save();

        return redirect('/admin-checkout');
    }
}
