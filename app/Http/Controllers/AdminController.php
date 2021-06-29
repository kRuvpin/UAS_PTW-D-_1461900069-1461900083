<?php

namespace App\Http\Controllers;

use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\Baju;
use App\Models\Checkout;
use App\Models\Cart;
use carbon\carbon;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\support\Facades\File;


class AdminController extends Controller
{
    public function index()
    {
        $baju = Baju::all();
        return view('admin.index', ['baju' => $baju]);
    }

    public function add()
    {
        $baju = Baju::all();
        return view('admin.add', ['baju' => $baju]);
    }

    public function add_proses(Request $request)
    {
        // dd($request->all())->get();
        $this->validate($request, [
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $gambar = $request->file('gambar');
        $nama_file = time() . "_" . $gambar->getClientOriginalName();
        $tujuan_upload = 'baju';
        $gambar->move($tujuan_upload, $nama_file);
        $kodebaju = 'KB' . sprintf("%04s", rand(1, 1000));
        DB::table('baju')->insert([
            'gambar' => $nama_file,
            'kodebaju' => $kodebaju,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect('admin/index');
    }

    public function report()
    {
        $transaksi = DB::table('transaksi')->select(DB::raw("userid, status, sum(biaya) as biaya, sum(jumlah) as banyak, kodepembayaran, tanggal"))->groupBy("kodepembayaran", "status", "tanggal", "userid")->get();
        $total = DB::table('transaksi')->select(DB::raw('sum(biaya) as total'))->where('status', 'sudah dikirim')->get();
        return view('admin.report', ['transaksi' => $transaksi], ['total' => $total]);
    }
    public function filter(Request $request)
    {
        if ($request->bulan == null) {
            return redirect('/admin/report');
        } else {
            $transaksi = DB::table('transaksi')->select(DB::raw("userid, status, sum(biaya) as biaya, sum(jumlah) as banyak, kodepembayaran, tanggal"))->where('status', 'sudah dikirim')->whereMonth('tanggal', '=', $request->bulan)->groupby("kodepembayaran", "status", "tanggal", "userid")->get();
            $total = DB::table('transaksi')->select(DB::raw('sum(biaya) as total'))->where('status', 'sudah dikirim')->whereMonth('tanggal', '=', $request->bulan)->get();
            return view('admin.report', ['transaksi' => $transaksi], ['total' => $total]);
        }
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $baju = DB::table('baju')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate();


        // mengirim data pegawai ke view index
        return view('admin.index', ['baju' => $baju]);
    }
    public function edit($kodepembayaran)
    {
        $laporan = DB::table('transaksi')->select(DB::raw("userid, status, sum(biaya) as biaya, sum(jumlah) as banyak, kodepembayaran, tanggal"))->groupBy("kodepembayaran", "status", "tanggal", "userid")->get();
        return view('admin.editlaporan', ['laporan' => $laporan]);
    }
    public function edit_proses(Request $request)
    {
        $kodepembayaran = $request->kodepembayaran;
        $update = Transaksi::where('kodepembayaran', $kodepembayaran)->update([
            'status' => $request->status,
        ]);
        return redirect('admin/report');
    }
    public function hapus($kodepembayaran)
    {
        $laporan = Transaksi::where('kodepembayaran', $kodepembayaran)->delete();
        return redirect('admin/report');
    }
    public function user()
    {
        $user = User::all();
        return view('admin.user', ['user' => $user]);
    }

    public function detail($idbaju)
    {
        $baju = Baju::where('idbaju', $idbaju)->get();
        return view('admin.detailbaju', ['baju' => $baju]);
    }
    public function hapus_baju($idbaju)
    {
        $baju = Baju::where('idbaju', $idbaju)->first();
        File::delete('baju/' . $baju->file);
        Baju::where('idbaju', $idbaju)->delete();
        return redirect('admin/index');
    }

    public function edit_baju($idbaju)
    {
        $baju = Baju::where('idbaju', $idbaju)->get();
        return view('admin.editbaju', ['baju' => $baju]);
    }

    public function update_baju(Request $request)
    {
        $baju = $request->idbaju;
        $bajuubah = Baju::where('idbaju', $baju)->update([
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect('admin/index');
    }
}
