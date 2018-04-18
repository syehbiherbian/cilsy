<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use App\invoice;
use DB;
use Session;
use DateTime;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = new DateTime;
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon || $coupon->limit_coupon <= 0) {
            return redirect()->route('summary')->withErrors('Kode Promo yang anda masukkan tidak valid!');
        }
        if($coupon->minimum_checkout > Session::get('price')){
            return redirect()->route('summary')->withErrors('Kode Promo tidak berlaku untuk paket yang anda pilih!');
        }
        if($coupon){
            $cut=$coupon->limit_coupon - 1;
            DB::table('coupon')
            ->where('code','=',$request->coupon_code)
            ->update(
            ['limit_coupon' => $cut]
            );
            // DB::table('invoice')
            // ->where('code', Session::get('invoiceCODE'));
        }
        session()->put('coupon', [
            'name' => $coupon->code,
            'value' => $coupon->value,
            'discount' => $coupon->discount(Session::get('price')),
            'type' => $coupon->type,
            'percent_off' => $coupon->percent_off,
        ]);

        return redirect()->route('summary')->with('success_message', 'Selamat! Kode Promo berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('summary')->with('success_message', 'Coupon has been removed.');
    }
}
