<?php

namespace App\Http\Controllers;

use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\Baju;
use App\Models\Transaksi;
use App\Models\Checkout;
use App\Models\Cart;
use carbon\carbon;


class CostumerController extends Controller
{
    public function index()
    {
        $baju = Baju::all();
        return view('costumer.index', ['baju' => $baju]);
    }
    public function detail($idbaju)
    {
        $baju = Baju::where('idbaju', $idbaju)->get();
        return view('costumer.detailbaju', ['baju' => $baju]);
    }

    public function tambah(Request $request)
    {
        $user = Auth::user()->id;
        $idbaju = $request->id;
        $biaya = $request->jumlah * $request->harga;
        Cart::create([
            'kodebaju' => $request->kodebaju,
            'userid' => $user,
            'jumlah' => $request->jumlah,
            'biaya' => $biaya,
        ]);
        $cart = DB::table('cart')->join('baju', 'cart.kodebaju', '=', 'baju.kodebaju')->where('userid', $user)->get();
        return redirect('costumer/cart');
    }
    public function cart()
    {
        $user = Auth::user()->id;
        $bayar = Cart::sum('biaya');
        $cart = DB::table('cart')->join('baju', 'cart.kodebaju', '=', 'baju.kodebaju')->where('userid', $user)->get();
        return view('costumer.cart', ['cart' => $cart], ['bayar' => $bayar]);
    }
    public function postcart(Request $request)
    {
        $user = Auth::user()->id;
        $idbaju = $request->id;
        $biaya = $request->banyak * $request->harga;
        DB::table('cart')->insert([
            'cakecode' => $request->cakecode,
            'userid' => $user,
            'banyak' => $request->banyak,
            'biaya' => $biaya,
        ]);
        $cart = DB::table('cart')->join('cake', 'cart.cakecode', '=', 'cake.cakecode')->where('userid', $user)->get();
        return redirect('costumer/cart');
    }
    public function checkout(Request $request)
    {
        $payment = $request->file('bukti');
        $filename = time() . "_" . $payment->getClientOriginalName();
        $folder = 'payment';
        $payment->move($folder, $filename);

        $user = Auth::user()->id;
        $paymentcode = 'PC' . sprintf("%04s", rand(1, 1000));
        DB::table('checkout')->insert([
            'userid' => $user,
            'kodepembayaran' => $paymentcode,
            'bukti' => $filename,
            'status' => 'belum valid',
        ]);
        $paymentt = DB::table('cart')->where('userid', $user)->get();
        foreach ($paymentt as $paid) {
            Transaksi::create([
                'userid' => $user,
                'kodepembayaran' => $paymentcode,
                'kodebaju' => $paid->kodebaju,
                'jumlah' => $paid->jumlah,
                'biaya' => $paid->biaya,
                'tanggal' => Carbon::now()->format('y-m-d'),
                'status' => 'belum dikirim',
            ]);
            $pay = DB::table('baju')->select("stok")->where('kodebaju', $paid->kodebaju)->first();
            $buy = (int)$pay->stok;
            $buyy = $buy - $paid->jumlah;
            DB::table('baju')->where('kodebaju', $paid->kodebaju)->update([
                "stok" => $buyy,
            ]);
        }
        DB::table('cart')->where('userid', $user)->delete();
        return redirect('/costumer/history');
    }
    public function history()
    {
        $user = Auth::user()->id;
        $history = DB::table('transaksi')->select(DB::raw("userid, status, sum(biaya) as biaya, sum(jumlah) as jumlah, kodepembayaran, tanggal"))->groupBy("kodepembayaran", "status", "tanggal", "userid")->where('userid', $user)->get();
        return view('costumer.history', ['history' => $history]);
    }
}
