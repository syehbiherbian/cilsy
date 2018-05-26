<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Lesson;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'carts' => Cart::where('member_id', Auth::guard('members')->user()->id)->with('member', 'contributor', 'lesson')->get()
        ];
        
        return view('web.cart', $data);
    }

    public function store(Request $r)
    {
        if (!Auth::guard('members')->user()) {
            return 0;
        }

        /* cek lesson */
        $lesson = Lesson::find($r->input('id'));
        if (!$lesson) {
            throw new \Exception('Tutorial tidak ditemukan');
        }

        /* simpan ke cart */
        $cart = Cart::firstOrCreate([
            'member_id' => Auth::guard('members')->user()->id,
            'contributor_id' => $lesson->contributor_id,
            'lesson_id' => $lesson->id
        ]);

        return response()->json([
            'id' => $lesson->id,
            'title' => $lesson->title
        ]);
    }
}
