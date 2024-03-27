<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }

    public function laporan() {
        return view('pages.laporan');
    }

    public function laporan_cetak() {
        $dari_tgl = $_GET['dari-tgl'];
        $sampai_tgl = $_GET['sampai-tgl'];

        $dataPemesanan = DB::table('pemesanan as a')
                        ->join('users as b', 'a.id_user', '=', 'b.id')
                        ->join('tujuan as c', 'a.id_tujuan', '=', 'c.id')
                        ->join('supir as d', 'a.id_supir', '=', 'd.id')
                        ->select('a.*', 'b.name as nama_pemesan', 'c.tujuan', 'c.harga', 'd.nama_supir', 'd.jenis_kendaraan')
                        ->whereBetween('a.tanggal_pemesanan', [$dari_tgl, $sampai_tgl])
                        ->get();

        $dataPembayaran = DB::table('pemesanan as a')
                        ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                        ->join('users as c', 'a.id_user', '=', 'c.id')
                        ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'b.tanggal_pembayaran', 'c.name as nama_pemesan')
                        ->whereBetween('a.tanggal_pemesanan', [$dari_tgl, $sampai_tgl])
                        ->get();
        return view('pages.laporan-cetak', compact('dari_tgl', 'sampai_tgl', 'dataPemesanan', 'dataPembayaran'));
    }
}
