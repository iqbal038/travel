<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Transaksi</title>
</head>
<body>
<h2 align="center">Laporan Data Transaksi</h2>
<center>
    <span>Range date: {{ $dari_tgl }} - {{ $sampai_tgl }}</span>
</center>
<h3>Tabel Pemesanan</h3>
<table border="1" width="100%" style="border-collapse:collapse">
<tr>
    <th>No</th>
    <th>No.Pemesanan</th>
    <th>Nama Pemesan</th>
    <th>Nama Supir</th>
    <th>Jenis Kendaraan</th>
    <th>Jumlah Kursi</th>
    <th>Tujuan</th>
    <th>Tanggal Berangkat</th>
    <th>Harga</th>
</tr>
@php $no = 1; @endphp
@forelse($dataPemesanan as $row)
<tr align="center">
    <td>{{ $no++ }}</td>
    <th>{{ $row->no_pemesanan }}</th>
    <td>{{ $row->nama_pemesan }}</td>
    <td>{{ $row->nama_supir }}</td>
    <td>{{ $row->jenis_kendaraan }}</td>
    <td>{{ $row->jumlah_pemesanan }}</td>
    <td>{{ $row->tujuan }}</td>
    <td>{{ date('d M Y', strtotime($row->tanggal_pemesanan)) }}</td>
    <td>Rp{{ number_format(($row->harga * $row->jumlah_pemesanan), 0,',','.') }}</td>
</tr>
@empty
<tr>
    <td colspan="8" align="center">Tidak ada data</td>
</tr>
@endforelse
</table>

<h3>Tabel Pembayaran</h3>
<table border="1" width="100%" style="border-collapse:collapse">
<tr>
    <th>No</th>
    <th>No.Pemesanan</th>
    <th>Nama Pemesan</th>
    <th>Status Bayar</th>
    <th>Jenis Pembayaran</th>
    <th>Tgl.Pembayaran</th>
    <th>Total Bayar</th>
</tr>
@php $no = 1; @endphp
@forelse($dataPembayaran as $row)
<tr align="center">
    <td>{{ $no++ }}</td>
    <th>{{ $row->no_pemesanan }}</th>
    <td>{{ $row->nama_pemesan }}</td>
    <td>{{ $row->status }}</td>
    <td>{{ ($row->jenis_pembayaran == 'va' ? 'Virtual Account' : 'Cash') }}</td>
    <td>{{ date('d M Y', strtotime($row->tanggal_pemesanan)) }}</td>
    <td>Rp{{ number_format($row->jumlah_pembayaran, 0,',','.') }}</td>
</tr>
@empty
<tr>
    <td colspan="8" align="center">Tidak ada data</td>
</tr>
@endforelse
</table>
<script>
    window.print();
</script>
</body>
</html>
