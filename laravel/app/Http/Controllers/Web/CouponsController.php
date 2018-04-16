<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use App\invoice;
use DB;
use Session;
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
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return redirect()->route('summary')->withErrors('Invalid coupon code. Please try again.');
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
        ]);

        return redirect()->route('summary')->with('success_message', 'Coupon has been applied!');
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
    public function destroy($id)
    {
        //
    }
}
