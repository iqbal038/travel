@extends('layouts.user-dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Pemesanan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pemesanan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pemesanan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formPesan" method="post" action="{{ url('pemesanan') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="no_pemesanan">No.Pemesanan</label>
                                                <input type="text" name="no_pemesanan" class="form-control" id="no_pemesanan"
                                                    placeholder="Masukkan nomor pemesanan" value="{{ $no_pemesanan }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_pemesan">Nama Pemesan</label>
                                                <input type="text" name="nama_pemesan" class="form-control" id="nama_pemesan"
                                                    placeholder="Masukkan nama pemesan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No.Telepon</label>
                                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                                    placeholder="Masukkan No.telp" maxlength="13" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                                <input type="date" name="tanggal_pemesanan" class="form-control"
                                                    id="tanggal_pemesanan" placeholder="Masukkan Tanggal Pemesanan" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="supir">Supir</label>
                                                <select class="custom-select rounded-0" name="id_supir" id="supir">
                                                    <option hidden value="">Pilih Supir</option>
                                                    @foreach (@$supir as $s)
                                                        <option value="{{ $s->id }}" data-kursi="{{ $s->jml_kursi }}">{{ $s->nama_supir }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_pemesanan">Jumlah Penumpang</label>
                                                <input type="number" name="jumlah_pemesanan" class="form-control"
                                                    id="jumlah_pemesanan" placeholder="Masukkan Jumlah Penumpang" min="0"
                                                    required>
                                            </div>
                                            <input type="hidden" id="validasi_kursi">
                                            <div class="form-group">
                                                <label for="tujuan">Tujuan</label>
                                                <select class="custom-select rounded-0" name="id_tujuan" id="tujuan">
                                                    <option hidden>Pilih Tujuan</option>
                                                    @foreach (@$tujuan as $t)
                                                        <option data-harga='{{ $t->harga }}' value="{{ $t->id }}">
                                                            {{ $t->tujuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="total_harga">Total Harga</label>
                                                <input type="text" class="form-control" id="total_harga" readonly>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" id="btnPesan" class="btn btn-outline-primary">Pesan Tiket</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<script>
    $(function() {
        $total_harga = $("#total_harga")

        $('#tujuan').change(function(e) {
            let selected = $(this).find("option:selected")
            let value = parseInt(selected.data('harga'))
            $jumlah_pemesanan = $("#jumlah_pemesanan").val()
            $total_harga.val(value * $jumlah_pemesanan)
        })

        $("#jumlah_pemesanan").on("keyup", function(e) {
            console.log('ai-e', e);
            let selected = $("#tujuan").find("option:selected")
            let value = parseInt(selected.data('harga'))
            $jumlah_pemesanan = $(this).val()
            $total_harga.val(value * $jumlah_pemesanan)
        })

        $('#btnPesan').on('click', function() {
            var nama_pemesan = $('#nama_pemesan').val();
            var no_telp = $('#no_telp').val();
            var tanggal_pemesanan = $('#tanggal_pemesanan').val();
            var supir = $('#supir').val();
            var jumlah_penumpang = $('#jumlah_pemesanan').val();
            var tujuan = $('#tujuan').val();
            
            if($('#jumlah_pemesanan').val() > $('#validasi_kursi').val()) 
            {
                return Swal.fire('Warning', 'Jumlah kursi yang dipesan melebihi kapasitas<br>Sisa kursi yang tersedia: '+$("#validasi_kursi").val()+'', 'warning');
            } else if(nama_pemesan == '' || no_telp == '' || tanggal_pemesanan == '' || supir == '' || jumlah_penumpang == '' || tujuan == '') {
                return Swal.fire('Warning', 'Pastikan seluruh data terisi', 'warning');
            } else {
                Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah anda yakin ingin memesan tiket?',
                icon: 'information',
                showDenyButton: true,
                confirmButtonText: 'Pesan',
                denyButtonText: `Batal`,
                icon: 'warning',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#formPesan').submit();
                } else if (result.isDenied) {
                    Swal.fire('Oops!', 'Data batal dipesan', 'error')
                }
            })
            }
            
        });

        $('#supir').each(function(){
            $(this).on('change', function() {
                var supir = $(this).find(':selected');
                var jml_kursi = supir.data('kursi');
                $('#validasi_kursi').val(jml_kursi);
                $('#jumlah_pemesanan').attr('max', jml_kursi);
            })
        })
    })
</script>
@endsection
