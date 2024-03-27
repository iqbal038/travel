<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Supir;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Session;
session_id('travel-iqbal');
session_start();

class SupirController extends Controller
{
    public function index()
    {
       $countPemesanan = DB::table('pemesanan as a')
                        ->join('supir as b', 'a.id_supir', '=', 'b.id')
                        ->where('a.status', '=', 'belum-lunas')
                        ->where('b.id_user', Auth::user()->id)
                        ->count();
        $countPembayaran = DB::table('transaksi as a')
                        ->join('pemesanan as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                        ->join('supir as c', 'b.id_supir', '=', 'c.id')
                        ->where('b.status', '=', 'belum-lunas')
                        ->where('c.id_user', Auth::user()->id)
                        ->count();

        return view('layouts.supir-dashboard', compact('countPemesanan', 'countPembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }


    public function store(Request $request)
    {
    //     $validate = $request->all([
    //         'nama_supir' => 'required|max:255',
    //         'ttl_supir' => 'required',
    //         'no_telpon' => 'required',
    //         'jenis_kendaraan' => 'required',
    //     ]);

    //     Supir::Create([
    //         'nama_supir' => $request->nama_supir,
    //         'ttl_supir' => $request->ttl_supir,
    //         'no_telpon' => $request->no_telpon,
    //         'jenis_kendaraan' => $request->jenis_kendaraan,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Berhasil Disimpan!',
    //         'data'    => $request
    //     ]);
    // }
    }

    public function show(Supir $supir)
    {
        //
    }


    public function edit(Supir $supir)
    {
        //
    }

    public function update(Request $request, Supir $supir)
    {
        //
    }

    public function destroy(Supir $supir)
    {
        //
    }

    public function supir() {
       
        return view('pages.supir');
    }

    public function pemesanan()
    {
        $pemesanan = DB::table('pemesanan as a')
            ->join('tujuan as b', 'a.id_tujuan', '=', 'b.id')
            ->join('supir as c', 'a.id_supir', '=', 'c.id')
            ->select('a.*', 'b.tujuan')
            ->where('c.id_user', Auth::user()->id)
            ->get();
            
        $pembayaran = DB::table('pemesanan as a')
                ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                ->join('tujuan as c', 'a.id_tujuan', '=', 'c.id')
                ->join('supir as d', 'a.id_supir', '=', 'd.id')
                ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'c.tujuan')
                ->where('d.id_user', Auth::user()->id)
                ->get();

        $countPemesanan = DB::table('pemesanan as a')
                        ->join('supir as b', 'a.id_supir', '=', 'b.id')
                        ->where('a.status', '=', 'belum-lunas')
                        ->where('b.id_user', Auth::user()->id)
                        ->count();

        $countPembayaran = DB::table('transaksi as a')
                        ->join('pemesanan as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                        ->join('supir as c', 'b.id_supir', '=', 'c.id')
                        ->where('b.status', '=', 'belum-lunas')
                        ->where('c.id_user', Auth::user()->id)
                        ->count();
        return view('pages.riwayat-pemesanan', compact('pemesanan', 'pembayaran', 'countPemesanan', 'countPembayaran'));
    }
    
    public function pembayaran()
    {
        $pemesanan = DB::table('pemesanan as a')
            ->join('tujuan as b', 'a.id_tujuan', '=', 'b.id')
            ->join('supir as c', 'a.id_supir', '=', 'c.id')
            ->select('a.*', 'b.tujuan')
            ->where('c.id_user', Auth::user()->id)
            ->get();
            
        $pembayaran = DB::table('pemesanan as a')
                ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                ->join('tujuan as c', 'a.id_tujuan', '=', 'c.id')
                ->join('supir as d', 'a.id_supir', '=', 'd.id')
                ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'c.tujuan')
                ->where('d.id_user', Auth::user()->id)
                ->get();

        $countPemesanan = DB::table('pemesanan as a')
                        ->join('supir as b', 'a.id_supir', '=', 'b.id')
                        ->where('a.status', '=', 'belum-lunas')
                        ->where('b.id_user', Auth::user()->id)
                        ->count();

        $countPembayaran = DB::table('transaksi as a')
                        ->join('pemesanan as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                        ->join('supir as c', 'b.id_supir', '=', 'c.id')
                        ->where('b.status', '=', 'belum-lunas')
                        ->where('c.id_user', Auth::user()->id)
                        ->count();

        return view('pages.riwayat-transaksi2', compact('pemesanan', 'pembayaran', 'countPemesanan', 'countPembayaran'));
    }
   

    public function update_status($id)
    {
        $cek = Pemesanan::findOrFail($id);
        if($cek)
        {
            Pemesanan::where('id', $id)->update([
                'status' => 'lunas'
            ]);

            return redirect()->to('pemesanan-pengguna')->with('success', 'Data pemesanan berhasil diubah.');
        } else {
            return redirect()->to('pemesanan-pengguna')->with('error', 'Data pemesanan tidak ditemukan');
        }
    }

    public function ubah_password()
    {
        $countPemesanan = DB::table('pemesanan as a')
        ->join('supir as b', 'a.id_supir', '=', 'b.id')
        ->where('a.status', '=', 'belum-lunas')
        ->where('b.id_user', Auth::user()->id)
        ->count();

        $countPembayaran = DB::table('transaksi as a')
                ->join('pemesanan as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                ->join('supir as c', 'b.id_supir', '=', 'c.id')
                ->where('b.status', '=', 'belum-lunas')
                ->where('c.id_user', Auth::user()->id)
                ->count();
        return view('pages.ubah-password-supir', compact('countPemesanan', 'countPembayaran'));
    }
    public function update_password(Request $request, $id)
    {
        $cek = User::findOrFail($id);

        if($cek)
        {
            // cek password lama
            if(Hash::check($request->password_lama, $cek->password))
            {
                if($request->password_baru == $request->konfirmasi_password_baru)
                {
                    $cek->update([
                        'password' => bcrypt($request->password_baru)
                    ]);

                    return redirect()->to('ubah-password-supir')->with('success', 'Password berhasil diubah');
                } else {
                    return redirect()->to('ubah-password-supir')->with('error', 'Konfirmasi password tidak sesuai.');
                }
            } else {
                return redirect()->to('ubah-password-supir')->with('error', 'Password lama tidak sesuai.');
            }
        } else {
            return redirect()->to('ubah-password-supir')->with('error', 'Data tidak ditemukan');
        }
    }

    public function cetak_pembayaran($id)
    {
        $cek = Pemesanan::where('id', $id)->first();
        
        if($cek)
        {
            $pembayaran = DB::table('pemesanan as a')
                ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                ->join('tujuan as c', 'a.id_tujuan', '=', 'c.id')
                ->join('supir as d', 'a.id_supir', '=', 'd.id')
                ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'c.tujuan')
                ->where('d.id_user', Auth::user()->id)
                ->where('a.id', '=', $id)
                ->first();

            return view('pages.pembayaran-cetak', compact('pembayaran'));
        } else {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }
}
