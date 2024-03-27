@extends('layouts.user-dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Pembayaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> {{ Session::get('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> {{ Session::get('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif        
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> Terjadi kesalahan.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pembayaran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">

                             <form id="form_pembayaran" method="post" action="{{ url('pembayaran') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="no_pemesanan">No.Pemesanan</label>
                                        <div class="input-group mb-3">                                            
                                            <input type="text" id="no_pemesanan" name="no_pemesanan" class="form-control" placeholder="Masukkan no pemesanan" aria-describedby="basic-addon2" required>
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-success" id="btnCek" type="button">Cek</button>
                                            </div>
                                          </div>
                                        <div id="detail">
                                            <div class="form-group">
                                                <label for="nama">Nama Pemesan</label>
                                                <input type="text" class="form-control" id="nama" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="notelp">No.Telepon</label>
                                                <input type="text" class="form-control" id="notelp" maxlength="13" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_pesan">Tanggal Pemesanan</label>
                                                <input type="text" class="form-control" id="tgl_pesan" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="tujuan">Tujuan</label>
                                                <input type="text" class="form-control" id="tujuan" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="jml_penumpang">Jumlah Penumpang</label>
                                                <input type="text" class="form-control" id="jml_penumpang" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">                                        
                                        <div id="detailBayar">
                                            <div class="form-group">
                                                <label for="total_bayar">Total Bayar</label>
                                                <input type="text" class="form-control" name="jumlah_pembayaran" id="total_bayar" readonly>
                                            </div>
                                            <label>Jenis Bayar</label>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="cash" id="cash"
                                                    name="jenis_pembayaran" required>
                                                <label class="form-check-label" for="cash">Cash</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="va" id="va"
                                                    name="jenis_pembayaran">
                                                <label class="form-check-label" for="va">Virtual Account</label>
                                            </div>
                                            <div class="row mt-2 metode-bayar">
                                                <div class="col-md-3"><img src="{{ asset('assets/dist/img/dana.png') }}" class="va-dana"
                                                        alt="dana" width="100" style="cursor:pointer"></div>
                                                <div class="col-md-3"><img src="{{ asset('assets/dist/img/bca.png') }}" class="va-bca"
                                                        alt="bca" width="100" style="cursor:pointer"></div>
                                                <div class="col-md-3"><img src="{{ asset('assets/dist/img/bri.png') }}" class="va-bri"
                                                        alt="bri" width="100" style="cursor:pointer"></div>
                                                <div class="col-md-3"><img src="{{ asset('assets/dist/img/mandiri.png') }}"
                                                        class="va-mandiri" alt="mandiri" width="100" style="cursor:pointer">
                                                </div>
                                                <input type="hidden" id="hasil-metode-bayar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                            <div id="detailButton">
                                <div class="card-footer">
                                    <button type="button" id="btnBayar" class="btn btn-outline-primary">Bayar Sekarang</button>
                                    <button type="button" id="btnReset" class="btn btn-danger">Reset</button>
                                </div>
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
@endsection
@push('script')
    <script>
        $(function() {
            $('.metode-bayar').hide();
            $('#detail').hide();
            $('#detailBayar').hide();
            $('#detailButton').hide();

            $('#va').on('click', function() {
                $('.metode-bayar').show();
            })

            $('#cash').on('click', function() {
                $('.metode-bayar').hide();
            })

            $('.va-dana').on('click', function() {
                alert('Nomor VA Dana: 0812345678910');
                $('#hasil-metode-bayar').val('dana');
            })
            $('.va-bca').on('click', function() {
                alert('Nomor Rekening BCA: 156273823');
                $('#hasil-metode-bayar').val('bca');
            })
            $('.va-bri').on('click', function() {
                alert('Nomor Rekening BRI: 987317142');
                $('#hasil-metode-bayar').val('bri');
            })
            $('.va-mandiri').on('click', function() {
                alert('Nomor Rekening Mandiri: 1843956173');
                $('#hasil-metode-bayar').val('mandiri');
            })

            $('#btnCek').on('click', function() {
                var no_pemesanan = $('#no_pemesanan').val();
                if(no_pemesanan == '')
                {
                    Swal.fire('Warning', 'Isi nomor pemesanan', 'error');
                } else {
                    $.ajax({
                        url: "{{ url('getPemesanan') }}",
                        method: 'post',
                        data: {
                            no_pemesanan: no_pemesanan,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res)
                        {
                            console.log(res);
                            $('#detail').show();
                            $('#detailBayar').show();
                            $('#detailButton').show();

                            $('#nama').val(res.data.nama_pemesan);
                            $('#notelp').val(res.data.no_telp);
                            $('#tgl_pesan').val(res.data.tanggal_pemesanan);
                            $('#tujuan').val(res.data.tujuan);
                            $('#jml_penumpang').val(res.data.jumlah_pemesanan);
                            var totalBayar = res.data.jumlah_pemesanan * res.data.harga;
                            $('#total_bayar').val(totalBayar);
                        },
                        error: function(xhr, status, error)
                        {
                            if(xhr.status == 404)
                            {
                                Swal.fire('Oops!', 'Data Pemesanan tidak ditemukan.', 'error');
                                $('#form_pembayaran').trigger('reset');
                            }
                        }
                    })
                }
                
            });

            setTimeout(function() {
                $('.alert').fadeOut("slow");
            }, 2000);

            $('#btnReset').on('click', function() {
                $('#form_pembayaran').trigger('reset');

                $('.metode-bayar').hide();
                $('#detail').hide();
                $('#detailBayar').hide();
                $('#detailButton').hide();
            })

            $('#btnBayar').on('click', function() {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin ingin melakukan pembayaran?',
                    showDenyButton: true,
                    confirmButtonText: 'Bayar',
                    denyButtonText: `Batal`,
                    icon: 'warning',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#form_pembayaran').submit();
                    } else if (result.isDenied) {
                        Swal.fire('Pembayaran batal dilakukan', '', 'error')
                    }
                })
        })
        })
    </script>
@endpush
